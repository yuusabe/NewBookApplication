$(function(){
    $('#logout').click(function(){
        if(confirm('ログアウトしますか？')){
            // APIを叩く
            $.ajax({
                type: 'GET',
                url: '/api/logout',
            // 成功時
            }).done(function(){
                window.location.href = '/login';
            }).fail(function(e){
                console.error('ログアウトエラー', e);
            });
        }else{
            return false;
        }
    });
});