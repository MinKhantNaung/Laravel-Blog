@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mb-2 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="small text-muted">By <strong>{{ $article->user->name }}</strong></div>
                <div class="card-subtitle text-muted my-2 small">
                    {{ $article->created_at->diffForHumans() }},
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a href="{{ route('articles.delete', $article->id) }}" class="card-link btn btn-warning"
                    onclick="return confirm('Are you sure to delete?')">
                    Delete
                </a> |
                <a href="{{ route('articles.edit', $article->id) }}" class="card-link btn btn-secondary">
                    Edit
                </a>
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @if (session('Error'))
                <li class="list-group-item">
                    <strong class="text-danger">{{ session('Error') }}</strong>
                </li>
            @endif
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ route('comments.delete', $comment->id) }}" class="btn-close float-end"
                        onclick="return confirm('Are you sure you want to delete?')"></a>
                    {{ $comment->content }}
                    <div class="mt-2 small">
                        By <b>{{ $comment->user->name }}</b>,
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
            <form action="{{ route('comments.add') }}" method="POST">

                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control my-2" placeholder="New Comment"></textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="submit" value="Add Comment" class="btn btn-secondary">
            </form>
        @endauth
    </div>
@endsection
