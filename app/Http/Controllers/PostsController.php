<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        //postテーブルのレコードを、作成日時の降順で取得
        //$posts = Post::orderBy('created_at','desc')->paginate(10);
        $posts = Post::with(['comments'])->orderBy('created_at', 'desc')->paginate(10);

        //取得したレコードをposts.indexに渡す
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);

        //Postされてきた値を、バリデーションののちPostテーブルにインサート
        Post::create($params);

        return redirect()->route('top');
    }

    public function show($post_id)
    {
        //postテーブルとpost_idで紐づくレコードを取得している（＝commentテーブルのレコードを取得している）
        $post = Post::findOrFail($post_id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($post_id)
    {
        $post = Post::findORFail($post_id);

        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update($post_id, Request $request)
    {
        $params = $request->validate([
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ]);

        //Postモデルを通して、postsテーブル内の$post_idに紐づくレコードを取得
        $post = Post::findOrFail($post_id);
        //複数のレコードを更新
        $post->fill($params)->save();

        return redirect()->route('posts.show', ['post' => $post]);
    }

    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

        //トランザクションメソッドを使用。削除実行時、何らかの例外が発生すると自動でロールバックされる
        \DB::transaction(function () use ($post) {
            $post->comments()->delete();
            $post->delete();
        });

        return redirect()->route('top');
    }
}
