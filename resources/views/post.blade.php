@extends('components/layout')
@section('content')
@include('components/_navbar')

    <div class="container mt-3">
            <h5>{{ $post->title }} </h5>
      
            <p>Authored By: {{$post->author->name}}</p>
            <p>Category: {{$post->category->name}}</p>
            <p>Written : {{$post->created_at->diffForHumans()}}</p>
            <div>
                <p>{{ $post->body }}</p>
            </div>

            <a href="{{route ('posts')}}">Home </a>

    </div >

@endsection
