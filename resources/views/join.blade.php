@extends('index')

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="background">

  <div class="top_header">
    <h2 class="title">Golf Score Share</h2>
    <a href="/golf" class="home_btn"><span>> Homeへ</span></a>
  </div>

  <div class="form_wrapper">
    <form action="{{ route('room.check') }}" method="POST">
    @csrf
      <!-- ゲーム名またはパスワードが一致しない場合のフラッシュメッセージ -->
      @if(session('message'))
      <div class="alert alert-danger">
        {{ session('message') }}
      </div>
      @endif
      <div class="form_item">
        <p>ゲーム名</p>
        <input type="text" name="name" placeholder="○○カントリー △△コンペ"></input>
      </div>
      <div class="form_item">
        <p>パスワード</p>
        <input type="password" name="password" required="required"></input>
      </div>
      <div class="button_panel">
        <input class="submit_btn" type="submit" title="Start a new game" value="Join the game"></input>
      </div>
    </form>
  </div>
</div>
@endsection
