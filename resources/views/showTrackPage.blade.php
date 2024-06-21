@extends('layouts.app')

@section('content')
    <div class="container my-5 mart">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-5 d-flex justify-content-between">
                    <img src="{{ asset('storage/' . $track->cover_file) }}" alt="" class="rounded float-start"
                        width="200" height="200">
                    <h3 class="main_text">{{ $track->name }}</h3>
                    <a href="{{ route('home', ['user_id' => $track->user->id]) }}"
                        class="main_text">{{ $track->user->name }}</a>
                    @if ($track->user_id == Auth::user()->id)
                        <a href="{{ route('deleteTrack', ['track_id' => $track->id]) }}" class="btn btn-danger"
                            style="width: 150px" href="{{ route('Like', ['track_id' => $track->id]) }}">Удалить</a>
                    @endif
                    <p class="main_text">Жанр: {{ $track->genre }}</p>
                    <div class="d-flex justify-content-start gap-5">
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/' . $track->music_file) }}">
                        </audio>
                        @if ($like)
                            <a class="btn btn-outline-warning"
                                href="{{ route('Like', ['track_id' => $track->id]) }}">Нравится</a>
                        @else
                            <a class="btn btn-warning" href="{{ route('Like', ['track_id' => $track->id]) }}">Нравится</a>
                        @endif
                    </div>
                    <h6 class="border-bottom pb-2 mb-0 pt-4">Комментарии</h6>
                    <div class="form-group py-3">
                        <form action="{{ route('NewCommetn', ['id' => $track->id]) }}" method="POST">
                            @csrf
                            <label for="comment">Ваш комментарий</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <div class="col-12 py-1">
                                <button type="submit" class="btn btn-warning">Опубликовать</button>
                            </div>
                        </form>
                    </div>
                    @foreach ($track->comment as $item)
                        <div class="d-flex text-muted pt-3">
                            <p class="pb-3 mb-0 small lh-sm w-100 border-bottom">
                                <strong class="d-block text-gray-dark">{{ $item->user->name }}</strong>
                                {{ $item->comment }}
                                @if (Auth::id() == $item->user->id || Auth::id() == $track->user->id)
                                    <a type="button" href="{{ route('DeleteComm', ['comment_id' => $item->id]) }}"
                                        class="btn btn-outline-danger">Удалить</a>
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
