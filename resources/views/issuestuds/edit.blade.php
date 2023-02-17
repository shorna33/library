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
        {!!Form::open(['action' => ['IssuestudsController@update', $issuestud->id], 'method' => 'POST'])!!}
        <div class="form-group">
            {{Form::label('batch_id','Select Program:')}}
            <select class="form-control" name="batch_id" id="">
                <option value="{{$issuestud->batch_id}}">{{$issuestud->batch->title}}({{$issuestud->batch->program}})</option>
                @foreach($batchissues as $batchissue)
                    <option value="{{$batchissue->id}}">
                        {{$batchissue->title}}({{$batchissue->program}})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{Form::label('roll','Student ID')}}
            {{Form::text('roll', $issuestud->student->roll, ['class' => 'form-control', 'placeholder' => 'ID'])}}
        </div>
        <div class="form-group">
            {{Form::label('access_no','Access No')}}
            {{Form::text('access_no', $issuestud->access->access_no, ['class' => 'form-control', 'placeholder' => 'access no'])}}
        </div>

        <?php 
            $return = explode(' ', $issuestud->return);
        ?>

        <div class="form-group">
            {{Form::label('return','Return Date')}}
            {{Form::dateTime('return', $return[0], ['class' => 'form-control', 'placeholder' => 'year-month-day'])}}
        </div> 
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Update', ['class' => 'btn btn-primary'])}}
        {!!Form::close()!!}

        <div class="text-right">
            <a  href="/issuestuds" class="btn btn-info">Back</a>
        </div>
    </div>
@endsection