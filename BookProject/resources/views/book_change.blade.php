<?php $title = "DTGBOOK【書籍編集画面】";?>
<?php $csspath = "css/book.css";?>
<?php $jspath = "js/date.js";?>

@extends("common.header")
@section('body')

<main>
    <div id="text">
        <p>編集する書籍の内容を入力してください。</p>
    </div>
    <form action="{{ route('book.check_post') }}" method="post" enctype="multipart/form-data">
            @csrf
    <div id="b_info">
        <div id="b_image">
            <label>
                <span class="btn btn-outline-secondary">
                    ファイルを選択してください
                    <input type="file" id="b_image" accept="image/*" style="display:none">
                </span>
            </label>
            <p>
                <div id="image">プレビュー:</div><br>
                <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" style="max-width:220px;">
                </p>
                <script>
                // fileAPIでの画像プレビュー
                function previewImage(obj)
                {
                    var fileReader = new FileReader();
                    fileReader.onload = (function() {
                        document.getElementById('preview').src = fileReader.result;
                    });
                    fileReader.readAsDataURL(obj.files[0]);
                }
                </script>
                <!-- <p>
                    <input type="submit" value="アップロード">
                </p> -->
        </div>
    </div>
    <div id="b_info">
        
            <div id="tbox">
                　　　　　　タイトル
                <input type="text" name="title" placeholder="タイトルを入力してください" id="b_tbox" value="{{$b_data->title}}">
            </div>
            <div id="tbox">
                タイトル（フリガナ）
                <input type="text" name="title_h" placeholder="タイトルのフリガナを入力してください" id="b_tbox" value="{{$b_data->title_furigana}}">
            </div>
            <div id="tbox">
                <label>
                    <span class="btn btn-outline-ssecondary">
                        　　　　　　　発行年
                        <select name="year" id="id_year" value="{{$b_data->year_of_issue}}">
                        </select>
                    </span>
                </label>
            </div>
            <div id="tbox">
                　　　　　　　　著者
                <input type="text" name="author" placeholder="著者を入力してください" id="b_tbox" value="{{$b_data->Author}}">
            </div>
            <div id="tbox">
                　　著者（フリガナ）
                <input type="text" name="author_h" placeholder="著者のフリガナを入力してください" id="b_tbox" value="{{$b_data->Author_furigana}}">
            </div>
            <div id="tbox">
                　　　　　　　出版社
                <input type="text" name="publisher" placeholder="出版社を入力してください" id="b_tbox" value="{{$b_data->publisher}}">
            </div>
            <div id="tbox">
                <label>
                    <span class="btn btn-outline-ssecondary">
                        　　　　　　カテゴリ
                        <select name="category" id="b_cbox" multiple>
                            <option value="">選択してください
                            @foreach($category_all as $c)
                            <option value="">{{$c['category_name']}}
                            <!-- <option value="1">統計学
                            <option value="2">AI -->
                            @endforeach
                        </select>
                    </span>
                </label>
            </div>
        
    </div>
    <div id="button_p">
            <div id="button">
                <button type="submit" class="btn btn-outline-secondary" name = "change" disabled>
                    書籍編集
                </button>
            </div>
        </form>
        <form action="{{ route('book.check_post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type = "hidden" name="number" value="{{$num}}">
            <div id="button">
                <button type="submit" class="btn btn-outline-secondary" name = "cancel">
                キャンセル
                </button>
            </div>
        </form>
        <form action="{{ route('book.check_post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type = "hidden" name="number" value="{{$num}}">
            <div id="button">
                <button type="submit" class="btn btn-outline-secondary" name = "delete">
                    削除
                </button>
            </div>
        </form>
    </div>
</main>

@endsection