<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\View;


class HomePageController extends Controller
{
    public function index(){
        $posts = Post::with('languages')->paginate();

        return view('applicant.index',[
            'posts' => $posts,
        ]);
    }
}
