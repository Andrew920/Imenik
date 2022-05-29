<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= substr(BASE_URL, 0, -10) . "static/style.css" ?>">
    <title>Seznam kontaktov</title>
</head>
<body>
    <?php if(isset($_SESSION['user'])) : ?>
        <header>
            <h1>Pozdravjen, <?= $_SESSION['user'] ?></h1>
            <h1 class="user"><a href="<?= BASE_URL . "user/logout"?>">ODJAVA</a> </h1>
        </header>
        <h1>Kontakti <button id="plus">&#43;</button></h1>
    <?php else: ?>
        <header>
            <h1 class="user left"><a href="<?= BASE_URL . "user/register"?>">REGISTRACIJA</a> </h1>
            <h1 class="user"><a href="<?= BASE_URL . "user/login"?>">PRIJAVA</a> </h1>
        </header>
        <h1>Kontakti</h1>
    <?php endif; ?>


    
    
    <div id="poisci">
        <form>
            <input type="text" id="poisci-input" placeholder="&#x1F50E;&#xFE0E;&nbsp;Poišči">
            <input type="button" id="isci" value="Išči">
            <input type="button" id="razvrsti" value="Razvrsti">
        </form>
    </div>
    
    <div id="kontakti">
        <ul id="list">
        </ul>
    </div>
    

    <form id="vnos" class="ni-vnosa" style="display: none;">
        <div>
            <button type="button" class="top" id="preklici-input">Prekliči</button>
            <div class="top" id="nov-kontakt">Nov Kontakt</div>
            <button type="button" class="top" id="potrdi-input">Končano</button>
        </div>

        <input type="text" name="ime" id="ime" placeholder="Ime">
        <input type="text" name="priimek" id="priimek" placeholder="Priimek">
        <input type="number" name="telst" id="telst" placeholder="Telefonska Številka">
        <input type="email" name="email" id="email" placeholder="eMail@example.com">
        <input type="number" name="starost" id="starost" placeholder="Starost">

        <label for="set1" class="setting">Javno In Odklenjeno</label>
        <input type="radio" id="set1" name="setting" value="1">
        <label for="set2" class="setting">Javno In Zaklenjeno</label>
        <input type="radio" id="set2" name="setting" value="2">
        <label for="set3" class="setting">Zasebno In Odklenjeno</label>
        <input type="radio" id="set3" name="setting" value="3">
        <label for="set4" class="setting">Zasebno In Zaklenjeno</label>
        <input type="radio" id="set4" name="setting" value="4">
    </form>

    <form id="uredi" class="ni-vnosa" style="display: none;">
        <div>
            <button type="button" class="top" id="preklici-uredi">Prekliči</button>
            <div class="top" id="uredi-kontakt">Uredi Kontakt</div>
            <button type="button" class="top" id="potrdi-uredi">Končano</button>
        </div>

        <input type="text" name="ime" id="ime-uredi" placeholder="Ime">
        <input type="text" name="priimek" id="priimek-uredi" placeholder="Priimek">
        <input type="number" name="telst" id="telst-uredi" placeholder="Telefonska Številka">
        <input type="email" name="email" id="email-uredi" placeholder="eMail@example.com">
        <input type="number" name="starost" id="starost-uredi" placeholder="Starost">
        <button type="button" id="izbrisi">Izbriši</button>
    </form>

    <form id="razvrsti-izbira" class="ni-razvrsti" style="display: none;">
        <button type="button" id="po-imenih">Po Imenih</button>
        <button type="button" id="po-priimkih">Po Priimkih</button>
        <button type="button" id="po-starosti">Po Starosti</button>
    </form>

    <div id="prikazi-kontakt" style="display: none;">
        <span id="prikazi-ime">Ime: test</span>
        <span id="prikazi-priimek">Priimek: tes</span>
        <span id="prikazi-telst">Telefonska številka: 1235</span>
        <span id="prikazi-email">eMail: mail@mauil</span>
        <span id="prikazi-starost">Starost: 12</span>
        <button type="button" id="pospravi">Pospravi</button>
    </div>
    
    <script src="<?= substr(BASE_URL, 0, -10) ?>static/main.js" type="module"></script>
    <script src="<?= substr(BASE_URL, 0, -10) ?>static/baza.js" type="module"></script>
</body>
</html>