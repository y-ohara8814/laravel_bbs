<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //別途、Controllerでfillメソッド（値の複数代入）を用いるために必要な記述。記述したフィールドに対する値の代入を許可する
    protected $fillable = [
        'title',
        'body',
    ];

    public function comments()
    {
        //Postテーブルが主・Commentテーブルが従の関係（post_idで紐付き）
        return $this->hasMany('App\Comment');
    }

    public function hoge()
    {
        return false;
    }
}
