<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $parent_id, $discussion_id)
    {

        $file = $request->file('image');

        if ($file) {

            $imageName = $file->getClientOriginalName();

            $path = base_path() . '/public/images';


            $file->move($path, $imageName);
        }
        else{
            $imageName=null;
        }

        $response = new Response;

        $response->discussion_id = $request->get('discussion_id');
        $response->parent_id = $request->get('parent_id');
        $response->user_id = $request->get('user_id');
        $response->markdown = $request->get('markdown');
        $response->body = $request->get('body');
        $response->image = $imageName;
        $response->save();
        return Redirect::back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Response $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }


    public function editUpvote($id)
    {

        $response = Response::where('id', $id)->first();

        if ($response->users->contains(Auth::user()->id)) {
            Session::put('error', 'Hey you voted once!!');
            return Redirect::back();

        } else {
            $response->users()->attach(Auth::user()->id);
            $response->upvotes += 1;
            $response->save();
            return Redirect::back();
        }


    }

    public function editDownvote($id)
    {

        $response = Response::where('id', $id)->first();

        if (!$response->users->contains(Auth::user()->id)) {
            $response->users()->attach(Auth::user()->id);
            $response->upvotes -= 1;
            $response->save();
            return Redirect::back();
        } else {
            Session::put('error', 'Hey you voted once!!');
            return Redirect::back();
        }


    }
}
