@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br><br>
        <h2 class="mt-5">Book Title: {{$book->title}}</h2>
        <br>
        <h3>Add A New Access No</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['AccessnosController@store', $book->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('access_no','Access No')}}
                {{Form::text('access_no','',['class' => 'form-control', 'placeholder' => 'access_no'])}}
            </div> 
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/books/{{$book->id}}" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection