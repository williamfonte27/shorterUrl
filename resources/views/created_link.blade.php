@extends('layout.base')
@section('title', "Shortener Blue | New Link To {$newShortUrl->url}")
@section('content')

    <div class="content mt-5">

        <h1 class="title text-warning mt-5 mb-5 text-center">New Link Shorted</h1>

        <div class="row g-3 mb-5">
            <div class="col-sm-6">
                <label for="firstName" class="form-label">Full link:</label>
                <a href="{{ $newShortUrl->link }}" class="text-white">{{ $newShortUrl->link }}</a>
            </div>

            <div class="col-sm-6">
                <label for="lastName" class="form-label">Short link:</label>
                <a href="{{ url($newShortUrl->short) }}" class="text-white">{{ url($newShortUrl->short) }}</a>
            </div>
        </div>


        <a class="btn btn-warning btn-block text-center"
           href="{{ route('home') }}">
            Back to Home
        </a>
    </div>

@endsection
