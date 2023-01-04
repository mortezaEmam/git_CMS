<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
            ->assertViewHas('posts', Post::query()->latest()->paginate(15));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create_Method()
    {
        Tag::factory()->count(15)->create();
        Category::factory()->count(10)->create();
        $this->get(route('post.create'))
            ->assertOk()
            ->assertViewIs('admin.post.post-create')
            ->assertViewHasAll([
                'tags' => Tag::query()->latest(),
                'categories' => Category::query()->latest(),
            ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Edit_Method()
    {
        Tag::factory()->count(15)->create();
        Category::factory()->count(10)->create();
        $post = Post::factory()->create();
        $this->get(route('post.edit',$post->id))
            ->assertOk()
            ->assertViewIs('admin.post.post-edit')
            ->assertViewHasAll([
                'post' => $post,
                'tags' => Tag::query()->latest(),
                'categories' => Category::query()->latest(),
            ]);
    }
}
