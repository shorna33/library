<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accessno;
use App\Book;
use App\Category;

class AccessnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $book = Book::find($id);
    
        return view('access_nos.create')->with('book', $book);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'access_no'=>'required'
        ]);
        
        $accessbook = Book::find($id);

        $accessno = new Accessno;
        $accessno->access_no = $request->input('access_no');
        $accessno->category_id = $accessbook->category->id;
        $accessno->book_id = $accessbook->id;

        $accessno->save(); 

        return redirect('/books/'. $accessbook->id)->with('success','Successfully Added New Access No.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($book_id, $id)
    {
        $accessno = Accessno::find($id);
        $book = Book::find($book_id);
        
        return view('access_nos.edit', ['accessno'=> $accessno, 'book'=> $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book_id, $id)
    {
        $this->validate($request,[
            'access_no'=>'required'
        ]);

        $accessno = Accessno::find($id);
        $accessbook = Book::find($book_id); 
        
        $accessno->access_no = $request->input('access_no');
        $accessno->category_id = $accessbook->category->id;
        $accessno->book_id = $accessbook->id;

        $accessno->save(); 

        return redirect('/books/'. $accessbook->id )->with('success','Successfully Updated Access No.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accessno = Accessno::find($id);
        $accessno->delete();

        return redirect('/books')->with('success','Access No Removed');
    }

    public static function accessCount($id)
    {
        $accessCount = Accessno::where('book_id', $id)->count();

        return $accessCount;
    }
}
