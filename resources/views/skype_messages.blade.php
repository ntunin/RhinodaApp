@extends('skype_conversations')
  @section('skype-messages')
    <div class="position-ref skype-messages">
      @foreach ($messages as $indexKey => $messages)
        <div class="skype-message">
          {{ $messages->text }}
        </div>
      @endforeach
    </div>
  @endsection
