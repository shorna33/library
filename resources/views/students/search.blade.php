<?php 
    use App\Http\Controllers\IssuestudsController;
?>
@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container"><br>
            <h2 class="display-3">{{$batchstuds->count()}} result(s) found</h2>
            <br><br>
        </div>
    </div>

    <div class="container">
        <form action="/searchStud" method="GET">
            <div class="input-group">
                <input type="search" name="search" value="{{$search}}" class="form-control" placeholder="search student by ID">
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                </span>
            </div>
        </form>
    </div>

    <br><br>
    <div class="container">

        @include('include.message')

        @if(count($batchstuds) > 0)
            <table class="table table-bordered table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Batch</th>
                    <th scope="col">Program</th>
                    <th scope="col">+</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($batchstuds as $batchstud)
                        <tr>
                            <th scope="row">
                                <a href="/students/{{$batchstud->id}}">{{$batchstud->roll}}({{ IssuestudsController::issuedBook($batchstud->id) }})</a>
                            </th>
                            <td>{{$batchstud->name}}</td>
                            <td>{{$batchstud->batch->title}}</td>
                            <td>{{$batchstud->batch->program}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/students/{{$batchstud->id}}/edit" role="button"><i class="fas fa-edit"></i></a>
                                
                                {!!Form::open(['action' => ['StudentsController@destroy', $batchstud->id], 'method' => 'POST', 'class'=>'float-right'])!!}
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
                {{$batchstuds->links()}}
            </div>
        @else
            <h3>No Student To Show</h3>
        @endif
    </div>
@endsection