jQuery(function($) {
    'use strict';
  
    /*
      今日の日付データを変数todayに格納
     */
    var optionLoop, this_year, today;
    today = new Date();
    this_year = today.getFullYear();
  
    /*
      ループ処理（スタート数字、終了数字、表示id名、デフォルト数字）
     */
    optionLoop = function(start, end, id, this_day) {
      var i, opt;
  
      opt = null;
      for (i = start; i <= end ; i++) {
        if (i === this_day) {
          opt += "<option value='" + i + "' selected>" + i + "</option>";
        } else {
          opt += "<option value='" + i + "'>" + i + "</option>";
        }
      }
      return document.getElementById(id).innerHTML = opt;
    };
  
  
    /*
      関数設定（スタート数字[必須]、終了数字[必須]、表示id名[必須]、デフォルト数字[省略可能]）
     */
    optionLoop(1950, this_year, 'id_year', this_year);
});