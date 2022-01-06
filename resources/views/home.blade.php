@extends('layout.base')
@section('title', 'Shortener Blue | Shorten Your Link')
@section('content')

    <div class="content">
        <h1 class="title text-warning mt-5 mb-5 text-center">Shorten Your Link Here </h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            class="text-center"
            method="post"
            action="{{ route('short-link.store') }}"
        >
            @csrf
        <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="text"
                       class="form-control"
                       name="full-link"
                       placeholder="Insert your link here"
                       aria-label="link"
                       value="{{ old('full-link') }}"

                >
            </div>
            <!-- Submit button -->
            <button type="submit"
                    class="btn btn-warning btn-block text-center"
                    style="width: 350px"
            >
                Shorten
            </button>
        </form>
    </div>

@endsection
