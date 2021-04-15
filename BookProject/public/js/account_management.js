$(function(){
    $(document).ready(function(){
        const data = JSON.parse(sessionStorage.getItem("account_data"));
        $('.email').val(`${data.email}`);
        $('.password').val(`${data.password}`);
    });

    $('#add_account').click(function(){
        const email = $('.email').val();
        const password = $('.password').val();
        if(!email || !password){
            $('#error_text').text('必須項目に入力してください。');
            return;
        }
        const data = {
            'email': email,
            'password': password
        };
        sessionStorage.setItem("account_data", JSON.stringify(data));
        window.location.href = '/account_management_check';
    });
});