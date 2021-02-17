<?php $title = "DTGBOOK【貸出画面】";?>
<?php $csspath = "css/lend.css";?>

@extends("common.header")
@section('body')
{{$num}}
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
            </div>
        </div>
    </div>
        <div id="lend">
            <p>貸出期間選択</p>
        </div>
    <form action="{{ route('book.lc_post') }}" method="post">
        @csrf
        <div id="date">
            <div class="form-group" id="datepicker-daterange">
                <div class="col-sm-9 form-inline" id="lend">
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="date" class="input-sm form-control" name="start" id="dbox" value="<?php echo date('Y年m月d日');?>"/>
                        <span class="input-group-addon" id="dbox">　〜　</span>
                        <input type="date" class="input-sm form-control" name="last" id="dbox" value="<?php echo date('Y年m月d日');?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div id="button_p">
            <div id="button">
                <input type = "hidden" name="number" value="{{$num}}">
                <button type="submit" class="btn btn-outline-secondary" name = "lend">
                    確認
                </button>
            </div>
        </form>
        <form action="{{ route('book.lc_post') }}" method="post">
            @csrf
            <input type = "hidden" name="number" value="{{$num}}">
            <div id="button">
                <button type="submit" class="btn btn-outline-secondary" name = "cancel">
                    キャンセル
                </button>
            </div>
    </form>
        </div>
</main>

@endsection