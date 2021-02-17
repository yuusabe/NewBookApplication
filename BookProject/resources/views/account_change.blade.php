<?php $title = "DTGBOOK【アカウント編集画面】";?>
<?php $csspath = "css/account.css";?>


@extends("common.header")
@section('body')

<main>
 <!--  <form> -->
    <div id="text">
      <p>編集する内容を入力してください。</p>
    </div>
    <form method="post" action="{{ route('account_manage_change.post') }}">
      @csrf
      var_dump($a_list as $a)
      <div id=tb_p>          
          <div id="tb">
            <p>アカウント名</p>
          </div>
          <input type="text" id="tbox" name="account_name" placeholder="DTG太郎" value = "{{$input[1]}}">
          <div id="tb">
            <p>メールアドレス</p>
          </div>
          <input type="email" id="tbox" name="address" placeholder="abc@example.com" value = "{{$input[2]}}">
          <div id="tb">
            <p>パスワード</p>
          </div>
          <input type="text" id="tbox" placeholder="password">
          <div id="radio">
            <div id="tb">
              <p>管理者権限</p>
            </div>
              <input type="radio" name="accounttype" value="1">一般ユーザ
              <input type="radio" name="accounttype" value="2">管理者ユーザ
          </div>
        </div>
      <div id="button_p">
        <div id="button">
          <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/account_management'">
            キャンセル
          </button>
        </div>
        <div id="button">
          <button type="submit" class="btn btn-outline-secondary">
            更新
          </button>
        </div>
      </div>
    </form>
  <!-- </form> -->
</main>

@endsection