<?php $title = "DTGBOOK【アカウント登録確認画面】";?>
<?php $csspath = "css/account_check.css";?>

@extends("common.header")
@section('body')


<main>
    <form method="post" action="{{ route('account_manage.send') }}">
      @csrf
      <div id="account">
          <p>アカウント名　　：{{ $input["account_name"] }}</p>
          <p>メールアドレス　：{{ $input["address"] }}</p>
          <p>パスワード　　　：{{ $input["password"] }}</p>
          <p>アカウントタイプ：{{ $input["accounttype"] }}</p>
      </div>
      <div id="text">
          <p>アカウント登録の内容はこちらでよろしいですか。</p>
      </div>
      <div id="button_p">
          <div id="button">
              <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/account_management'">
                  キャンセル
              </button>
          </div>
          <div id="button">
          <button type="submit" class="btn btn-outline-secondary">
              <!-- <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/completion'"> -->
                  確定
              </button>
          </div>
      </div>
    </form>
</main>

@endsection