<?php $title = "DTGBOOK【貸出情報画面】";?>
<?php $csspath = "css/RPA.css";?>

@extends("common.header")
@section('body')
<main>
  <table border="1" id="apple">
    <thead>
      <tr>
        <th id="user">ユーザ</th>
        <th id="mail">メールアドレス</th>
        <th id="title">書籍タイトル</th>
        <th id="day">書籍返却期日</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>佐藤美緑</td>
        <td>minosatou@pasona.tech</td>
        <td>みのりの本</td>
        <td>2020年11月26日</td>
      </tr>
      <tr>
        <td>阿部雄介</td>
        <td>yuusabe@pasona.tech</td>
        <td>あべちゃんの本あべちゃんの本あべちゃんの本あべちゃんの本あべちゃんの本</td>
        <td>2020年11月13日</td>
      </tr>
    </tbody>
  </table>
 </main> 

@endsection