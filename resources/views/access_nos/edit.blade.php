@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br><br>
        <h2 class="mt-5">Book Title: {{$book->title}}({{$accessno->access_no}})</h2>
        <br>
        <h3>Update Access No</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['AccessnosController@update',$book->id, $accessno->id], 'method' => 'PUT'])!!}
            <div class="form-group">
                {{Form::label('access_no','Access No')}}
                {{Form::text('access_no', $accessno->access_no,['class' => 'form-control', 'placeholder' => 'access_no'])}}
            </div> 
                
                {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/books/{{$book->id}}" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection