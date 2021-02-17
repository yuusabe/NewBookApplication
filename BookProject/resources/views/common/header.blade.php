<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <!-- viewport meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href=<?=$csspath?>>
    <link rel="stylesheet" href="css/header.css">
    <style>
        body {background-color: #b3ffff;}
        header {background-color: #fffef4;}
        main {background-color: #b3ffff;}
    </style>
    <title><?=$title?></title>
</head>
<body>
    <header class="header_button">
            <div id="pine">
                <img src="image/dtg_book_logo.png" alt="アイコン" width="135" height="130" />

                <?php
                if (!empty($_COOKIE["mflag"]))
                {
                  $mflag = $_COOKIE["mflag"];
                }
                else
                {
                    $mflag = "なし";
                }
                if (!empty($_COOKIE["aname"]))
                {
                  $aname = $_COOKIE["aname"];
                }
                else
                {
                    $aname = "なし";
                }

                if ($mflag == "1")
                {
                    echo '<img src="image/administrator_logo.png" alt="アイコン" width="150" height="150" />';
                }
                else
                {
                    echo '<img src="image/user_logo.png" alt="アイコン" width="150" height="150" />';
                }

                echo $aname."さん";

                ?>

            </div>
            <div id="pine">
                <div id="h_button">
                    <?php
                    if ($mflag == "1")
                    {
                        echo '<button type="button" id="button" class="btn btn-outline-danger" onclick="location.href=\'https://www-cf.dtg-shosekikanri2020-test.tk/RPA\'">
                                    貸出情報
                                </button>
                                <button type="button" id="button" class="btn btn-outline-danger" onclick="location.href=\'https://www-cf.dtg-shosekikanri2020-test.tk/book_add\'">
                                    書籍登録
                                </button>
                                <button type="button" id="button" class="btn btn-outline-danger" onclick="location.href=\'https://www-cf.dtg-shosekikanri2020-test.tk/category\'">
                                    カテゴリ管理
                                </button>
                                <button type="button" id="button" class="btn btn-outline-danger" onclick="location.href=\'https://www-cf.dtg-shosekikanri2020-test.tk/account_management\'">
                                    アカウント管理
                                </button>';
                    }
                    ?>
                    <button type="button" id="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/list_of_books'">
                        書籍一覧
                    </button>
                    <button type="button" id="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/mypage'">
                        マイページ
                    </button>
                    <button type="button" id="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/login'">
                        ログアウト
                    </button>
                </div>
            </div>
    </header>
@yield('body')
<footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src=<?=$jspath ?? ''?>></script>
</footer>
</body>