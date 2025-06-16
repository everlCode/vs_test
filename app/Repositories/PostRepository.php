<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;

class PostRepository
{
    public function getUserFeedPosts(User $user, int $maxViews)
    {
        return DB::table('posts as p')
            ->leftJoin('post_views as pv', function($join) use($user) {
                $join->on('pv.post_id', '=', 'p.id')
                    ->where('pv.user_id', '!=', $user->id);
            })
            ->select('p.*')
            ->groupBy('p.id', 'p.title')
            ->havingRaw('count(*) < ?', [PostService::MAX_POST_VIEWS])
            ->orderBy('p.hotness', 'DESC')
            ->get();
    }

    public function markPostAsViewed(User $user, Post $post)
    {
        DB::table('post_views')->updateOrInsert(
            ['post_id' => $post->id, 'user_id' => $user->id],
            ['created_at' => now(), 'updated_at' => now()]
        );
    }
}
