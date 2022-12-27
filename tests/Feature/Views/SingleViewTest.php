<?php

namespace Tests\Feature\Views;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SingleViewTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Single_View_Rendered_When_User_Logged_In()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();
        $comments = [];
        $view = (string)$this->actingAs($user)
            -> view('single', compact('post', 'comments'));


        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($view);
        libxml_use_internal_errors($internalErrors);
        $dom = new \DOMXPath($dom);
        $action = route('single.comments',$post->id);
        $this->assertCount(1,$dom->query("//form[@method='post'][@action='$action']/textarea[@name='text']"));
    }
    public function test_Single_View_Rendered_When_User_Not_Logged()
    {
        $post = Post::factory()->create();
        $comments = [];
        $view = (string)$this
            -> view('single', compact('post', 'comments'));


        $dom = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $dom->loadHTML($view);
        libxml_use_internal_errors($internalErrors);
        $dom = new \DOMXPath($dom);
        $action = route('single.comments',$post->id);
        $this->assertCount(0,$dom->query("//form[@method='post'][@action='$action']/textarea[@name='text']"));
    }
}
