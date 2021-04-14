<?php $title = "DTGBOOK【パスワード設定画面】";?>
<?php $csspath = "css/password_change.css";?>
<?php $jspath = "js/password_change.js";?>

@extends("common.header")
@section('body')

<main>
    <div id="oldpass">
        <p>
            <div id="text">
                現在のパスワードを入力してください
            </div>
            <form>
                <input type="password" id="previous_password" name="old_pass" size="50" minlength="8">
            </form>
        </p>
    </div>
    <div id="newpass">
        <p>
            <div id="text">
                新しいパスワードを入力してください
            </div>
            <form>
                <input type="password" id="proposed_password" name="new_pass" size="50" minlength="8">
            </form>
        </p>
    </div>
    <div id="newpass">
            <div id="text">
                確認のためもう一度入力してください
            </div>
            <form>
                <input type="password" id="confirm_password" name="new_pass" size="50" minlength="8">
            </form>
    </div>
    <div id="button_p">
        <div id="button">
            <button type="button" class="btn btn-outline-secondary" onclick="location.href='/mypage'">
                キャンセル
            </button>
        </div>
        <div id="button">
            <button type="button" id='password_change' class="btn btn-outline-secondary">
                設定
            </button>
        </div>
        <div>
            <p id='error_text'></p>
        </div>
    </div>
</main>
<!-- <script src="{{asset('js/password_change.js')}}"></script> -->
@endsection