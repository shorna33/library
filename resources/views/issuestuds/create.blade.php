@extends('layouts.app')

@section('asset')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="container">
        <br><br><br>
        <h3 class="mt-5">Issue A New Book</h3>
        <br>

        @include('include.message')

        <br>
        {!!Form::open(['action' => 'IssuestudsController@store', 'method' => 'POST'])!!}
            <div class="form-group">
                {{Form::label('batch_id','Select Program:')}}
                <select class="form-control" name="batch_id" id="">
                    <option value="">Select</option>
                    @foreach($batchissues as $batchissue)
                        <option value="{{$batchissue->id}}">
                            {{$batchissue->title}}({{$batchissue->program}})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{Form::label('roll','Student ID')}}
                {{Form::text('roll','',['class' => 'form-control', 'placeholder' => 'ID'])}}
            </div>
            <div class="form-group">
                {{Form::label('access_no','Access No')}}
                {{Form::text('access_no','',['class' => 'form-control', 'placeholder' => 'access no'])}}
            </div>
            <div class="form-group">
                {{Form::label('return','Return Date')}}
                {{Form::dateTime('return','',['class' => 'form-control', 'placeholder' => 'year-month-day'])}}
            </div> 
            {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/issuestuds" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection