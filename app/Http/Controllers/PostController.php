<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        return view('posts.index');
    }

    public function test()
    {
        return $this->postService->getPostById('1');
    }
    //
}
