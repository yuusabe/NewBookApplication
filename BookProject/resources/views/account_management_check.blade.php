<?php $title = "DTGBOOK【アカウント登録確認画面】";?>
<?php $csspath = "css/account_check.css";?>
<?php $jspath = "js/account_management_check.js";?>

@extends("common.header")
@section('body')


<main>
    <form>
      @csrf
      <div id="account">
          <p>アカウント名：</p>
          <p id="email"></p>
          <p id="password"></p>
          <p>アカウントタイプ：</p>
      </div>
      <div id="text">
          <p>アカウント登録の内容はこちらでよろしいですか。</p>
      </div>
      <div id="button_p">
          <div id="button">
              <button type="button" class="btn btn-outline-secondary" onclick="location.href='/account_management'">
                  キャンセル
              </button>
          </div>
          <div id="button">
          <button type="button" id="add_account" class="btn btn-outline-secondary">
              <!-- <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/completion'"> -->
                  確定
            </button>
          </div>
          <p id="error_text"></p>
      </div>
    </form>
</main>

@endsection