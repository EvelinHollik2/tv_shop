<?php

if (filter_input(INPUT_POST,
                'belepesiAdatok',
                FILTER_VALIDATE_BOOLEAN,
                FILTER_NULL_ON_FAILURE)) {
    //-- A kapott adatok feldolgozása    
    $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    $username = htmlspecialchars(filter_input(INPUT_POST, 'username'));
    $pass = htmlspecialchars(filter_input(INPUT_POST, 'password'));

    if ($db->login($username, $pass)) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = '';
        $_SESSION['password'] = '';
        header("Location: index.php");  
    }
}
?>
<div class="container">
    <form action="#" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail cím:</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Felhasználó név</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary" name="belepesiAdatok" value="true">Belépés</button>
    </form>
    <a href="index.php?menu=regist">Regisztráció</a> 
</div>