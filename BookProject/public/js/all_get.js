/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/all_get.js ***!
  \*********************************/
$(function () {
  $(document).ready(function () {
    $.ajax({
      type: "GET",
      url: "/api/book/all_get"
    }).done(function (res) {
      res.data.forEach(function (element) {
        if (element.manager_flag == 1) {
          element.manager_flag = '管理者ユーザ';
        } else {
          element.manager_flag = '一般ユーザ';
        }
      });
      console.log(res);
      res.data.forEach(function (element) {
        $('#book_list').append("\n                  <div id=\"book_p\">\n                  <div id=\"book\">\n                    <img src=\"\" id=\"cover_pic\" alt=\"\u8868\u7D19\u753B\u50CF\" width=\"135\" height=\"135\" />\n                  </div>\n                  \n                  <div id=\"book\">\n                    <div id=\"text\">\n                      <p id=\"category\">\u30AB\u30C6\u30B4\u30EA</p>\n                      <p id=\"title\"></p>\n                      <p id=\"year_of_issue\"></p>\n                      <p id=\"publisher\"></p>\n                      <p id=\"logic_flag\">\u8CB8\u51FA\u72B6\u6CC1\uFF1A\u8CB8\u51FA\u53EF</p>\n                    </div>\n                  </div>\n                </div>\n                <div id=\"button_p\">\n                  <div id=\"button\">\n              \n                  <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n                    @csrf\n                    <input type = \"hidden\" name=\"number\" value=\"\">\n                      <button type=\"submit\" class=\"btn btn-outline-secondary\" name = \"info\">\n                        \u8A73\u7D30\u8868\u793A\n                      </button>\n                  </form>\n                  </div>\n                  <div id=\"button\">\n                  <form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n                    @csrf\n                    <input type = \"hidden\" name=\"number\" value=\"\">\n                    <input type = \"hidden\" name=\"path\" value=\"\"> \n                    <input type = \"hidden\" name=\"category\" value=\"\">\n                  </form>\n                  </div>\n                </div>\n                  ");
      });
    }).fail(function (e) {
      console.error("システムエラー", e);
      $('#error_text').text('アカウント一覧取得に失敗しました。');
    });
  });
});
/******/ })()
;