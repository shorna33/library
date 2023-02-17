@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container"><br>
            <h4 class="display-3">{{$category->name}}</h4>
            <br><br>
            <a class="btn btn-dark" href="/books/create" role="button">+Add Book</a>
        </div>
    </div>
    
    @include('include.message')
    
    @if(count($categorybooks) > 0)
        <table class="table table-bordered table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author Name</th>
                <th scope="col">Category</th>
                <th scope="col">Edition</th>
                <th scope="col">Publisher</th>
                <th scope="col">+</th>
            </tr>
            </thead>
            <tbody>
                @foreach($categorybooks as $key =>$book)
                    <tr>
                        <th scope="row">{{$categorybooks->firstItem() + $key}}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author_name}}</td>
                        <td>{{$book->category->name}}</td>
                        <td>{{$book->edition}}</td>
                        <td>{{$book->publisher}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/books/{{$book->id}}/edit" role="button"><i class="fas fa-edit"></i></a>

                            {!!Form::open(['action' => ['BooksController@destroy', $book->id], 'method' => 'POST', 'class'=>'float-right'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit', 'class'=>'btn btn-danger btn-sm'])}}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="float-right">
            {{$categorybooks->links()}}
        </div>
    @else
        <div class="container">
            <h2>No Book To Show</h2>
        </div>
    @endif

@endsection