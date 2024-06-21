@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($user->photo != null)
                            <img src="{{ asset($user->photo) }}" alt="..." class="img-thumbnail"
                                style="width: 200px; height: 200px">
                        @else
                            <img src="{{ asset('img/ava.png') }}" alt="..." class="img-thumbnail"
                                style="width: 200px; height: 200px">
                        @endif
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">Дата регистрации: {{ $user->created_at->format('M. j, Y') }}</p>
                        <p class="card-text">Всего треков: {{ count($user->tracks) }}</p>
                        @if ($user->id == Auth::user()->id)
                            <form id="avatar-file-form" method="POST" enctype="multipart/form-data"
                                action="{{ route('NewAvatar') }}">
                                @csrf
                                @method('PUT')
                                <label class="btn btn-primary" for="avatar_change">
                                    Изменить фото
                                    <input type="file" class="custom-file-input" name="avatar_change" id="avatar_change"
                                        style="display: none;">
                                </label>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Плэйлисты</h5>
                        @if ($user->id == Auth::user()->id)
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Добавить плейлист</button>
                        @endif
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Добавление плейлиста</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <form class="m-5" enctype="multipart/form-data" method="POST"
                                                action="{{ route('NewAlbom') }}" enctype="multipart/form-data">
                                                @csrf
                                                <h3 class="main_text">Загрузка трека</h3>
                                                <div class="mb-3">
                                                    <label for="track_name" class="form-label">Название
                                                        плейлиста</label>
                                                    <input type="text" class="form-control" id="track_name"
                                                        name="name">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cover" class="form-label">Обложка</label>
                                                    <input type="file" class="form-control" id="cover"
                                                        name="cover">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Загрузить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex gap-5 flex-wrap">
                                @if ($alboms)
                                    @foreach ($alboms as $item)
                                        <div
                                            class="container d-flex flex-md-column gap-2 links w-auto justify-content-center align-items-center">
                                            <a href="{{ route('ShawAlbom', ['id' => $item->id]) }}"><img
                                                    src="{{ asset('storage/' . $item->cover_file) }}"
                                                    style="width: 120px; height: 120px;" alt=""></a>
                                            <a href="{{ route('ShawAlbom', ['id' => $item->id]) }}"
                                                class="link-primary text-decoration-none fs-3 text-black w-auto"
                                                style="--bs-text-opacity: 0.6;">{{ $item->name }}</a>
                                            <a href=""
                                                class="link-primary text-decoration-none fs-5 text-black w-auto"
                                                style="--bs-text-opacity: 0.6;">{{ $item->user->name }}</a>
                                        </div>
                                    @endforeach
                                @endif
                            </li>
                        </ul>
                        <hr>
                        <h5 class="card-title">Треки</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex gap-5 flex-wrap">
                                @foreach ($tracks as $track)
                                    <div
                                        class="container d-flex flex-md-column gap-2 links w-auto justify-content-center align-items-center">
                                        <a href="{{ route('ShawTrack', ['id' => $track->id]) }}"><img
                                                src="{{ asset('storage/' . $track->cover_file) }}"
                                                style="width: 120px; height: 120px;" alt=""></a>
                                        <a href="{{ route('ShawTrack', ['id' => $track->id]) }}"
                                            class="link-primary text-decoration-none fs-3 text-black w-auto"
                                            style="--bs-text-opacity: 0.6;">{{ $track->name }}</a>
                                        <a href="" class="link-primary text-decoration-none fs-5 text-black w-auto"
                                            style="--bs-text-opacity: 0.6;">{{ $track->user->name }}</a>
                                    </div>
                                @endforeach
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('avatar_change').addEventListener('change', function() {
            document.getElementById('avatar-file-form').submit();
        });
    </script>
@endsection
