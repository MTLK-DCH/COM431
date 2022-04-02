<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AjaxBOOKCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ajax-book-crud');
    }
    
    public function fetchBooks()
    {
        $books = Book::all();
        return response()->json([
            'books'=>$books,
        ]);
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'code'=>'required',
            'author'=>'required',
            'bestseller'=>'required',
            'year'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $book = new Book;
            $book->title = $request->input('title');
            $book->code = $request->input('code');
            $book->author = $request->input('author');
            $book->bestseller = $request->input('bestseller');
            $book->year = $request->input('year');
            
            $book->save();
            return response()->json([
                'status'=>200,
                'message'=>'Book Added Successfully.'
            ]);
        }
    }
      
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $book = Book::find($id);
        if($book)
        {
            return response()->json([
                'status'=>200,
                'book'=> $book,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Book Found.'
            ]);
        }
    }

    /**
     * Update an existing resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'code'=>'required',
            'author'=>'required',
            'year'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $book = book::find($id);
            if($book)
            {
                $book->title = $request->input('title');
                $book->code = $request->input('code');
                $book->author = $request->input('author');
                $book->year = $request->input('year');
                $book->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Book with id:'.$id. ' Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Book Found.'
                ]);
            }

        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book)
        {
            $book->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Book Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Book Found.'
            ]);
        }
    }
}