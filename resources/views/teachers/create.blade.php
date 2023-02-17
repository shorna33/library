@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Add A New Teacher</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => 'TeachersController@store', 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('name','Full Name')}}
                {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('desig','Designation')}}
                {{Form::text('desig','',['class' => 'form-control', 'placeholder' => 'Designation'])}}
            </div>
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/teachers" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection