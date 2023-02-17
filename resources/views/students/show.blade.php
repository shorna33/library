@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/issueBook.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container">
            <br>
            <h2 class="display-3" style="color: cornsilk"><em>Issued Books</em></h2>
            <h1 class="font-weight-bolder" style="color: cornsilk; font-size: 2.5rem; letter-spacing: 1px;">{{$student->roll}}</h1>
            <br><br>
            <a class="btn btn-dark" href="/issuestuds/create" role="button">+Issue New Book</a>
        </div>
    </div>
    
    @include('include.message')

    @if(count($studissues) > 0)
        <table class="table table-bordered table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Access No</th>
                <th scope="col">Book Title</th>
                <th scope="col">Author Name</th>
                <th scope="col">Issue Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">+</th>
            </tr>
            </thead>
            <tbody>
                @foreach($studissues as $key => $studissue)
                    <tr>
                        <th scope="row">{{$studissues->firstItem() + $key}}</th>
                        <td>{{$studissue->access->access_no}}</td>
                        <td>{{$studissue->book->title}}</td>
                        <td>{{$studissue->book->author_name}}</td>
                        <td>{{$studissue->created_at}}</td>
                        <td>{{$studissue->return}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/issuestuds/{{$studissue->id}}/edit" role="button"><i class="fas fa-edit"></i></a>
                            
                            {!!Form::open(['action' => ['IssuestudsController@destroy', $studissue->id], 'method' => 'POST', 'class'=>'float-right'])!!}
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
            {{$studissues->links()}}
        </div>
    @else
        <div class="container">
            <h2>No Issued Book To Show</h2>
        </div>
    @endif

@endsection