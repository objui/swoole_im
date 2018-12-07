var login_token = window.sessionStorage.getItem('login_token');
if(login_token == null || login_token =='' || login_token == 'undefined'){
    top.location.href="login.html";
}

