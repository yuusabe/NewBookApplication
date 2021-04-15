$(function(){
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "/api/book/all_get",
      }).done(function(res){
          res.data.forEach(element => {
              if(element.manager_flag == 1){
                  element.manager_flag = '管理者ユーザ';
              }else{
                  element.manager_flag = '一般ユーザ';
              }
          });
          console.log(res);
          res.data.forEach(element => {
              $('#book_list').append(
                  `
                  <div id="book_p">
                  <div id="book">
                    <img src="" id="cover_pic" alt="表紙画像" width="135" height="135" />
                  </div>
                  
                  <div id="book">
                    <div id="text">
                      <p id="category">カテゴリ</p>
                      <p id="title"></p>
                      <p id="year_of_issue"></p>
                      <p id="publisher"></p>
                      <p id="logic_flag">貸出状況：貸出可</p>
                    </div>
                  </div>
                </div>
                <div id="button_p">
                  <div id="button">
              
                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type = "hidden" name="number" value="">
                      <button type="submit" class="btn btn-outline-secondary" name = "info">
                        詳細表示
                      </button>
                  </form>
                  </div>
                  <div id="button">
                  <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type = "hidden" name="number" value="">
                    <input type = "hidden" name="path" value=""> 
                    <input type = "hidden" name="category" value="">
                  </form>
                  </div>
                </div>
                  `
              );
          });
      }).fail(function(e){
          console.error("システムエラー",e);
          $('#error_text').text('アカウント一覧取得に失敗しました。');
      });
  });
});