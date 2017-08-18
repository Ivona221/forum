<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Category;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //show all discussions in a table
    public function index()
    {

        $discussions=Discussion::all();

        foreach ($discussions as $discussion){

            $user_id=$discussion->user_id;
            $name=User::where('id',$user_id)->first()->name;
            $posted[$discussion->id]=$name;
            $replies[$discussion->id]=Response::where('discussion_id',$discussion->id)->get()->count();



        }

        $categories=Category::all();

        return view('forum.index', compact('discussions','posted','categories','replies'));

    }

    public function byCat($id){
        $discussions=Discussion::where('category_id',$id)->get();

        foreach ($discussions as $discussion){

            $user_id=$discussion->user_id;
            $name=User::where('id',$user_id)->first()->name;
            $posted[$discussion->id]=$name;
            $replies[$discussion->id]=Response::where('discussion_id',$discussion->id)->get()->count();



        }

        $categories=Category::all();

        return view('forum.index', compact('discussions','posted','categories','replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $discussion=new Discussion;
        $discussion->category_id=$request->get('category_id');
        $discussion->title=$request->get('title');
        $slug=$request->get('title');
        $discussion->slug=$slug;
        $discussion->user_id=Auth::user()->id;
        $discussion->save();

        return Redirect::back();


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $discussion=Discussion::where('id',$id)->first();

        $userId=Auth::user()->id;

        $responses=Response::where('discussion_id',$discussion->id)->where('parent_id',0)->get();

        foreach(Response::all() as $response){
            $user_id=$response->user_id;
            $name=User::where('id',$user_id)->first()->name;
            $users[$response->id]=$name;
        }

        return view('forum.show', compact('discussion', 'userId', 'responses', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        //
    }


}
