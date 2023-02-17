@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Update Batch Info</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => ['BatchesController@update', $batch->id], 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('batch','Batch No')}}
                {{Form::text('batch', $batch->title ,['class' => 'form-control', 'placeholder' => 'Batch'])}}
            </div>
            <div class="form-group">
                {{Form::label('program','Program Name')}}
                {{Form::text('program', $batch->program, ['class' => 'form-control', 'placeholder' => 'Program'])}}
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/batches" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection