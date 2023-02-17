<?php
    use App\Http\Controllers\IssueteachersController;
?>
@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/teacher.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container">
            <br>
            <h2 class="display-3">Teachers</h2>
            <br><br>
            <a class="btn btn-dark" href="/teachers/create" role="button">+Add New Teacher</a>
        </div>
    </div>

    <div class="container">
        <form action="/searchTea" method="GET">
            <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="search teacher">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>

    <br><br>
    <div class="container">

        @include('include.message')

        @if(count($teachers) > 0)
            <table class="table table-bordered table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Designation</th>
                    <th scope="col">+</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <th scope="row"><a href="/teachers/{{$teacher->id}}">{{$teacher->name}}
                                ({{ IssueteachersController::issueCount($teacher->id) }})</a></th>
                            <td>{{$teacher->desig}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/teachers/{{$teacher->id}}/edit" role="button"><i class="fas fa-edit"></i></a>

                                {!!Form::open(['action' => ['TeachersController@destroy', $teacher->id], 'method' => 'POST', 'class'=>'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::button('<i class="fas fa-trash-alt"></i>', ['type'=>'submit', 'class' => 'btn btn-danger btn-sm'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="float-right">
                {{$teachers->links()}}
            </div>
        @else
            <h3>No Teacher To Show</h3>
        @endif
    </div>

    @include('include.footer')
@endsection