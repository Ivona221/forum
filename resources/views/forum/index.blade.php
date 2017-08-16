@extends('layouts.app')


@section('content')
    @foreach($discussions as $discussion)

    <div class="container">


        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">
                  <a href="/discussion/{{$discussion->id}}"> {{$discussion->title}}</a>
                </div>

                <div class="panel-body">
                   Posted by:{{ $posted[$discussion->id] }}  {{$discussion->created_at->diffForHumans()}}
                </div>
            </div>


        </div>
    </div>


    @endforeach

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




@endsection

