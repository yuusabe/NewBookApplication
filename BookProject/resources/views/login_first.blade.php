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



    <!-- Login Form -->
    <form name="login">
    @csrf
      <input type="password" id="pass1" class="fadeIn second" name="pass" placeholder="パスワード">
      <input type="password" id="pass2" class="fadeIn third" name="pass" placeholder="パスワード確認">
      <input type="button" id="login_first" class="fadeIn fourth" value="パスワード変更">
    </form>
      

      <!-- <button onclick="readCookie()">読み込み</button><br>
      <button onclick="deleteCookie()">削除</button><br> -->

  </div>
</div>
<script src="{{asset('js/login_first.js')}}"></script>