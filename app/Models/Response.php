<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    public $replies;
    public $level = 1;
    public $array = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }

    public function responses()
    {
        return $this->hasMany('App\Response', 'parent_id')->where('discussion_id',$this->discussion_id);
    }

    /*public function nestReplies()
    {
        $responses = Response::where('parent_id', $this->id)->get();

        $id = Response::where('parent_id', $this->id)->first()->parent_id;

        $array[$id] = $responses->count();

        if ($array[$id] === 0) {

            return $responses;

        } else {

            foreach ($responses as $response) {

                --$array[$id];

                $response->nestReplies();

            }
        }
    }*/

    public function nestReplies($replies, $level)
    {
        $responses = Response::where(['parent_id'=>$this->id, 'discussion_id'=>1])->where('discussion_id',1)->get();

        $responses->each(function($reply) use ($replies, $level) {
            $reply->level = $level;
            $reply->nestReplies($replies, ++$level);
        });
    }
}
