@extends('layouts.app')

@section('css')
    <style>
        #cat0{
            background-color: #777;
        }
        #cat1{
            background-color: #d9534f;
        }
        #cat2{
            background-color: #5cb85c;
        }
        #cat3{
            background-color: #f0ad4e;
        }

        a{
            text-decoration: none;
        }

        a:hover{
            text-decoration: none;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 3; /* Sit on top */
            left: 0;
            top: 60px;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }



        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }



        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }


    </style>
    @stop

@section('content')


    <a onclick="openFunction()"><div style=" background-color:#f0ad4e;color:whitesmoke; width:180px;padding: 5px; margin-left:30px; border-radius:5px; margin-bottom:7px;"><span class="glyphicon glyphicon-plus"></span> NEW DISCUSSION</div></a>

    <div style="float:left; padding-left:30px; width:50px;">
        <p id="cat0" style="border-radius:10px;display:inline;  color:transparent">gg</p><p style="display:inline; margin-left: 5px;font-size:17px"><a href="/forum">All</a></p><br>
@foreach($categories as $category)
    <p id="cat{{$category->id}}" style="border-radius:10px;display:inline;  color:transparent">gg</p><p style="display:inline; margin-left: 5px;font-size:17px"><a href="/byCategory/{{$category->id}}">{{ucfirst($category->name)}}</a></p><br>
    @endforeach
    </div>
    <div id="myModal" class="modal" >

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeFun()">&times;</span>
            <form class="form-horizontal" action="/create" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Enter the discussion:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="discussion" name="title" rows="3" placeholder="Enter the discussion..."></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="pwd">Choose a category:</label>
                    <div class="col-sm-8">
                        <select id="select" class="form-control">
                            <option selected disabled>Choose a category</option>
                            <option id="1">General</option>
                            <option id="2">Introduction</option>

                        </select>

                        <input type="hidden" class="form-control" id="pwd"  name="category_id">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    @foreach($discussions as $discussion)

    <div class="container">


        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">
                  <a href="/discussion/{{$discussion->id}}"> {{$discussion->title}} <span @if($discussion->category->name=='introduction') class="label label-success" @elseif($discussion->category->name=='general')class="label label-danger" @elseif( $discussion->category->name=='laravel') @endif>{{$discussion->category->name}}</span></a><span style="float:right;" class="glyphicon glyphicon-comment"> {{$replies[$discussion->id]}} </span>
                </div>

                <div class="panel-body">
                   Posted by:{{ $posted[$discussion->id] }}  {{$discussion->created_at->diffForHumans()}}
                </div>
            </div>


        </div>
    </div>
<script>
    $(document).ready(function(){
        $('#select').change(function(){
            if(this.value==='Introduction'){
            $('#pwd').val('2');}
            if(this.value==='General'){
                $('#pwd').val('1');
            }

        });
    });
</script>

    @endforeach

@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function openFunction(){
document.getElementById('myModal').style.display='block';
    }

    function closeFun(){
        document.getElementById('myModal').style.display='none';
    }



</script>

@stop
@stop

