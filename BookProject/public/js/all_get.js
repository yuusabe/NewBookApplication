/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/all_get.js ***!
  \*********************************/
var url = 'http://homestead-two.test/api/book/all_get'; //操作したいHTML領域を取得

var title = document.getElementById('title');
var year_of_issue = document.getElementById('year_of_issue'); //APIからJSONデータを取得する

fetch(url).then(function (response) {
  return response.json(); //ここでBodyからJSONを返す
}).then(function (result) {
  Example(result); //取得したJSONデータを関数に渡す
})["catch"](function (e) {
  console.log(e); //エラーをキャッチし表示
}); //JSONデータを引数に受け取ってDOM操作を行う関数を作成

function Example(jsonObj) {
  console.log(jsonObj);
  var data = jsonObj.data;
  title.textContent = data[0].title;
  year_of_issue.textContent = '発行年： ' + data[0].year_of_issue + '年';
}
/******/ })()
;