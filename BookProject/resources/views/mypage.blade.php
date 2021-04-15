<?php $title = "DTGBOOK【マイページ】";?>
<?php $csspath = "css/mypage.css";?>

@extends("common.header")
@section('body')

<main>
    <div id="account_p">
        <div id="text">
            <p>アカウント登録情報</p>
        </div>
        <div id="account">
            <p>アカウント名：</p>
            <p>メールアドレス：</p>
            <p>パスワード：</p>
        </div>
    </div>
    <div id="boo">
        <button type="button" class="btn btn-outline-secondary" onclick="location.href='/password_change'">
            パスワード変更
        </button>
    </div>
    <div id="text">
        <p>貸出中書籍</p>
    </div>
    <div id="book_p">
        <?php
            // $lcheck =  $_COOKIE["lcheck"];

            // if ($lcheck == "1")
            // {
            //     echo '<div id="book">
            //             <img src="image/book_001.png" id="image" alt="アイコン" width="135" height="130" />
            //         </div>
            //         <div id="book">
            //             <p>タイトル：{{$bdata -> title}}</p>
            //             <p>発行年：{{$bdata -> year_of_issue}}</p>
            //             <p>著者：{{$bdata -> Author}}</p>
            //             <p>返却期限：{{$ldata -> return_day}}</p>
            //         </div>';
            // }
        ?>
    </div>
    <div id="boo">
        <button type="button" class="btn btn-outline-secondary" onclick="location.href='/return_book'">
            返却手続きへ
        </button>
    </div>
</main>

@endsection