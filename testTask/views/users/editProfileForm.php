<?php $session = $data; session_start()?>

<h1 align="center">Edit Profile form</h1>
<form method="post" action="/users/editProfile" >
    <input type='text' value="<?=$_SESSION['user']['id']?>" hidden="hidden" name='id'>
    <div ><label style="size:4px">Name user:<input  type="text" name="name"  value="<?=$_SESSION['user']['name']?>" minlength="3" required pattern="^[а-яА-Я][а-яА-Я_\.]{1,20}$"/></label></div>
    <div><label>Email:<input type="email" name="email" value="<?=$_SESSION['user']['email']?> "required pattern="^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$"></label></div>
    <?php foreach ($data as $sessions): ?>
    <div><label>Phone:<input type="tel" name="phones[]" value="<?=$sessions->Phone?>" required pattern="^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$" required minlength="12" placeholder="+7 (___) ___-__-__"/></label></div>
    <?php endforeach; ?>
    <div><input style="color: cadetblue" type="submit" value="Edit information"></div>

</form>
<form method="post" action="/phones/addPhonesForm" >
<div><input style="color: cadetblue" type="submit" value="Add phones"></div>
</form>
