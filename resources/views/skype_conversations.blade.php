@extends('skype')
  @section('skype-conversion')
    <div class="position-ref dashboard skype-conversion">
      <div class="dashboard-content">
          @section('skype-conversations')
            <div class = "dashboard-menu">
              @foreach ($conversations as $indexKey => $conversation)
                <div class="dashbord-item">
                  {{ $conversation->title }}
                  <a href="{{ action('SkypeController@showMessages', ['accountId' => $skypeAccount->id, 'conversationId'=>$conversation->id]) }}" class="tap-area"></a>
                </div>
              @endforeach
            </div>
          @show
          <div class="dashbord-view">
            @yield('skype-messages')
          </div>
      </div>
    </div>
  @endsection
