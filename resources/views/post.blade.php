@extends('layouts.blog-post')

@section('content')
    
 <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{'../images/'.$post->photo->file}} ? {{'../images/'.$post->photo->file}}:$post->photo->placeholder" alt="">

                <hr>

                <!-- Post Content -->
                {{-- not filtering to show images from the WYSIWYG editor --}}
                <p class="lead">{!! $post->body !!}</p>

                <hr>
                @if (Session::has('comment_message'))
                    {{session('comment_message')}}
                @endif
                <!-- Blog Comments -->

                @if(Auth::check())
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}	
                     <input type="hidden" name="post_id" value="{{$post->id}}">   
                    <div class="form-group">
                        {!! Form::label('title','Comment:')!!}
                        {!! Form::textarea('body',null,['class'=>'form-control','rows'=>'6'])!!}    
                        </div>
                        <div class="form-group">
                            {!!Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}

                </div>
                @endif 
                <hr>

                <!-- Posted Comments -->
                @if(count($comments)>0)
                @foreach ($comments as $comment)
                    
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" class="media-object" src="Auth::user()->gravatar" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$comment->body}}</p>
                        
                        @if(count($comment->replies)>0)
                        @foreach ($comment->replies as $reply)
                        @if($reply->is_active==1)
                        
                        <!-- Nested Comment -->
                        <div class="nested-media media ">
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{'../images/'.$reply->photo}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                <p>{{$reply->body}}</p>
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                        @endif
                        @endforeach
                        @endif
                        <p><button class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#reply" aria-expanded="false" aria-controls="multiCollapseExample2">Reply</button></p>
                        <br>
                        <div class="collapse multi-collapse col-md-offset-2 col-md-6" id="reply">  
                        {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}	
                     <input type="hidden" name="comment_id" value="{{$comment->id}}">   
                    <div class="form-group">
                        {!! Form::label('body','Body:')!!}
                        {!! Form::textarea('body',null,['class'=>'form-control','rows'=>'2'])!!}    
                        </div>
                        <div class="form-group">
                            {!!Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                        </div>

                    </div>
                </div>
                
                @endforeach
                @endif
@endsection
