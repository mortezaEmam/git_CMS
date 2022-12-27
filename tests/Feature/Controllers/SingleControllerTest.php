<?php

namespace Tests\Feature\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingleControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_method()
    {
        $post = Post::factory()
            ->hasComments(rand(0, 3))
            ->create();
        $response = $this->get(route('single', ['post' => $post->id]));
        $response->assertOk();
        $response->assertViewIs('single');
        $response->assertViewHas(['post' => $post, 'comments' => $post->comments]);
    }

    public function test_Comment_Method_When_User_Logged_In()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $post = Post::factory()->create();


        $data = Comment::factory()->state([
            'user_id' => $user->id,
            'commentable_id' => $post->id,
        ])->make()->toArray();


        $response = $this
            ->actingAs($user)
            ->withHeader('HTTP_X-Requested-with' , 'XMLHttpRequest')
            ->postJson(route('single.comments', $post->id),
                ['body' => $data['body']]);
        $response->assertOk()->assertJson([
            'created' => true,
        ]);
        $this->assertDatabaseHas('comments', $data);
    }

    public function test_Comment_Method_When_User_Not_Logged_In()
    {
        $post = Post::factory()->create();

        $data = Comment::factory()->state([
            'commentable_id' => $post->id,
        ])->make()->toArray();

        unset($data['user_id']);

        $response = $this
            ->post(route('single.comments', $post->id),
                ['body' => $data['body']]);
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('comments', $data);
    }


}
