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
                    <th>active</th>
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
                        <td>
                            <input type="checkbox" class="word-checkbox" data-id="{{ $word->id }}" {{ $word->is_active ? 'checked' : '' }}>
                        </td>
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
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this word?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="div_csv">
            <span>・CSV for batch import</span><br>
            <!-- CSVダウンロード -->
            <a href="{{ route('words.export') }}" class="btn btn-outline-info btn-sm mb-4">Download CSV</a>

            <!-- CSVアップロード -->
            <form action="{{ route('words.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="csv_file">・Upload CSV</label>
                <div class="form-group">
                    <input type="file" name="csv_file" id="csv_file" class="form-control" required>
                    <button type="submit" class="btn btn-outline-success btn-sm">Upload</button>
                </div>
            </form>
        </div>

    </div>
@endsection
