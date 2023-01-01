<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Index_Method()
    {
         Post::factory()->count(100)->create();
         $this->get(route('post.index'))
             ->assertOk()
             ->assertViewIs('admin.post.post-index')
             ->assertViewHas('posts' ,Post::query()->latest()->paginate(15));




    }
}
