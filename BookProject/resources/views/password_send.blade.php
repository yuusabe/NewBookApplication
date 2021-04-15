<!-- <link href="{{asset('css/login.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<main>
    
    <div id="mail">
        <form>
            <input type="email" id="email" name="email" size="50" value="abc@example.com">
        </form>
    </div>
    <div id="botton_p">
        <div id="button">
            <button type="button" class="btn btn-outline-secondary" onclick="location.href='/login'">
                キャンセル
            </button>
        </div>
        <div id="button">
            <button type="button" id="forget" class="btn btn-outline-secondary">
                送信
            </button>
        </div>
    </div>
</main>
<script src="{{asset('js/forget.js')}}"></script> -->


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
        <p>仮パスワードを発行いたします</p>
        <p>メールアドレスを入力してください</p>
    </div>

    <!-- Login Form -->
    <form name="login">
    @csrf
      <input type="text" id="email" class="fadeIn second" name="pass" placeholder="aaa123@examle.com">
      <input type="button" id="forget" class="fadeIn fourth" value="コード送信">
    </form>
      

      <!-- <button onclick="readCookie()">読み込み</button><br>
      <button onclick="deleteCookie()">削除</button><br> -->

  </div>
</div>
<script src="{{asset('js/forget.js')}}"></script>