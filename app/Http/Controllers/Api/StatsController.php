<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Traits\ResponseTrait;

class StatsController extends Controller
{
    use ResponseTrait;
    public function __invoke()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $usersWithZeroPosts = User::doesntHave('posts')->count();
        $stats = [
            'total_users' => $totalUsers,
            'total_posts' => $totalPosts,
            'users_with_zero_posts' => $usersWithZeroPosts,
        ];
        return $this->getResponse(data: $stats);
    }
}
