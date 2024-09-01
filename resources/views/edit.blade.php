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
                <label for="English">English</label>
                <input type="text" name="English" class="form-control" value="{{ $word->English }}">
            </div>
            <div class="form-group">
                <label for="Spanish">Spanish</label>
                <input type="text" name="Spanish" class="form-control" value="{{ $word->Spanish }}">
            </div>
            <div class="form-group">
                <label for="French">French</label>
                <input type="text" name="French" class="form-control" value="{{ $word->French }}">
            </div>
            <div class="form-group">
                <label for="German">German</label>
                <input type="text" name="German" class="form-control" value="{{ $word->German }}">
            </div>
            <div class="form-group">
                <label for="Japanese">Japanese</label>
                <input type="text" name="Japanese" class="form-control" value="{{ $word->Japanese }}">
            </div>
            <div class="form-group">
                <label for="Serbian">Serbian</label>
                <input type="text" name="Serbian" class="form-control" value="{{ $word->Serbian }}">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" value="{{ $word->category }}">
            </div>
            <a href="{{ route('words.list') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn btn-success save_button">Update</button>
        </form>
    </div>
@endsection
