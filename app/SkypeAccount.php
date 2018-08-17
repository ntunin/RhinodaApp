<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkypeAccount extends Model
{
  public function users()
  {
    return $this->belongsToMany(User::class);
  }

  public function conversations()
  {
    return $this->belongsToMany(SkypeConversation::class);
  }
}
