@extends('layouts.admin')

@section('content')
    
    <h1>Edit Post</h1>
    <div class="row">
    <div class="col-sm-3">
		<img src="{{$post->photo ? '../../../images/'.$post->photo->file : 'https://via.placeholder.com/400x400' }}" alt="" class="img-responsive img-rounded">
    </div>
    <div class="col-md-9">
    {!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id], 'files'=>true]) !!}	
	
	<div class="form-group">
	{!! Form::label('Title','Title:')!!}
	{!! Form::text('title',null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('category_id','Category:')!!}
        {!! Form::select('category_id',$categories ,null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('photo_id','Name:')!!}
        {!! Form::file('photo_id',null,['class'=>'form-control'])!!}    
    </div>

    <div class="form-group">
        {!! Form::label('body','Description:')!!}
        {!! Form::textarea('body',null,['class'=>'form-control',])!!}    
    </div>

	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
			{!!Form::submit('Update Post',['class'=>'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
			</div>
		<div class="col-md-3">
			{!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id], 'files'=>true]) !!}	
			<div class="form-group">
				{!!Form::submit('Delete Post',['class'=>'btn btn-danger']) !!}
			</div>
			{!! Form::close() !!}
		</div>
    </div>
    </div>
    </div>
    
{!! Form::close() !!}
<div class="row">
@include('includes.form_error')
</div>
@endsection

