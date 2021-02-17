<?php $title = "DTGBOOK【アカウント管理画面】";?>
<?php $csspath = "css/account.css";?>

@extends("common.header")
@section('body')

<main>
  <form method="post" action="{{ route('account_manage.post') }}">
    @csrf
    <!-- <form action="https://www-cf.dtg-shosekikanri2020-test.tk/account_management_check" method="get"> -->
    <div id="text">
      <p>登録する内容を入力してください。</p>
    </div>
    
      
    <div id=tb_p>
      <div>
        <div id="tb">
          <p>アカウント名</p>
        </div>
        <input type="text" id="tbox" name="account_name" placeholder="DTG太郎">
      </div>
      <div>
        <div id="tb">
          <p>メールアドレス</p>
        </div>
        <input type="email" id="tbox" name="address" placeholder="abc@example.com">
      </div>
      <div>
        <div id="tb">
          <p>パスワード</p>
        </div>
        <input type="text" id="tbox" name="password" placeholder="password">
      </div>
      <div id="radio">
        <div id="tb">
          <p>管理者権限</p>
        </div>
          <input type="radio" name="accounttype" value="一般ユーザ">一般ユーザ
          <input type="radio" name="accounttype" value="管理者ユーザ">管理者ユーザ
      </div>
    </div>
    <div id="button_p">
      <div id="button">
        <button type="submit" class="btn btn-outline-secondary" name = "add">
          アカウント登録
        </button>
      </div>
    </div>
  </form>

  <div id="text">
    <p>アカウント一覧</p>
  </div>

  @foreach($a_list as $a)
  <div id="account_p">
    <div id="account">
      <nobr id="a_text">
      @if($a->manager_flag == FALSE)
      {{$a->account_name }}：一般ユーザ
      @else
      {{$a->account_name }}：管理者ユーザ
      @endif
      </nobr>
    </div>
    <div id="account">
      <div id="button_p">
        <form method="post" action= "{{ route('account_manage.post') }}">
          @csrf
          <input type = "hidden" name="account_number" value="{{$a->account_number}}">
          <input type = "hidden" name="account_name" value="{{$a->account_name}}">
          <input type = "hidden" name="mail_address" value="{{$a->mail_address}}">
          <input type = "hidden" name="manager_flag" value="{{$a->manager_flag}}">
          
          <div id="button">
            <button type="submit" class="btn btn-outline-secondary" name = "change">
              編集
            </button>
          </div>
        </form>
        <div id="button">
          <button type="button" class="btn btn-outline-secondary" onclick="location.href='https://www-cf.dtg-shosekikanri2020-test.tk/account_delete_check'">
            削除
          </button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <!-- </form> -->
</main>

@endsection