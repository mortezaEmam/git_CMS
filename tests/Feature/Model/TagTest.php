<?php

namespace Tests\Feature\Model;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\ModelInsertTesting;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase, ModelInsertTesting;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    protected function Tmodel(): Model
    {
        return new Tag();
    }
    public function test_Tag_ralationship_with_posts()
    {
        $count = rand(1,10);
        $tag = Tag::factory()->hasPosts($count)->create();
        $this->assertCount($count,$tag->posts);
        $this->assertTrue($tag->posts->first() instanceof Post);

    }
}
