<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;

class PostService
{
    public const MAX_POST_VIEWS = 1000;

    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getUserFeedPosts(User $user)
    {
        return $this->postRepository->getUserFeedPosts($user, 1000);
    }

    public function markPostAsViewed(User $user, Post $post)
    {
        $this->postRepository->markPostAsViewed($user, $post);
    }
}
