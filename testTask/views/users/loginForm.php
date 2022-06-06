<h1 align="center">Зарегестрироваться</h1>
<form method="post" action="/users/login">
 <div><label >Login:<input type="text" id="login" name="login" required  minlength="3" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" maxlength="30" ></div>
<div><label >Password:<input type="password" id="password " name="password" required  pattern="(?=^.{5,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[А-Z])(?=.*[a-z]).*$"></label></div>
<div><label >Name:<input type="text" id="name" name="name"  required pattern="^[а-яА-Я][а-яА-Я_\.]{1,20}$" minlength="3"></label></div>
<div><label >Email:<input type="email" id="email" name="email" required pattern="^[-\w.]+@([A-z0-9][-A-z0-9]+\."></label></div>
<div><label >Phone number:<input type="tel" id="phone" name="phone" required pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" minlength="12" placeholder="+7 (___) ___-__-__"></label></div>

<div><input style="color: cadetblue" type="submit" height="40" width="40" value="SignUp" /></div>
</form>

<script>

    $(function() {

        $("#phone").mask("+7 (999) 999-99-99");

    });


    }

</script>