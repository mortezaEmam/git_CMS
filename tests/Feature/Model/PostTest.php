<?php

namespace Tests\Feature\Model;

use App\Models\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Insert_Data_to_Post()
    {
       $data = Post::factory()->make()->toArray();
       Post::factory()->create($data);
       $this->assertDatabaseHas('posts',$data);
    }
}
