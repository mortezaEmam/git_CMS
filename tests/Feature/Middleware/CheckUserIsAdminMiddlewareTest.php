<?php

namespace Tests\Feature\Midelware;

use App\Http\Middleware\CheckUserIsAdmin;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Tests\TestCase;

class CheckUserIsAdminMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_When_User_Is_Not_LoggedIn()
    {
        $request = Request::create('/admin',method: 'Get');
        $Middleware = new CheckUserIsAdmin();
        $response = $Middleware->handle($request,function (){});
        $this->assertEquals($response->getStatusCode(),302);
    }
    public function test_When_User_Is_Not_Admin()
    {
        $user = User::factory()->user()->create();
        $this->actingAs($user);
        $request = Request::create('/admin',method: 'Get');
        $Middleware = new CheckUserIsAdmin();
        $response = $Middleware->handle($request,function (){});
        $this->assertEquals($response->getStatusCode(),302);
    }
    public function test_When_User_Is_Admin()
    {
        $user = User::factory()->admin()->create();
        $this->actingAs($user);
        $request = Request::create('/admin',method: 'Get');
        $Middleware = new CheckUserIsAdmin();
        $response = $Middleware->handle($request,function (){});
        $this->assertEquals($response,null);
    }
}
