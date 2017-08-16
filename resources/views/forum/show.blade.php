@extends('layouts.app')

@section('content')

    <div class="container">


        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">
                   {{$discussion->title}}
                </div>

                <div class="panel-body">

                    @foreach($responses as $response)

                        <p>{{$response->body}}</p><p>Posted By:{{$users[$response->id]}}</p>
                        <a href="/reply">Reply</a>
                        @endforeach
                    <form action="/discussion/{{ $discussion->id }}" method="post">
                    <input type="text" id="body" value="">
                        <input type="hidden" name="discussion_id" value="{{$discussion->id}}">

                        <input type="hidden" name="user_id" value="{{$userId}}">
                    </form>
                </div>
            </div>


        </div>
    </div>



    <script>
       function myFunction(){

       }
    </script>


    @stop