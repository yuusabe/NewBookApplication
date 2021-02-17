<?php $title = "DTGBOOK【カテゴリ管理画面】";?>
<?php $csspath = "css/category.css";?>
<?php $jspath = "js/add_del.js";?>

@extends("common.header")
@section('body')

<main>
    <div id="text">
        <p>カテゴリを追加してください。</p>
    </div>
    <div id="category_a">
        <div id="category">
            <input type="text" id="textbox" name="category" class="form-control" placeholder="入力して下さい">
        </div>
    </div>
    <div id="text">
        <p>カテゴリを編集してください。</p>
    </div>
    <div id="category_p">
        <div id="category_ch">
            <input type="text" id="textbox_ch" name="category" class="form-control">
        </div>
        <div id="category_ch">
            <div id="button_p">
                <div id="button">
                    <button type="buuton" class="btn btn-outline-secondary">
                        編集
                    </button>
                </div>
                <div id="button">
                    <button type="button" class="btn btn-outline-secondary">
                    削除
                </button>
            </div>
        </div>
    </div>
</main>

@endsection