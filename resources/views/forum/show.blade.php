@extends('layouts.app')

@section('content')

    <div class="container">


        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">
                   {{$discussion->title}}
                </div>

                <div class="panel-body">

                    <div id="comments">
                        {{$discussion->id}}
                        @each('forum.partials.single', $discussion->getDiscussion(), 'response')
                    </div>


                    @foreach($responses as $response)
                        {{-- show the comment markup --}}
                       <div>{{$response->body}}</div>

                        @if($response->responses)
                            {{-- recursively include this view, passing in the new collection of comments to iterate --}}
                            @include('forum.partials.show', ['responses' => $response->responses])
                        @endif
                    @endforeach


                   {{-- <form action="/discussion/{{ $discussion->id }}" method="post">
                    <input type="text" id="body" value="">
                        <input type="hidden" name="discussion_id" value="{{$discussion->id}}">

                        <input type="hidden" name="user_id" value="{{$userId}}">
                    </form>--}}
                </div>
            </div>


        </div>
    </div>



    <script>
       function myFunction(){

       }
    </script>


    @stop