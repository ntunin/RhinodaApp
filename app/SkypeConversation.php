<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkypeConversation extends Model
{
    public function recipients()
    {
      return $this->belongsToMany(SkypeAccount::class);
    }

    public function messages()
    {
      return $this->belongsToMany(SkypeMessage::class);
    }
}
