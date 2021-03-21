$(function(){
    $("#login_first").click(function(){
        if($("#pass1").val() !== $("#pass2").val()){
            alert("パスワードを再度入力してください");
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
                        console.log(res.data);
                        window.location.href = "/list_of_books";
                        break;
                }
            }else{
                console.log(res.errors);
            }
        }).fail(function(e){
            console.error("初回パスワード変更エラー", e);
        });
    });
});