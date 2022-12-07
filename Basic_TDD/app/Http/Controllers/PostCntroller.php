<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCntroller extends Controller
{
    function index(){
        return Post::all();
    }

    function show(int $id){
        return Post::findOrFail($id);
    }

    function create(array $post){
        return Post::create($post);
    }
}
