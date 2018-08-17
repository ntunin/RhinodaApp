<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkypeMessageSkypeConversationTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('skype_message_skype_conversation', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('skype_account_id')->unsigned();
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
      Schema::dropIfExists('skype_message_skype_conversation');
  }
}
