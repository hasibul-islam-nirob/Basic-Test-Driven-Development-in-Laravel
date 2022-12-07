<?php

namespace Tests\Feature;

use App\Http\Controllers\PostCntroller;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCntrollerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function show_list_of_post(){
        // Arrange / When
        Post::factory()->count(10)->create();

        // Act / Given
        $posts = (new PostCntroller)->index();

        // Assert / Then
        $this->assertEquals(10, $posts->count());

    }

    /** @test */
    public function show_single_post(){
        // Arrange / When
        $post = Post::factory()->create([
            'title'=>'This is title',
            'slug'=>'This is slug',
            'body'=>'This is body'
        ]);

        // Act / Given
        $getPost = (new PostCntroller)->show($post->id);

        // Assert / Then
        $this->assertEquals($post->id, $getPost->id);
        $this->assertEquals("This is title", $getPost->title);

    }

}
