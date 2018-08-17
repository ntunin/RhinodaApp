<?php

namespace App\Http\Controllers;

use Validator;
use Redirect;
use Auth;
use Input;
use DB;
use App\User;
use App\SkypeAccount;
use App\SkypeConversation;
use App\SkypeMessage;
use Illuminate\Http\Request;

class SkypeController extends Controller
{
    public function showConversations($id) {
      $account = SkypeAccount::findOrFail($id);
      $user = Auth::user();
      $skypeAccounts =$user->skypeAccounts()->get();
      $conversations = $account->conversations()->get();
      return view('skype_conversations', [
        'skypeAccounts'=>$skypeAccounts,
        'skypeAccount'=>$account,
        'conversations'=>$conversations
      ]);
    }

    public function showMessages($accountId, $conversationId) {
      $account = SkypeAccount::findOrFail($accountId);
      $user = Auth::user();
      $skypeAccounts =$user->skypeAccounts()->get();
      $conversations = $account->conversations()->get();
      $conversion = $account->conversations()->find($conversationId);
      $messages = $conversion->messages()->get();
      return view('skype_messages', [
        'skypeAccounts'=>$skypeAccounts,
        'skypeAccount'=>$account,
        'conversations'=>$conversations,
        'messages'=>$messages
      ]);
    }

    public function showAccounts() {
      $user = Auth::user();
      $skypeAccounts =$user->skypeAccounts()->get();
      return view('skype', ['skypeAccounts'=>$skypeAccounts]);
    }

    public function deleteAccount($id) {
      $account = SkypeAccount::findOrFail($id);
      $users = $account->users()->get();
      foreach ($users as $user) {
        $user->skypeAccounts()->detach($account->id);
      }
      $account->delete();
      return Redirect::to('skype');
    }

    public function addMessage(Request $request) {
      $rules = [
          'text' => 'required',
          'author' => 'required',
          'conversation_id' => 'required',
          'conversation_title' => 'required',
          'recipients' => 'required'
      ];
      $response = array('data' => '', 'success'=>false);
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        $response['data'] = $validator->messages();
      }else{
        $conversation = $this->getOrCreateConversationForRequest($request);
        $account = SkypeAccount::where('name', '=', "ntunin")->first();
        $message = $this->createMessageForRequest($request);
        $this->attachConversetionToUsers($request, $conversation);
        $this->attachMessageToConversation($message, $conversation);
        $response['data'] = $message;
        $response['success'] = true;
      }
      return $response;
    }

    private function getOrCreateConversationForRequest(Request $request) {
      $skypeConversationId = $request->input('conversation_id');
      $skypeConversationTitle = $request->input('conversation_title');
      $conversation = SkypeConversation::where('skype_conversation_id', '=', $skypeConversationId)->first();
      if(!$conversation) {
          $conversation = new SkypeConversation();
          $conversation->skype_conversation_id = $skypeConversationId;
          $conversation->title = $skypeConversationTitle;
          $conversation->save();
      }
      return $conversation;
    }

    private function attachConversetionToUsers(Request $request, SkypeConversation $conversation) {
      $this->attachConversetionToRecipients($request, $conversation);
      $this->attachConversetionToAuthor($request, $conversation);
    }

    private function attachConversetionToRecipients(Request $request, SkypeConversation $conversation) {
      $recipients = $request->input('recipients');
      foreach($recipients as $name) {
        $this->attachConversetionToAccountWithName($conversation, $name);
      }
    }

    private function attachConversetionToAuthor(Request $request, SkypeConversation $conversation) {
      $name = $request->input('author');
      $this->attachConversetionToAccountWithName($conversation, $name);
    }

    private function attachConversetionToAccountWithName(SkypeConversation $conversation, $name) {
      $account = SkypeAccount::where('name', '=', $name)->first();
      if(!$account) {
        return;
      }
      $savedConversation = $account->conversations()->find($conversation->id);
      if($savedConversation) {
        return;
      }
      $account->conversations()->attach($conversation);
    }


    private function createMessageForRequest(Request $request) {
      $text = $request->input('text');
      $message = new SkypeMessage();
      $message->text = $text;
      $message->save();
      return $message;
    }

    private function attachMessageToConversation(SkypeMessage $message, SkypeConversation $conversation){
      $conversation->messages()->attach($message);
    }
}
