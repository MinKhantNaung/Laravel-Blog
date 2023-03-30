<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }

    // to main articles page
    public function index() {
        $articles = Article::when(request('search'), function($query) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('body', 'like', '%' . request('search') . '%');
        })
            ->latest()->paginate(5);

        $articles->appends(request()->all());

        return view('articles.index', compact('articles'));
    }

    // to create/add article page
    public function add() {
        $categories = [
            ['id' => 1, 'name' => 'Tech'],
            ['id' => 2, 'name' => 'News'],
        ];

        return view('articles.create', compact('categories'));
    }

    // to create articles
    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        Article::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('articles.index')->with('info', 'Article Created');
    }

    // to detail page
    public function detail($id) {
        $article = Article::find($id);

        return view('articles.detail', compact('article'));
    }

    // to edit page
    public function edit($id) {
        $article = Article::find($id);
        $categories = [
            ['id' => 1, 'name' => 'Tech'],
            ['id' => 2, 'name' => 'News'],
        ];

        if(Gate::allows('article-delete-update', $article)) {
            return view('articles.edit', compact('article', 'categories'));
        } else {
            return back()->with('error', 'Unauthorize');
        }

    }

    // to update article
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        Article::find($id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('articles.index')->with('info', 'Article Updated');
    }

    // to delete article
    public function delete($id) {
        $article = Article::find($id);

        if(Gate::allows('article-delete-update', $article)) {
            $article->delete();

            return redirect()->route('articles.index')->with('info', 'Article Deleted');
        } else {
            return back()->with('error', 'Unauthorize');
        }
    }

}
