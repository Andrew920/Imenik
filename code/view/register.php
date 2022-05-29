<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= substr(BASE_URL, 0, -10) . "static/style.css" ?>">

    <title>Register</title>
</head>
<body>
    <h1>Register</h1><br>
    <?= $napaka ?><br><br>
    <form action="<?= BASE_URL . "user/register"?>" method="post">
    <label for="ime">Uporabnisko ime</label><br>
    <input type="text" id="ime" name="user"><br>
    <label for="geslo">Geslo</label><br>
    <input type="password" id="geslo" name="geslo"><br>
    <label for="ponovitev">Ponovi geslo</label><br>
    <input type="password" id="ponovitev" name="ponovitev"><br>
    <input type="submit">
</form>
</body>
</html>