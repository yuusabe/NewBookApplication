$(function(){
    $('#password_change').click(function(){
        // APIを叩く
        if($('#proposed_password').val() != $('#confirm_password').val()){
            $('#error_text').html(`入力されたパスワードと確認用パスワードが一致していません。<br>再度入力してください。`);
            return;
        }
        $.ajax({
            type: 'POST',
            url: '/api/cognito/change_password',
            data: {
                previous_password: $('#previous_password').val(),
                proposed_password: $('#proposed_password').val()
            },
            // dataType: 'application/json'
        // 成功時
        }).done(function(res){
            if(res.code == 200){
                console.log(res);
                // window.location.href = '/completion';
            }else if(res.code == 400){
                console.log(res);
            }else{
                console.log(res.errors);
                $('#error_text').text(`${res.message}`);
            }
        // 失敗時
        }).fail(function(e){
            console.error('パスワード変更エラー', e);
            $('#error_text').text('システムエラー。管理者に問い合わせてください。');
        });
    });
});