@extends('layouts.admin')

@section('content')
    
    <h1>Posts</h1>
    <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Author</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th></th>
                <th></th>
                <th>Created</th>
                <th>Updated</th>
              </tr>
            </thead>
            <tbody>
                @if ($posts)
                @foreach ($posts as $post)
              <tr>
                <td>{{$post->id}}</td>
                <td><img height="50" src="{{$post->photo ? '../images/'.$post->photo->file :'https://via.placeholder.com/400x400'}} " alt="" srcset=""></td>
                <td><a href="{{route('posts.edit',$post->id )}}">{{$post->user->name}}</a></td>
                <td>{{$post->category ? $post->category->name : 'uncategorized'}}</td>
                <td>{{$post->title}}</td>
                <td>{{str_limit($post->body,7)}}</td>
                <td><a href="{{route('home.post',$post->id)}}">View Post </a></td>
                <td><a href="{{route('comments.show', $post->id)}}">View Comments</a></td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>

@endsection

