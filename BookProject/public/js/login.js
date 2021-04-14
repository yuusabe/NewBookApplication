$(function(){
    $('#login').click(function(){
        // APIを叩く
        $.ajax({
            type: 'POST',
            url: '/api/login',
            data: {
                email: $('#email').val(),
                password: $('#pass').val()
            },
            dataType: 'json'
        // 成功時
        }).done(function(res){
            if(res.code == 200){
                switch(res.message){
                    case 'ok':
                        console.log('ログイン成功');
                        window.location.href = '/list_of_books';
                        break;
                    case 'First Login':
                        console.log('初回ログイン');
                        console.log(res.data);
                        window.location.href = '/login/first'
                        break;
                }
            }else if(res.code == 500){
                console.log(res.errors)
                $('#login_error').text(`${res.message}`);
            }else{
                console.error(res.errors);
                $('#login_error').text(`${res.message}`);
            }
        // 失敗時
        }).fail(function(e){
            console.error('ログインエラー', e);
        });
    });
});