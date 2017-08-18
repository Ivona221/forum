<div class="panel-group" >
    <div class=" panel panel-default " >
        @if ($message = Session::get('error'))
            <div class="custom-alerts alert alert-danger fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                {!! $message !!}
            </div>
            <?php Session::forget('error');?>
        @endif
    <div class="panel-heading">{{ $response->user->name }} {{$response->upvotes}}

        <a href="/upvote/{{$response->id}}"><span class="glyphicon glyphicon-arrow-up"></span></a>

        <a href="/downvote/{{$response->id}}"><span class="glyphicon glyphicon-arrow-down"></span></a>

    </div>

    <div class="pannel-body">@if($response->markdown&& ($response->markdown!=$response->body)){!! $response->markdown !!} @else {{ $response->body}}@endif<a style="float:right;"  onclick="myFunction('{{$response->id}}','{{$response->discussion_id}}')">Reply</a>
        <div  id="text{{$response->id}}" style="border:1px solid darkred;display:none;" contenteditable="true" ></div>
        <br>
        @if($response->image)
            <img height="150px" width="150px" src="{{asset('images/'.$response->image)}}">
            @endif
        <div class="comment-replies ">
            <!-- style of this div is indented to look nested -->
            @each('forum.partials.single', $response->responses, 'response')
        </div>
    </div>



    </div>
</div>