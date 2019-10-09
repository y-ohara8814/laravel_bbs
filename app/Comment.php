<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //別途、Controllerでfillメソッド（値の複数代入）を用いるために必要な記述
    protected $fillable = [
        'body',
    ];

    public function post()
    {
        //Postテーブルが主・Commentテーブルが従の関係（post_idで紐付き）
        return $this->belongsTo('App\Post');
    }
}
