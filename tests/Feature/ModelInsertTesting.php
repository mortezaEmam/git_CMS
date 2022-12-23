<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait ModelInsertTesting
{
    use RefreshDatabase;
    public function test_Insert_Data_to_Post()
    {
        $model = $this->Tmodel();
        $table = $model->getTable();
        $data = $model::factory()->make()->toArray();
        $model::factory()->create($data);
        $this->assertDatabaseHas($table,$data);
    }
    abstract protected function Tmodel() : Model;


}
