@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{ route('articles.update', $article->id) }}" method="POST">

            @csrf
            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Enter title..." class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article->title) }}">
                @error('title')
                    <strong class="invalid-feedback">
                        {{ $message }}
                    </strong>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body">Body</label>
                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" placeholder="Enter body...">{{ old('body', $article->body) }}</textarea>
                @error('body')
                    <strong class="invalid-feedback">
                        {{ $message }}
                    </strong>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-select @error('category_id') is-invalid @enderror" value="{{ old('category_id', $article->category_id) }}">
                    @foreach ($categories as $category)
                       <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <strong class="invalid-feedback">
                        {{ $message }}
                    </strong>
                @enderror
            </div>
            <input type="submit" class="btn btn-success mt-3" value="Update Article">
            <a href="{{ route('articles.detail', $article->id) }}" class="btn btn-secondary mt-3"><< back</a>
        </form>
    </div>

@endsection
