@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Update Issued Book Info</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['IssueteachersController@update', $issueteacher->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('name','Teacher\'s Name')}}
                {{ Form::select('teacher_id', $teachers, $issueteacher->teacher_id, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{Form::label('access_no','Access No')}}
                {{Form::text('access_no', $issueteacher->access->access_no,['class' => 'form-control', 'placeholder' => 'access no'])}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/issueteachers" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection