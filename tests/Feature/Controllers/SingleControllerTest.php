<?php

namespace Tests\Feature\Controllers;

use App\Models\Post;
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
        $this->withoutExceptionHandling();
        $post = Post::factory()
            ->hasComments(rand(1,3))
            ->create();
        $response = $this->get(route('single',['post' => $post->id]));
        $response->assertOk();
        $response->assertViewIs('single');
        $response->assertViewHas(['post' => $post,'comments' => $post->comments]);
    }
}
