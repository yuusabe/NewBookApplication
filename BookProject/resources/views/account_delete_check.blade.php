<?php $title = "DTGBOOK【アカウント削除確認画面】";?>
<?php $csspath = "css/account_check.css";?>

@extends("common.header")
@section('body')
<main>
  <div id="account">
    <p>アカウント名：</p>
    <p>メールアドレス：</p>
    <p>アカウントタイプ：</p>
  </div>
  <div id="text">
    <p>削除するアカウント情報はこちらでよろしいでしょうか。</p>
  </div>
  <div id="button_p">
    <div id="button">
      <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/completion'">
        確定
      </button>
    </div>
    <div id="button">
      <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/account_management'">
        キャンセル
      </button>
    </div>
  </div>
</main>

@endsection