<?php

namespace Tests\Unit;

use App\Http\Controllers\PostCntroller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /* @test  */
    public function test_post_belongs_to_a_user(){
        // Arrange / When
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id'=>$user->id,
        ]);

        // Act / Given
        (new PostCntroller)->show($post->id);

        // Assert / Then
        $this->assertEquals($user->id, $post->user_id);
    }
}
