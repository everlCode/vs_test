<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        $viewsCount = 1000;

        $pairs = [];

        while (count($pairs) < $viewsCount) {
            $userId = $userIds[array_rand($userIds)];
            $postId = $postIds[array_rand($postIds)];
            $key = $userId . '-' . $postId;

            if (!isset($pairs[$key])) {
                $pairs[$key] = [
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('post_views')->insert(array_values($pairs));
    }
}
