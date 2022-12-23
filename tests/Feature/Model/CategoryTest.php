<?php

namespace Tests\Feature\Model;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ModelInsertTesting;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase ,ModelInsertTesting;
    protected function Tmodel(): Model
    {
        return new Category();
    }

    public function test_category_ralationship_with_posts()
    {
        $count = rand(1,10);
        $category = Category::factory()->hasPosts($count)->create();
        $this->assertCount($count,$category->posts);
        $this->assertTrue($category->posts->first() instanceof Post);

    }
}
