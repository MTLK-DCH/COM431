<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function show(){
        // $comments = DB::select('select * from comments');
        $commentList = Comment::all();
        $categories = Categories::all();
        //store the data to the commentList by module comment

        return view(
            'show_comment',
            [
                'comments' => $commentList, 
                'categories' => $categories,
            ]
        );
    }
}
