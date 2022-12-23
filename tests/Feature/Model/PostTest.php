<?php

namespace Tests\Feature\Model;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ModelInsertTesting;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase , ModelInsertTesting;

    protected function Tmodel(): Model
    {
        return new Post();
    }
    public function test_post_relationship_with_user()
    {
        $post = Post::factory()->for(User::factory())->create();
        $this->assertTrue(isset($post->user->id));
        $this->assertTrue($post->user instanceof User);
    }
    public function test_post_relationship_with_category()
    {
        $post = Post::factory()->for(Category::factory())->create();
        $this->assertTrue(isset($post->category->id));
        $this->assertTrue($post->category instanceof Category);
    }
}
