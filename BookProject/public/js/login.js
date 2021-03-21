$(function(){
    $("#login").click(function(){
        $.ajax({
            type: "POST",
            url: "/api/login",
            data: {
                email: $("#email").val(),
                password: $("#pass").val()
            },
            dataType: "json"
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case "ok":
                        console.log("ログイン成功");
                        window.location.href = "/list_of_books";
                        break;
                    case "First Login":
                        console.log("初回ログイン");
                        console.log(res.data);
                        window.location.href = "/login/first"
                        break;
                }
            }else{
                console.log(res.errors);
            }
        }).fail(function(e){
            console.error("ログインエラー", e);
        });
    });
});