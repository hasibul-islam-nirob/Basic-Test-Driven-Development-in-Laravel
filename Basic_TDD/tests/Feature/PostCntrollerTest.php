<?php

namespace Tests\Feature;

use App\Http\Controllers\PostCntroller;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $this->assertEquals("This is slug", $getPost->slug);
        $this->assertEquals("This is body", $getPost->body);

    }

    /** @test */
    public function trows_exception_if_wrong_id_pass(){
        // Arrange / When
        Post::factory()->create();

        // Assert / Then
        $this->expectException(ModelNotFoundException::class);

        // Act / Given
        $posts = (new PostCntroller)->show(100);

    }


    /** @test */
    public function create_new_post(){
        // Arrange
        $this->assertDatabaseCount('posts',0);
        $post = [
            'title'=>'This is title',
            'slug'=>'This is slug',
            'body'=>'This is body'
        ];

        // Act
        (new PostCntroller)->create($post);

        // Assert
        $this->assertDatabaseCount('posts',1);

    }


    /** @test */
    public function delete_post(){
        // Arrange
        $postOne = Post::factory()->create();

        $postTwo = Post::factory()->create();

        $this->assertDatabaseCount('posts',2);

        // Act
        (new PostCntroller)->delete($postTwo->id);

        // Assert
        $this->assertDatabaseCount('posts',1);

    }





}
