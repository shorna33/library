<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\Accessno;
use App\Issuestud;
use App\Issueteacher;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('title','asc')->paginate(15);

        return view('books.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::pluck('name', 'id');
        return view('books.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'author_name' => 'required'
        ]);
        

        $book = new Book;
        $book->title = $request->input('title');
        $book->author_name = $request->input('author_name');
        $book->category_id = $request->input('cat_id');
        $book->publisher = $request->input('publisher');
        $book->edition = $request->input('edition');

        $book->save(); 

        return redirect('/books')->with('success','New Book Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bookAccessno = Accessno::where('book_id', $id)->orderBy('access_no', 'asc')->paginate(10);
        $book = Book::find($id);
        
        return view('books.show', ['bookAccessno'=> $bookAccessno, 'book'=> $book]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);

        $categories = Category::pluck('name', 'id');

        return view('books.edit', ['book' => $book, 'categories' => $categories ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'author_name' => 'required'
        ]);

        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->author_name = $request->input('author_name');
        $book->category_id = $request->get('cat_id');
        $book->publisher = $request->input('publisher');
        $book->edition = $request->input('edition');

        $book->save();

        return redirect('/books')->with('success','Book Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('/books')->with('success','Book Removed');
    }



    public function searchBook(Request $request)
    {
        $this->validate($request,[
            'search' => 'required',
        ]);
        
        $search = $request->input('search');
        $books = Book::where('title', 'LIKE', "%$search%")->paginate(5);

        return view('books.search', ['books'=> $books, 'search'=> $search]);
    }

    public static function bookCount($id)
    {
        $bookCount = Book::where('category_id', $id)->count();

        return $bookCount;
    }

    public static function availQuantity($id)
    {
        $totalBook = Accessno::where('book_id', $id)->count();
        $studIssue = Issuestud::where('book_id', $id)->count();
        $teaIssue = Issueteacher::where('book_id', $id)->count();

        $quantity = ( $totalBook - ( $studIssue + $teaIssue));

        return $quantity;
    }
}
