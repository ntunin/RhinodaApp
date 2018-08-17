@extends('dashboard')
@section('content')
<div class="position-ref dashboard skype">
  <div class="dashboard-content">
      @section('skype-accounts')
        <div class = "dashboard-menu">
          @foreach ($skypeAccounts as $indexKey => $skypeAccount)
            <div class="dashbord-item">
              {{ $skypeAccount->name }}
              <a href="{{ action('SkypeController@showConversations', ['id' => $skypeAccount->id]) }}" class="tap-area"></a>
            </div>
          @endforeach
        </div>
      @show
      <div class="dashbord-view">
        @yield('skype-conversion')
      </div>
  </div>
</div>
@endsection
