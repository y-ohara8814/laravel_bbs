<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id', //post_idの値が、postsテーブルのidというカラムに存在するか
            'body' => 'required|max:2000',
        ]);

        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);

        return redirect()->route('posts.show',['post' => $post]);

    }

    //コメントのupdate
    public function commentupdate(Request $request)
    {
        //Postモデルを通して、postsテーブル内の$post_idに紐づくレコードを取得
        $post = Post::findOrFail($post_id);
        //複数のレコードを更新
        $post->comments()->fill($params)->save();
    }
}
