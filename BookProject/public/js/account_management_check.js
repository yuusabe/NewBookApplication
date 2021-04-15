$(function(){
    $(document).ready(function(){
        const data = JSON.parse(sessionStorage.getItem("account_data"));
        $('#email').text(`メールアドレス：${data.email}`);
        $('#password').text(`仮パスワード：${data.password}`);
    });


    $("#add_account").click(function(){
        $.ajax({
            type: "POST",
            url: "/api/cognito/create_user",
            data: JSON.parse(sessionStorage.getItem("account_data")),
            dataType: "json"
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case "ok":
                        console.log(res);
                        sessionStorage.removeItem("account_data");
                        window.location.href = "/completion";
                        break;
                }
            }else if(res.code == 401){
                console.log(res);
                alert('ログインしてください');
                window.location.href = "/login";
            }else{
                console.log(res);
                $('#error_text').text(`${res.message}`);
            }
        }).fail(function(e){
            console.error("初回パスワード変更エラー", e);
            $('#error_text').text(`${res.message}`);
        });
    });
});