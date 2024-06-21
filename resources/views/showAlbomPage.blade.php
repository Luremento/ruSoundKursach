@extends('layouts.app')

@section('content')
    <div class="container my-5 mart">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-5 d-flex justify-content-between">
                    <div>
                        <img src="{{ asset('storage/' . $albom->cover_file) }}" alt="" class="rounded float-start"
                            width="200" height="200">
                        <div class="ml-3">
                            <h3 class="main_text">{{ $albom->name }}</h3>
                            <a href="{{ route('home', ['user_id' => $albom->user->id]) }}">Создатель плейлиста:
                                {{ $albom->user->name }}</a>
                            @if ($albom->user->id == Auth::user()->id)
                                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary ml-3"
                                    style="width: 150px">Добавить трек</button>
                                <a class="btn btn-danger ml-3"href="{{ route('deleteAlbom', ['albom_id' => $albom->id]) }}"
                                    style="width: 150px">Удалить</a>
                            @endif
                        </div>
                    </div>
                    <h3>Список треков:</h3>
                    @if (isset($tracks))
                        @foreach ($tracks as $item)
                            <div class="d-flex flex-md-row gap-2 w-auto pb-2 pt-2">
                                <div class="me-2">
                                    <a href="{{ route('ShawTrack', ['id' => $item->id]) }}"><img
                                            src="{{ asset('storage/' . $item->cover_file) }}"
                                            style="width: 100px; height: 100px;"></a>
                                </div>
                                <div>
                                    <a href="{{ route('ShawTrack', ['id' => $item->id]) }}"
                                        class="link-primary text-decoration-none fs-5 text-black w-auto"
                                        style="--bs-text-opacity: 0.6;">{{ $item->name }}</a>
                                    <div class="fs-7 text-black w-auto" style="--bs-text-opacity: 0.6;">
                                        {{ $item->name }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление треков</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <form class="m-5" enctype="multipart/form-data" method="POST"
                            action="{{ route('NewTrackinAlbom', ['albom_id' => $albom->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <select class="form-select" aria-label="Пример выбора по умолчанию" name="track_id">
                                @foreach ($newTrack as $item)
                                    <option value="{{ $item->track->id }}">{{ $item->track->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
