@extends('components/layout')
@section('content')
@include('components/_navbar')

<div class="container-fluid">
    <h4 class="mt-4">Blog Posts</h4>
    @unless (count($posts)==0)

        @foreach($posts as $key => $post)
        <article>
            <div>
                <a class="text-dark" href="{{ route ('post', $post->slug) }}"><h6 style="font-weight: bold">{{$key + 1}}. {{ $post->title }} <small>(Written - {{$post->created_at->diffForHumans()}})</small></h6> </a>
                <small>Author: <a href="{{route('author', $post->author->name)}}">{{$post->author->name}}</a></small> <br>
                <small>category: <a href="{{route('category', $post->category->name)}}">{{$post->category->name}}</a></small> <br>
                <small>tags: 
                    @foreach ($post->tags as $tag)
                        <a href="{{route('tag', $tag->name)}}">, {{$tag->name}} </a>
                    @endforeach 
                </small>

                <p>{{Str::limit($post->body, 200)}}</p>

            </div>
        </article>
        <hr>
        @endforeach

        @if(request()->is('/')) 
            <p>{{$posts->links()}}</p> 
        @endif
    @else
        <p class="lead">No Blogs Available</p>
            
    @endunless
  
</div>

@endsection