<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkypeConversationSkypeMessage extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('skype_conversation_skype_message', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('skype_message_id')->unsigned();
      $table->integer('skype_conversation_id')->unsigned();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::dropIfExists('skype_conversation_skype_message');
  }
}
