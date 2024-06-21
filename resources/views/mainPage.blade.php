@extends('layouts.app')
@section('title')
    ZETRIX - Профиль
@endsection

@section('content')
    <div class="container-fluid d-flex">
        <div class="container col-7 border pb-4">
            <div class=" container ml-5 mt-5">
                <div class="container mt-5 row gap-5">
                    @foreach ($random_traks as $treak)
                        <div class="container d-flex flex-md-column gap-2 links w-auto text-center">
                            <a href="{{ route('ShawTrack', ['id' => $treak->id]) }}"><img
                                    src="{{ asset('storage/' . $treak->cover_file) }}"
                                    style="width: 120px; height: 120px;"></a>
                            <a href="{{ route('ShawTrack', ['id' => $treak->id]) }}"
                                class="link-primary text-decoration-none fs-3 text-black w-auto"
                                style="--bs-text-opacity: 0.6;">{{ $treak->name }}</a>
                            <a class="link-primary text-decoration-none fs-5 text-black w-auto"
                                href="{{ route('home', ['user_id' => $treak->user->id]) }}"
                                style="--bs-text-opacity: 0.6;">{{ $treak->user->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if (count($likes))
            <div class="container col-3">
                <div class="container d-flex align-items-start">
                    <div class="col-md-12">
                        <div class="card mb-3 p-3">
                            <h5 class="card-title">Понравившиеся треки</h5>
                            @foreach ($likes as $like)
                                <div class="d-flex flex-md-row gap-2 w-auto pb-2">
                                    <div class="me-2">
                                        <a href="{{ route('ShawTrack', ['id' => $like->track->id]) }}"><img
                                                src="{{ asset('storage/' . $like->track->cover_file) }}"
                                                style="width: 50px; height: 50px;"></a>
                                    </div>
                                    <div>
                                        <a href="{{ route('ShawTrack', ['id' => $like->track->id]) }}"
                                            class="link-primary text-decoration-none fs-5 text-black w-auto"
                                            style="--bs-text-opacity: 0.6;">{{ $like->track->name }}</a>
                                        <div class="fs-7 text-black w-auto" style="--bs-text-opacity: 0.6;">
                                            <a href="{{ route('home', ['user_id' => $like->user->id]) }}">
                                                {{ $like->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
