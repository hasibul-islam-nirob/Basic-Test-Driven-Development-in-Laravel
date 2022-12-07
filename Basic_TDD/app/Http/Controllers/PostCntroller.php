<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCntroller extends Controller
{
    function index(){
        return Post::all();
    }


}
