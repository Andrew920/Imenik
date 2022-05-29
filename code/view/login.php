<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= "http://" . $_SERVER['SERVER_NAME'] ?>/velika-naloga3/static/style.css">

    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form action="<?= BASE_URL . "user/login" ?>" method="post">
        <input type="text" name="user">
        <input type="password" name="pass">
        <input type="submit">
    </form>
</body>
</html>