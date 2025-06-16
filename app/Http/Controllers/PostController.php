<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Models\Post;
use Psy\Util\Json;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        //заглушка для юзера, так берем из авторизации
        $user = User::first();
        $posts = $this->postService->getUserFeedPosts($user);

        return response()->json($posts);
    }

    public function view(Post $post)
    {
        //заглушка для юзера, так берем из авторизации
        $user = User::first();
        $this->postService->markPostAsViewed($user, $post);
        return response()->json(['message' => 'Просмотр записан']);
    }
}
