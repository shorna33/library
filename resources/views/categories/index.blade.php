<?php
    use App\Http\Controllers\BooksController;
?>
@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container"><br>
            <h2 class="display-3"><em>Categories</em></h2>
            <br><br>

            <!-- Button trigger modal -->
            <button type="button"   class="btn btn-dark" data-toggle="modal" data-target="#modalCenter">
                +Add Category
            </button> 
            <!-- Modal -->
            <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Add New Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{action('CategoriesController@store')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" aria-describedby="categoryHelp">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Search From --}}
    <div class="container">
        <form action="/searchCat" method="GET">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="search category">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>

    <br><br>
    <div class="container">

        @include('include.message')

        @if(count($categories) > 0)
            @foreach ($categories as $category)
                <div class="card my-2">
                    <div class="card-body">
                        <a href="/categories/{{$category->id}}"><h4>{{$category->name}}

                            ({{ BooksController::bookCount($category->id) }})</h4></a>

                        created at {{$category->created_at}} & updated at {{$category->updated_at}}

                        <div class="container">
                            {!!Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit', 'class'=>'btn btn-danger btn-sm float-right'])}}
                            {!!Form::close()!!}

                            <a class="btn btn-primary btn-sm mr-2 float-right" href="/categories/{{$category->id}}/edit" role="button"><i class="fas fa-edit"></i></a>
                        </div>            
                    </div>
                </div>
            @endforeach
            
            <br>
            <div class="float-right">
                {{$categories->links()}}
            </div>
        @else
            No Category to Show
        @endif
    </div>
    <br>

    @include('include.footer')
@endsection