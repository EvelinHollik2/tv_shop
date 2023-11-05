<?php
if (filter_input(INPUT_POST, "regisztraciosAdatok", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $error = false;
    $errormessage = "";
    $pass1 = filter_input(INPUT_POST, "InputPassword");
    $pass2 = filter_input(INPUT_POST, "InputPassword2");
    $username = htmlspecialchars(filter_input(INPUT_POST, "username"));
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if ($pass1 != $pass2) {
        $error = true;
        $errormessage .= '<p>Nem egyeznek a jelszavak!</p>';
    } else if ($username == null) {
        $error = true;
        $errormessage .= '<p>Nem megfelelő felhasználónév</p>';
    }

    if ($error) {
        echo $errormessage;
    } else {
        //-- regisztrációs adatok kiírása
        $db->regist($email, $username, $pass1);
        header("Location:index.php"); //-- átvált a nyitólapra
    }
}
?>
<div class="col-8 mt-4 mx-auto">
    <form action="#" method="post" class="row needs-validation" novalidate>
        <div class="row">
            <div class="mb-3 col-7 has-validation">
                <label for="email" class="form-label">Email cím</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Kapcsolattartási célból.</div>
                <div class="invalid-feedback">Email cím megadása nélkül nem tudjuk önnel felvenni a kapcsolatot!</div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Felhasználó név</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
                <div id="usernameHelp" class="form-text">Bejelentkezéshez használt azonosító.</div>
            </div>
            <div class="row">
                <div class="mb-3 col-6">
                    <label for="InputPassword" class="form-label">Jelszó</label>
                    <input type="password" class="form-control" id="InputPassword" name="InputPassword" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="InputPassword2" class="form-label">Jelszó még egyszer</label>
                    <input type="password" class="form-control" id="InputPassword2" name="InputPassword2" required>
                </div>
            </div>
            <button type="submit" class="col-2 mx-auto btn btn-outline-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
        </div> 
    </form>
</div>
<script>
    var passwordInputs = document.querySelectorAll("input[type=password]");
    function validPass(password) {
        console.log(password);
        let theLength = /.{6,32}/;
        let lowerCase = /[a-z]/;
        let upperCase = /[A-Z]/;
        let digit = /[0-9]/;
        let specialChars = /^[a-zA-Z0-9]/;
        if (theLength.test(password) &&
                lowerCase.test(password) &&
                upperCase.test(password) &&
                digit.test(password) &&
                specialChars.test(password)) {
            return true;
        } else {
            return false;
        }
    }

    function passStrength(password) {
        let strength = password.length;

    }

</script>