<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{

    public $replies;
    public $level = 1;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion(){
        return $this->belongsTo('App\Discussion');
    }

    public function nestReplies($replies, $level)
    {
        $this->replies = $replies->where('parent_id', $this->id);

        $this->replies->each(function($reply) use ($replies, $level) {
            $reply->level = $level;
            $reply->nestReplies($replies, ++$level);
        });
    }
}
