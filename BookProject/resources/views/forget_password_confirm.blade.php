<link href="{{asset('css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="{{asset('image/dtg_book_logo.png')}}" id="icon" alt="アイコン" />
    </div>

    <div id="text">
        <p>送信された検証コードと新しいパスワードを設定してください。</p>
    </div>

    <!-- Login Form -->
    <form name="login">
    @csrf
      <input type="text" id="code" class="fadeIn second">
      <input type="password" id="pass1" class="fadeIn second" name="pass" placeholder="パスワード">
      <input type="password" id="pass2" class="fadeIn third" name="pass" placeholder="パスワード確認">
      <input type="button" id="forget_confirm" class="fadeIn fourth" value="パスワード変更">
    </form>
    <p id="error_text"></p>
      

      <!-- <button onclick="readCookie()">読み込み</button><br>
      <button onclick="deleteCookie()">削除</button><br> -->

  </div>
</div>
<script src="{{asset('js/forget_confirm.js')}}"></script>