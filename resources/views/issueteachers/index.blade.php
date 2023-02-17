@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/issueBook.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container">
            <br>
            <h2 class="display-3" style="color: cornsilk"><em>Issued Books</em></h2>
            <h1 style="color: cornsilk">Teachers</h1>
            <br><br>
            <a class="btn btn-dark" href="/issueteachers/create" role="button">+Issue New Book</a>
        </div>
    </div>
    <br>
    @include('include.message')
    
    @if(count($issueteachers) > 0)
        <table class="table table-bordered table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Teacher's Name</th>
                <th scope="col">Access No</th>
                <th scope="col">Book Title</th>
                <th scope="col">Author Name</th>
                <th scope="col">Issue Date</th>
                <th scope="col">+</th>
            </tr>
            </thead>
            <tbody>
                @foreach($issueteachers as $key => $issueteacher)
                    <tr>
                        <th scope="row">{{$issueteachers->firstItem() + $key}}</th>
                        <td>{{$issueteacher->teacher->name}}</td>
                        <td>{{$issueteacher->access->access_no}}</td>
                        <td>{{$issueteacher->book->title}}</td>
                        <td>{{$issueteacher->book->author_name}}</td>
                        <td>{{$issueteacher->created_at}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/issueteachers/{{$issueteacher->id}}/edit" role="button"><i class="fas fa-edit"></i></a>
                            
                            {!!Form::open(['action' => ['IssueteachersController@destroy', $issueteacher->id], 'method' => 'POST', 'class'=>'float-right'])!!}
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
            {{$issueteachers->links()}}
        </div>
    @else
        <div class="container">
            <h2>No Issued Book To Show</h2>
        </div>
    @endif

    @include('include.footer')

@endsection