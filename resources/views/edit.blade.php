@extends('layouts.app')

@push('styles_list')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/list.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Edit Word</h1>
        <form action="{{ route('words.update', $word) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="english">English</label>
                <input type="text" name="english" class="form-control" value="{{ $word->English }}" required>
            </div>
            <div class="form-group">
                <label for="spanish">Spanish</label>
                <input type="text" name="spanish" class="form-control" value="{{ $word->Spanish }}" required>
            </div>
            <div class="form-group">
                <label for="french">French</label>
                <input type="text" name="french" class="form-control" value="{{ $word->French }}" required>
            </div>
            <div class="form-group">
                <label for="german">German</label>
                <input type="text" name="german" class="form-control" value="{{ $word->German }}" required>
            </div>
            <div class="form-group">
                <label for="japanese">Japanese</label>
                <input type="text" name="japanese" class="form-control" value="{{ $word->Japanese }}" required>
            </div>
            <div class="form-group">
                <label for="serbian">Serbian</label>
                <input type="text" name="serbian" class="form-control" value="{{ $word->Serbian }}" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" value="{{ $word->category }}" required>
            </div>
            <a href="{{ route('words.list') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn btn-success save_button">Update</button>
        </form>
    </div>
@endsection
