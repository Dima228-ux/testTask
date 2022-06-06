<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link rel="stylesheet" href="/public/vendors/bootstrap502/css/bootstrap.css"/>

    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="/public/vendors/bootstrap502/js/bootstrap.bundle.js"></script>

</head>
<body>
<div class="container py-3">

    <form method='post' id="exit" name="exit" action='/users/registrationsForm' >
        <input style="color:Red" type='submit' align="right" value='Выйти'>
    </form>

    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom" align="center">
            <h1 class="h3 mb-3 fw-normal" align="center" > Test Task </h1>


        </div>


    </header>


    <main>
        <?php require_once './views/' . $contentPage . '.php'; ?>
    </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3 text-muted">&copy; 2017–2022</small>
            </div>
        </div>

    </footer>

</div>

</body>
</html>