<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function index() {
        $images = \App\Images::all();
        return view('images/index', ['images' => $images]);
    }

    public function addForm() {
        return view('images/add');
    }

    public function add(Request $request) {
        $request->all();

        $model = Images::orderBy('id', 'desc')
            ->first();

        $id = $model->id + 1;
        $ext = $request->file('image')->getClientOriginalExtension();

        $imageName = $id . '.' . $ext;

        Images::create([
            'image_url' => url('/uploads') . '/' . $imageName,
            'ext' => $ext,
        ]);

        $request->file('image')->move(
            base_path() . '/public/uploads/', $imageName
        );

        return \Redirect::to('/');
    }

    public function upload($id) {
        $model = \App\Images::find($id);

        // Подготавливаем картинку
        $filename = base_path() . '/public/uploads/' . $id . '.' . $model->ext;
        $client_id = \Config::get('imgur.client_id');
        $data = fread(fopen($filename, 'r'), filesize($filename));

        // Отправляем картинку
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['image' => base64_encode($data)]);
        $response = curl_exec($curl); // забираем данные с imgur
        curl_close($curl);
        $params = json_decode($response, TRUE);
        $url = $params['data']['link'];

        // Сохраняем новый маршрут
        $model->image_url = $url;
        $model->uploaded = true;
        $model->save();

        // Удаляем файл с сайта
        unlink($filename);

        return \Redirect::to('/');
    }
}
