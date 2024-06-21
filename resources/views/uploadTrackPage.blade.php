@extends('layouts.app')

@section('content')
    <div class="container mx-auto mart">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form class="m-5" enctype="multipart/form-data" method="POST" action="{{ route('NewMusic') }}">
                        @csrf
                        <h3 class="main_text">Загрузка трека</h3>
                        <div class="mb-3">
                            <label for="track" class="form-label">Трек</label>
                            <input type="file" class="form-control" id="track" name="track">
                        </div>
                        <div class="mb-3">
                            <label for="track_name" class="form-label">Название трека:</label>
                            <input type="text" class="form-control" id="track_name" name="track_name">
                        </div>
                        <div class="mb-3">
                            <label for="genre_track" class="form-label">Жанр трека:</label>
                            <input type="text" class="form-control" id="genre_track" name="genre_track">
                        </div>
                        <div class="mb-3">
                            <label for="cover" class="form-label">Обложка</label>
                            <input type="file" class="form-control" id="cover" name="cover">
                        </div>
                        <button type="submit" class="btn btn-primary">Загрузить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
