@extends('layout')

@section('content')
    <div class="row">
        @foreach($images as $image)
            <div class="col-xs-4">
                <img src="{{ $image->image_url }}" alt="" class="img-responsive">
                @if(!$image->uploaded)
                    <a href="/upload/{{ $image->id }}" class="btn btn-success">Загрузить на imgur.com</a>
                @endif
            </div>
        @endforeach
    </div>
@endsection