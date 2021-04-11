$(function(){
    $("#forget").click(function(){
        if(!$("#email").val()){
            alert("メールアドレスを入力してください");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/api/login/forgot_password",
            data: {
                email: $("#email").val()
            },
            // dataType: "json"
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case "ok":
                        console.log("コード送信完了");
                        console.log(res.data);
                        window.location.href = "/login/forget/confirm";
                        break;
                }
            }else{
                console.log(res.errors);
            }
        }).fail(function(e){
            console.error("コード送信エラー", e);
        });
    });
});