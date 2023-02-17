@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Edit Book</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['BooksController@update', $book->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title', $book->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('author_name','Author Name')}}
                {{Form::text('author_name', $book->author_name, ['class' => 'form-control', 'placeholder' => 'Auhor_Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('name','Category')}}
                {{ Form::select('cat_id', $categories, $book->category_id, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{Form::label('publisher','Publisher')}}
                {{Form::text('publisher', $book->publisher, ['class' => 'form-control', 'placeholder' => 'Publisher'])}}
            </div>
            <div class="form-group">
                {{Form::label('edition','Edition')}}
                {{Form::text('edition', $book->edition, ['class' => 'form-control', 'placeholder' => 'Edition'])}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/books" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection