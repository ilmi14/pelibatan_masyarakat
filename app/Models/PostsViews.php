<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsViews extends Model
{
    use HasFactory;

    protected $table = 'posts_views';

    public static function createViewLog($post) {
            $postsViews= new PostsViews();
            $postsViews->id_post = $post->id;
            $postsViews->slug = $post->slug;
            $postsViews->url = \Request::url();
            $postsViews->session_id = \Request::getSession()->getId();
            $postsViews->user_id = \Auth::user()->id;
            $postsViews->ip = \Request::getClientIp();
            $postsViews->agent = \Request::header('User-Agent');
            $postsViews->save();
    }
}
