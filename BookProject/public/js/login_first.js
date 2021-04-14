$(function(){
    $("#login_first").click(function(){
        if($("#pass1").val() !== $("#pass2").val()){
            $('#error_text').text('入力したパスワードが一致しておりません。');
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/api/login/first",
            data: {
                password: $("#pass1").val()
            },
            dataType: "json"
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case "ok":
                        console.log("ログイン成功");
                        console.log(res);
                        window.location.href = "/list_of_books";
                        break;
                }
            }else if(res.code == 401){
                console.log(res);
                alert('ログインしてください');
                window.location.href = "/login";
            }else{
                console.log(res.errors);
                $('#error_text').text(`${res.message}`);
            }
        }).fail(function(e){
            console.error("初回パスワード変更エラー", e);
            $('#error_text').text(`${res.message}`);
        });
    });
});