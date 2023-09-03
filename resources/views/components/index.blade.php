@extends('welcome')
@section('content')
    <div>
        <a href="#">hello there</a><br>
        <center>
            @foreach ($post as $_post)
                <br>{{ $_post->title }}
                <div >{{ $_post->user->name }}</div>
            @endforeach

        </center>

        <!--all of the blade components weather it has classes to render the view or not(anonymous) we can render it using <x .. />
@endsection
