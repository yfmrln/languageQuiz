@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="default_question_language" class="col-md-4 col-form-label text-md-right">{{ __('Default Question Language') }}</label>

                            <div class="col-md-6">
                                <select id="default_question_language" class="form-control" name="default_question_language" required>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language }}" {{ $userSetting->default_question_language === $language ? 'selected' : '' }}>
                                            {{ $language }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="default_answer_language" class="col-md-4 col-form-label text-md-right">{{ __('Default Answer Language') }}</label>

                            <div class="col-md-6">
                                <select id="default_answer_language" class="form-control" name="default_answer_language" required>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language }}" {{ $userSetting->default_answer_language === $language ? 'selected' : '' }}>
                                            {{ $language }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Settings') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
