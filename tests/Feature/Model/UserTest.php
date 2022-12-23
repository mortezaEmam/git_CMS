<?php

namespace Tests\Feature\Model;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ModelInsertTesting;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase , ModelInsertTesting;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function Tmodel(): Model
    {
        return new User();
    }
    public function test_user_ralationship_with_posts()
    {
        $count = rand(1,10);
        $user = User::factory()
            ->hasPosts($count)
            ->create();
        $this->assertCount($count,$user->posts);
        $this->assertTrue($user->posts->first() instanceof Post);

    }
    public function test_user_ralationship_with_comments()
    {
        $count = rand(1,10);
        $user = User::factory()
            ->hascomments($count)
            ->create();
        $this->assertCount($count,$user->comments);
        $this->assertTrue($user->comments->first() instanceof Comment);

    }
}
