const url = 'http://homestead-two.test/api/book/all_get';

//操作したいHTML領域を取得
const title = document.getElementById('title');
const year_of_issue = document.getElementById('year_of_issue');
const publisher = document.getElementById('publisher');
const logic_flag = document.getElementById('logic_flag');

//APIからJSONデータを取得する
fetch(url)
   .then(response => {
       return response.json(); //ここでBodyからJSONを返す
   })
   .then(result => {
       Example(result);  //取得したJSONデータを関数に渡す
   })
   .catch(e => {
       console.log(e);  //エラーをキャッチし表示
})
//JSONデータを引数に受け取ってDOM操作を行う関数を作成
function Example(jsonObj){
  console.log(jsonObj);
  const data = jsonObj.data;
  title.textContent = data[0].title;
  year_of_issue.textContent = '発行年： ' + data[0].year_of_issue + '年';
  publisher.textContent = '出版社： ' + data[0].publisher
}