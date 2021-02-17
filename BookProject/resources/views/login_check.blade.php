<link href="css/login.css" rel="stylesheet" id="bootstrap-css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->




<script type="text/javascript">
      // cookieの値を読み書きする要素
      var email = document.getElementById("email");
      var pass = document.getElementById("pass");

      // 書き込み
      function writeCookie() {
        var email_v = email.value;
        var pass_v = pass.value;
        document.cookie = "email=" + email_v + "; domain=www-cf.dtg-shosekikanri2020-test.tk; path=/";
        document.cookie = "pass=" + pass_v + "; domain=www-cf.dtg-shosekikanri2020-test.tk; path=/";
        console.log(document.cookie);
      }

      function readCookie() {
        var tmp = document.cookie;
        var email_v = document.cookie.replace(/(?:(?:^|.*;\s*)email\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        var pass_v = document.cookie.replace(/(?:(?:^|.*;\s*)pass\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        email.value = email_v;
        pass.value = pass_v;
        console.log(document.cookie);
      }
</script>

    <!-- Login Form -->
    <p>{{$adata -> account_name}}さん、いらっしゃいませ</p>
    <form>
      <input type="button" value="書籍一覧へ" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/list_of_books'">
    </form>

    <p>  </p>


  </div>
</div>