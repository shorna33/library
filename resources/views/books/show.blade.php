@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/access.css') }}">
@endsection

@section('content')
    <div class="jumbotron img-fluid">
        <div class="container"><br>
            <h2 class="display-3"><em>{{$book->title}}</em></h2>
            <br><br>
            <a class="btn btn-dark" href="/access_nos/{{$book->id}}" role="button">+Add New Access No</a>
        </div>
    </div>

    <div class="container">

        @include('include.message')

        @if(count($bookAccessno) > 0)
            <table class="table table-bordered table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Access No</th>
                    <th scope="col">+</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($bookAccessno as $key=> $bookAccess)
                        <tr>
                            <th scope="row">{{$bookAccessno->firstItem() + $key}}</th>
                            <td>{{$bookAccess->access_no}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="/access_nos/{{$bookAccess->book->id}}/{{$bookAccess->id}}/edit" role="button"><i class="fas fa-edit"></i></a>
                                
                                {!!Form::open(['action' => ['AccessnosController@destroy', $bookAccess->id], 'method' => 'POST', 'class'=>'float-right'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::button('<i class="fas fa-trash-alt"></i>',['type'=>'submit', 'class'=>'btn btn-danger btn-sm'])}}
                                {!!Form::close()!!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="float-right">
                {{$bookAccessno->links()}}
            </div>   
            @else
                No Book To Show
        @endif
    </div>
@endsection