<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function responses(){
        return $this->hasMany('App\Response');
    }

    public function getDiscussion()
    {
        $allComments = $this->responses()->with('user')->get();
        $rootComments = $allComments->where('parent_id', null); // filter collection

        return $rootComments->each(function($comment) use ($allComments) {
            $comment->nestReplies($allComments, 2);
         });
    }


}