@extends('layouts.app')

@section('css')
<style>
    .comment-replies{
        margin-left: 20px;
    }
</style>
    @stop

@section('content')

    <div class="container">


        <div class="col-sm-offset-2 col-sm-8 ">
            <div class="panel panel-default bg-info">
                <div class="panel-heading bg-warning">
                   {{$discussion->title}}<a onclick="myFunction(0,'{{$discussion->id}}')">Reply</a>
                </div>

                <div class="panel-body">

                    <div id="comments" class="container" style="width:100%">

                        @each('forum.partials.single', $discussion->getDiscussion(), 'response')
                    </div>




               <div id="hidden" style="display:none; " class="form-group" >
                    <form id="myForm" action="" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}

                        <span onclick="closeModal()" class="glyphicon glyphicon-remove" style="float:right;"></span>
                        <textarea class="form-control" id="comment" name="body" rows="3" placeholder="Enter your reply..."></textarea>

                        <input id="discussion_id" type="hidden" name="discussion_id" value="">



                        <input type="hidden" id="notForDB" name="notForDB" value="">

                        <input id="parent_id" type="hidden" name="parent_id" value="">

                        <input id="user_id" type="hidden" name="user_id" value="{{Auth::user()->id}}">

                        <input id="markdown"  name="markdown" value="" type="hidden">
                        <input type="file" name="image"/>

                        <button type="submit">Post a reply</button>
                    </form>

                    </div>
                </div>
            </div>


        </div>
    </div>




@section('js')
    <script>
       function myFunction(parent_id, discussion_id){
           document.getElementById('hidden').style.display='block';
           document.getElementById('parent_id').value=parent_id;
           document.getElementById('discussion_id').value=discussion_id;
           document.getElementById('notForDB').value=parent_id;
           document.getElementById('myForm').action='/discussion/'+parent_id+'/'+discussion_id;
       }

       function closeModal(){
           document.getElementById('hidden').style.display='none';
       }

       function markdownFunction(){

           alert(document.getElementById('text').innerHTML);

       }

       var text='';
       $('#comment').keydown( function(e) {

var id=$('#notForDB').val();


           if(/~(.*?)~/gi.test(this.value)||/\*(.*?)\*/gi.test(this.value)||
               /_(.*?)_/gi.test(this.value)||/(#+)(.*?)[\n\r]/gi.test(this.value)){

               text=this.value.replace(/~(.*?)~/gi, '<span style="text-decoration:line-through">$1</span>')
                   .replace(/\*(.*?)\*/gi, '<span style="font-style: italic">$1</span>')
                   .replace(/_(.*?)_/gi, '<span style="font-style: italic">$1</span>')
                   .replace(/(#+)(.*?)[\n\r]/gi,  function(match, capture, capture2){return '<h'+capture.length+'>'+capture2+'</h'+capture.length+'>'});
           }





           else text=this.value;


           $('#text'+id).empty().append(text);

           $('#markdown').val($('#text'+id).html() );


       });
    </script>



@stop


    @stop