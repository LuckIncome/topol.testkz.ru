<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', Post::PUBLISHED)->orderByDesc('created_at')->paginate(6);

        return view('posts.index', compact('posts'));

    }

    public function show(Post $post)
    {
        $locale = session()->get('locale');
        $fallbackLocale = config('app.fallback_locale');
        $gallery = json_decode($post->gallery);
        $images = [];
        if ($gallery) {
            foreach ($gallery as $item){
                $images[] = ['original'=> \Voyager::image($post->getThumbnail($item,'big')),'webp' => str_replace('.' . pathinfo(\Voyager::image($item),PATHINFO_EXTENSION), '.webp', \Voyager::image($item))];
            }
        }
        $post = $post->translate($locale,$fallbackLocale);
        return view('posts.show', compact('post','images'));
    }
}
