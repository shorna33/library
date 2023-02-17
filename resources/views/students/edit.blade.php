@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Update Student Info</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['StudentsController@update', $student->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('roll','Student ID')}}
                {{Form::text('roll', $student->roll, ['class' => 'form-control', 'placeholder' => 'student_id'])}}
            </div>
            <div class="form-group">
                {{Form::label('name','Full Name')}}
                {{Form::text('name', $student->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('batch_id','Select Batch & Program:')}}
                <select class="form-control" name="batch_id" id="">
                    <option value="{{$student->batch_id}}">{{$student->batch->title}}, {{ $student->batch->program }}</option>
                    @foreach($studbatches as $studbatch)
                        <option value="{{$studbatch->id}}">
                            {{$studbatch->title}}, {{$studbatch->program}}
                        </option>
                    @endforeach
                </select>
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/batches/{{$student->batch_id}}" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection