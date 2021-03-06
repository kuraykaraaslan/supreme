<?php

namespace Kuraykaraaslan\Supreme\Controllers;

use Exception;
use Kuraykaraaslan\Supreme\Modals\Post;
use Kuraykaraaslan\Supreme\Supreme;
use Kuraykaraaslan\Supreme\SupremeSEO;
use Spatie\Valuestore\Valuestore;

class FrontController extends Controller
{

    public function __construct()
    {
        $this->middleware('supreme-language-picker');
    }

    public function e404(Exception $exception)
    {
        return view('supreme::errors.404');
    }

    public function homepage()
    {
        SupremeSEO::setTitle(Supreme::settings('app.title'));
        SupremeSEO::setDescription(Supreme::settings('app.description'));
        SupremeSEO::setKeywords(Supreme::settings('app.keywords'));
        $posts = Post::latest('created_at')->paginate(5);
        return view('supreme::front.pages.homepage', compact('posts'));
    }

    public function about()
    {
        return view('supreme::front.pages.about');
    }

    public function post_show($category_slug = null, $post_slug = null)
    {
        if ($category_slug == null || $post_slug == null) {
            
        }
        $post = Post::find($post_id);
        SupremeSEO::setTitle($post->title);
        SupremeSEO::setDescription($post->description);
        SupremeSEO::setKeywords($post->keywords);
        return view('supreme::front.pages.post.show', compact('post'));
    }

    public function post_index()
    {
        $posts = Post::latest('created_at')->paginate(10);
        return view('supreme::front.pages.blog', compact('posts'));
    }

}