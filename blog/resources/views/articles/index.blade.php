@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('info') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('articles.index') }}" method="GET">

            @csrf
            <div class="input-group my-3">
                <input type="text" name="search" class="form-control" placeholder="Search here...">
                <input type="submit" value="Search" class="btn btn-secondary">
            </div>
        </form>

        {{ $articles->links() }}

        @foreach ($articles as $article)
            <div class="card mb-2 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="small text-muted">By <strong>{{ $article->user->name }}</strong></div>
                    <div class="card-subtitle my-2 text-muted small">
                        {{ $article->created_at->diffForHumans() }},
                        Category: {{ $article->category->name }}
                    </div>
                    <p class="card-text">{{ $article->body }}</p>
                    <a href="{{ route('articles.detail', $article->id) }}" class="card-link">
                        View Details &raquo;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
