<?php $title = "DTGBOOK【書籍詳細画面】";?>
<?php $csspath = "css/information_of_book.css";?>

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
            @if($return_day == '0000年00月00日')
                <p>貸出状況：貸出可</p>
            @else
                <p>貸出状況：貸出中</p>
                <p>返却予定日：{{$return_day}}</p>
                <p>貸出者：{{$account_name}}</p>
            @endif
                
            </div>
        </div>
    </div>
    <div id="button_p">
    <form action="{{ route('book.l_post') }}" method="post">
        @csrf
        <div id="button">
            <button type="submit" class="btn btn-outline-secondary"  name = "list">
                一覧へ
            </button>
        </div>
    </form>
        <form action="{{ route('book.l_post') }}" method="post">
    @csrf
    <input type = "hidden" name="number" value="{{$num}}">
        <div id="button">
        @if($return_day == '0000年00月00日')
            <button type="submit" class="btn btn-outline-secondary" name = "lend">
                貸出手続きへ
            </button>
        @else
            <button type="submit" class="btn btn-outline-secondary" disabled>
                貸出手続きへ
            </button>
        @endif
            </form>

        </div>
    </div>
 </main>

@endsection