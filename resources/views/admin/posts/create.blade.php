@extends('layouts.admin')

@section('content')
    
    <h1>Create Post</h1>
    {!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store', 'files'=>true]) !!}	
	
	<div class="form-group">
	{!! Form::label('Title','Title:')!!}
	{!! Form::text('title',null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('category_id','Category:')!!}
        {!! Form::select('category_id',array(1 =>'PHP',2=>'Laravel' ),null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('photo_id','Name:')!!}
        {!! Form::file('photo_id',null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('body','Description:')!!}
        {!! Form::textarea('body',null,['class'=>'form-control',])!!}    
    </div>

	<div class="form-group">
	{!!Form::submit('Create User',['class'=>'btn btn-primary']) !!}
    </div>
    
{!! Form::close() !!}
<div class="row">
@include('includes.form_error')
</div>
@endsection

