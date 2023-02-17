@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Update Category</h3>
        <br>
        {!!Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('name','Category Name')}}
                {{Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Name' ])}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/categories" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection