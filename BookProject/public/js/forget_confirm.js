$(function(){
    $("#forget_confirm").click(function(){
        if($("#pass1").val() !== $("#pass2").val()){
            alert("パスワードを再度入力してください");
            return false;
        }
        $.ajax({
            type: "POST",
            url: "/api/login/confirm_forgot_password",
            data: {
                code: $("#code").val(),
                password: $("#pass1").val()
            },
            dataType: "json"
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case "ok":
                        console.log("パスワード変更成功");
                        console.log(res.data);
                        alert('パスワード変更に成功しました。');
                        window.location.href = "/login";
                        break;
                }
            }else if(res.code == 401){
                console.log(res);
                alert(`${res.message}`);
                window.location.href = "/login/forget";
            }else{
                $('#error_text').text(`${res.message}`);
                console.log(res.errors);
            }
        }).fail(function(e){
            $('#error_text').text('システムエラー。管理者にお問い合わせください。');
            console.error("パスワード変更エラー", e);
        });
    });
});