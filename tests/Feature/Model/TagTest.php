<?php

namespace Tests\Feature\Model;

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
}
