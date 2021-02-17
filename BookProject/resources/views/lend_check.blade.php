<?php $title = "DTGBOOK【貸出確認画面】";?>
<?php $csspath = "css/lend.css";?>

@extends("common.header")
@section('body')

<main>
    <div id="book_p">
        <div id="book">
            <img src="image/book_001.png" id="image" alt="表紙画像" width="135" height="130" />
        </div> 
        <div id="book">
            <div id="text">
                <p id="title">タイトル：{{$book_data->title}}</p>
                <p>発行年：{{$book_data->year_of_issue}}</p>
                <p>著者：{{$book_data->Author}}</p>
                <p>出版社：{{$book_data->publisher}}</p>
            @if($category_name == 'a')
                <p>カテゴリ：分類なし</p>
            @else
                <p>カテゴリ：{{$category_name}}</p>
            @endif
                <p>貸出期間：{{$start}} 〜 {{$last}}</p>
            </div>
        </div>
    </div>
    <div id="lend">
        <p>貸出書籍の内容はこれでよろしいでしょうか。</p>
    </div>
    <div id="button_p">
        <div id="button">
            <button type="button" class="btn btn-outline-secondary" name = "cancel">
                キャンセル
            </button>
        </div>
        <div id="button">
            <button type="button" class="btn btn-outline-secondary" name = "lend">
                確定
            </button>
        </div>
    </div>
</main>

@endsection