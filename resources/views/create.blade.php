@extends('layouts.app')

@push('styles_list')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/list.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Add New Word</h1>
        <form action="{{ route('words.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="English">English</label>
                <input type="text" name="English" class="form-control">
            </div>
            <div class="form-group">
                <label for="Spanish">Spanish</label>
                <input type="text" name="Spanish" class="form-control">
            </div>
            <div class="form-group">
                <label for="French">French</label>
                <input type="text" name="French" class="form-control">
            </div>
            <div class="form-group">
                <label for="German">German</label>
                <input type="text" name="German" class="form-control">
            </div>
            <div class="form-group">
                <label for="Japanese">Japanese</label>
                <input type="text" name="Japanese" class="form-control">
            </div>
            <div class="form-group">
                <label for="Serbian">Serbian</label>
                <input type="text" name="Serbian" class="form-control">
            </div>
            <div class="form-group">
                <label for="Dutch">Dutch</label>
                <input type="text" name="Dutch" class="form-control">
            </div>
            <div class="form-group">
                <label for="Japanese_hiragana">Japanese(Hiragana)</label>
                <input type="text" name="Japanese_hiragana" class="form-control">
            </div>
            <div class="form-group">
                <label for="Japanese_romaji">Japanese(Romaji)</label>
                <input type="text" name="Japanese_romaji" class="form-control">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control">
            </div>
            <!-- 戻るボタン -->
            <a href="{{ route('words.list') }}" class="btn btn-secondary">Back to List</a>
            <button type="submit" class="btn btn-success save_button">Save</button>
        </form>
    </div>
@endsection
