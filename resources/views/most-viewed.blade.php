@extends('layout.base')
@section('title', 'Shortener Blue | 100 Most Viewed Links')
@section('content')

    <div class="content mt-5">
        <h1 class="title text-warning mt-5 mb-5 text-center">Top 100 Most Frequently Accessed URLs</h1>

        <table id="results" class="table table-striped table-bordered table-dark text-white mb-5" style="width:100%">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">URL</th>
                <th scope="col">Short Link</th>
                <th scope="col">Hits</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($mostViewedLinks as $idx => $item)
                <tr>
                    <th scope="row">{{ $idx + 1 }}</th>
                    <td>{{ $item->title }}</td>
                    <td>
                        <a href="{{ $item->link }}" target="_blank" class="text-white">{{ $item->link }}</a>
                    </td>
                    <td>
                        <a href="{{ url($item->short) }}" target="_blank" class="text-white">{{ url($item->short) }}</a>
                    </td>
                    <td>{{ $item->number_views }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
