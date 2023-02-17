@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Add A New Student</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => 'StudentsController@store', 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('roll','Student ID')}}
                {{Form::text('roll','',['class' => 'form-control', 'placeholder' => 'student_id'])}}
            </div>
            <div class="form-group">
                {{Form::label('name','Full Name')}}
                {{Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name'])}}
            </div>
            <div class="form-group">
                {{Form::label('batch_id','Select Batch & Program:')}}
                <select class="form-control" name="batch_id" id="">
                    <option value="">Select</option>
                    @foreach($studbatches as $studbatch)
                        <option value="{{$studbatch->id}}">
                            {{$studbatch->title}}, {{$studbatch->program}}
                        </option>
                    @endforeach
                </select>
            </div>
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/batches" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection