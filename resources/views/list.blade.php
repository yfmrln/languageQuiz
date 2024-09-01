@extends('layouts.app')

@push('styles_list')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/list.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Word List</h1>
        <a href="{{ route('words.create') }}" class="btn btn-primary">Add New Word</a>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>no</th>
                    <th>English</th>
                    <th>Spanish</th>
                    <th>French</th>
                    <th>German</th>
                    <th>Japanese</th>
                    <th>Serbian</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($words as $key=>$word)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $word->English }}</td>
                        <td>{{ $word->Spanish }}</td>
                        <td>{{ $word->French }}</td>
                        <td>{{ $word->German }}</td>
                        <td>{{ $word->Japanese }}</td>
                        <td>{{ $word->Serbian }}</td>
                        <td>{{ $word->category }}</td>
                        <td>
                            <a href="{{ route('words.edit', $word) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('words.destroy', $word) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
