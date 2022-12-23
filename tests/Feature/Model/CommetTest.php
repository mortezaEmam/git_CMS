<?php

namespace Tests\Feature\Model;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ModelInsertTesting;
use Tests\TestCase;

class CommetTest extends TestCase
{
  use RefreshDatabase, ModelInsertTesting;

    protected function Tmodel(): Model
    {
        return new Comment();
    }

    public function test_comments_relationship_with_post()
    {
        $comment = Comment::factory()
            ->hasCommentable(Post::factory())
            ->create();
        $this->assertTrue(isset($comment->commentable->id));
        $this->assertTrue($comment->commentable instanceof Post);
    }
}
