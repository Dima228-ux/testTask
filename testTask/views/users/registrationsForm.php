<h1 align="center">Войти</h1>

    <div><label >Login:<input type="text" id="login" name="login" required minlength="3"/></label></div>
    <div><label >Password:<input type="password" id="password" name="password" required/></label></div>

<div><input type="button" style="color: cadetblue" name="submit" id="submit" value="Sign In" onclick="signIn()"/></div>
<form method="post" action="/users/loginForm">
<div><input style="color: cadetblue" type="submit" height="40" width="40" value="Sign Up" /></div>
</form>

<script>
    function signIn() {

        var login = $('#login').val();
        var password=$('#password ').val();

        $.ajax({
            type: "post",
            url: "/users/registrations",
            data: {
                'login': login,
                'password' : password

            },
        success: function(data) {
                console.log(data);
            if (data=='true')
                window.location.href = "/users/editProfileForm";
             else
               alert("Данный логин и пароль не существуют");
        }
        });

    }


       /* fetch("/users/loginForm",
            {
                method: "POST"

            }).then(response => {
            if (response.status !== 200) {
                return Promise.reject();
            }
            return response.json();
        })
            .then(function (data) {
                // console.log(JSON.stringify(data))
            })
            .catch(() => console.log('ошибка'));
*/
    //}
</script>
