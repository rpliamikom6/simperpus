<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #FF8C00;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 16px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover,
    .form button:active,
    .form button:focus {
        background: #FF8C00;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }
</style>
<div class="login-page">
    <div class="form">
        <h2 class="text-center">LOGIN</h2>
        <div class="login-form">
            <input type="text" id="field_username" placeholder="NIM/NI K" name="username">
            <input type="password" id="field_password" placeholder="Password" name="password">
            <button type="button" id="button_login">login</button>
        </div>
        <script>
            $('#button_login').click(function(){
                var username=$('#field_username').val();
                var password=$('#field_password').val();
                if(/^[A-B][0-9]{2}\.[0-9]{2}\.[0-9]{4}$/.test(username)==true){
                    $.ajax({
                        url: 'http://mhsmobile.amikom.ac.id/login?username='+username+'&keyword='+password,
                        type: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "User-Agent": "@m!k0mXv=#neMob!le",
                            "Accept-Encoding": "gzip"
                        },
                        contentType: false,
                        processData: false,
                        success: function(data){
                            alert(data);
                        }
                    })


                    const settings = {
                        "async": true,
                        "crossDomain": true,
                        "url": "http://mhsmobile.amikom.ac.id/login",
                        "method": "POST",
                        "headers": {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "User-Agent": "@m!k0mXv=#neMob!le",
                            "Accept-Encoding": "gzip"
                        },
                        "data": {
                            "username": username,
                            "keyword": password
                        }
                    };

                    $.ajax(settings).done(function (response) {
                        console.log(response);
                    });
                }
                else{
                    const form = new FormData();
                    form.append("username", username);
                    form.append("password", password);
                    $.ajax({
                        url: '<?=base_url("login");?>',
                        data: form,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        success: function(data){
                            alert(data);
                        }
                    })
                }
            })
        </script>
    </div>
</div>