<?php $title = "DTGBOOK【アカウント管理画面】";?>
<?php $csspath = "css/account.css";?>
<?php $jspath = "js/account_management.js";?>

@extends("common.header")
@section('body')

<main>
  <form>
    @csrf
    <!-- <form action="https://www-cf.dtg-shosekikanri2020-test.tk/account_management_check" method="get"> -->
    <div id="text">
      <p>登録する内容を入力してください。</p>
    </div>
    
      
    <div id=tb_p>
      <div>
        <div id="tb">
          <p>アカウント名</p>
        </div>
        <input type="text" id="tbox" class="account_name" name="account_name" placeholder="DTG太郎">
      </div>
      <div>
        <div id="tb">
          <p>メールアドレス</p>
        </div>
        <input type="email" id="tbox" class="email" name="address" placeholder="abc@example.com" required="required">
      </div>
      <div>
        <div id="tb">
          <p>パスワード</p>
        </div>
        <input type="text" id="tbox" class="password" name="password" placeholder="password" required="required">
      </div>
      <div id="radio">
        <div id="tb">
          <p>管理者権限</p>
        </div>
          <input type="radio" name="accounttype" value="0">一般ユーザ
          <input type="radio" name="accounttype" value="1">管理者ユーザ
      </div>
    </div>
    <div id="button_p">
      <div id="button">
        <button type="button" id="add_account" class="btn btn-outline-secondary" name = "add">
          アカウント登録
        </button>
      </div>
      <p id="error_text"></p>
    </div>
  </form>

  <div id="text">
    <p>アカウント一覧</p>
  </div>

  <div id="account_p">
    <div id="account">
      <nobr id="a_text">
      </nobr>
    </div>
    <div id="account">
      <div id="button_p">
        <form>
          @csrf
          
          <div id="button">
            <button type="submit" class="btn btn-outline-secondary" name = "change">
              編集
            </button>
          </div>
        </form>
        <div id="button">
          <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/account_delete_check'">
            削除
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- </form> -->
</main>

@endsection