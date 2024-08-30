@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Word</h1>
        <form action="{{ route('words.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="english">English</label>
                <input type="text" name="english" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="spanish">Spanish</label>
                <input type="text" name="spanish" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="french">French</label>
                <input type="text" name="french" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="german">German</label>
                <input type="text" name="german" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="japanese">Japanese</label>
                <input type="text" name="japanese" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="serbian">Serbian</label>
                <input type="text" name="serbian" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
