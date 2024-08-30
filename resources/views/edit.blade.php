@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Word</h1>
        <form action="{{ route('words.update', $word) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="english">English</label>
                <input type="text" name="english" class="form-control" value="{{ $word->english }}" required>
            </div>
            <div class="form-group">
                <label for="spanish">Spanish</label>
                <input type="text" name="spanish" class="form-control" value="{{ $word->spanish }}" required>
            </div>
            <div class="form-group">
                <label for="french">French</label>
                <input type="text" name="french" class="form-control" value="{{ $word->french }}" required>
            </div>
            <div class="form-group">
                <label for="german">German</label>
                <input type="text" name="german" class="form-control" value="{{ $word->german }}" required>
            </div>
            <div class="form-group">
                <label for="japanese">Japanese</label>
                <input type="text" name="japanese" class="form-control" value="{{ $word->japanese }}" required>
            </div>
            <div class="form-group">
                <label for="serbian">Serbian</label>
                <input type="text" name="serbian" class="form-control" value="{{ $word->serbian }}" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" value="{{ $word->category }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
