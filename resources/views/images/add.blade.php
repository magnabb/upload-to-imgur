@extends('layout')

@section('content')
    <form method="post" action="/add" class="form" novalidate enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Выберите картинку</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary">Загрузить</input>
        </div>
    </form>
@endsection