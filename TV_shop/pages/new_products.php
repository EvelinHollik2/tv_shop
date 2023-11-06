<?php
if (filter_input(INPUT_POST, "insert", FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)) {
    $adatok = $_POST;
    $termekid = filter_input(INPUT_POST, "termekid", FILTER_SANITIZE_NUMBER_INT);
    $termek_nev = htmlspecialchars(filter_input(INPUT_POST, "termek_nev"));
    $felbontas = filter_input(INPUT_POST, "felbontas");
    $kepatlo = filter_input(INPUT_POST, "kepatlo");
    $termek_ar = filter_input(INPUT_POST, "termek_ar");
    $from = null;
    $to = null;
    if ($_FILES['kepfajl']['error'] == 0) {
        $kiterjesztes = null;
        switch ($_FILES['kepfajl']['type']) {
            case 'image/png':
                $kiterjesztes = ".png";
                break;
            case 'image/jpeg':
                $kiterjesztes = ".jpg";
                break;
            case 'image/webp':
                $kiterjesztes = ".webp";
                break;
            default:
                break;
        }
        $from = $_FILES['kepfajl']['tmp_name'];
        $to = dir(getcwd());
        $to = $to->path . DIRECTORY_SEPARATOR . "tvkepek" . DIRECTORY_SEPARATOR . $termek_nev . $kiterjesztes;
        if (copy($from, $to)) {
            echo '<p>A kép feltöltés sikeres</p>';
        } else {
            echo '<p>A kép feltöltés sikertelen!</p>';
        }
    }
    if ($db->setKivalasztottTV($termek_nev, $felbontas, $kepatlo, $termek_ar)) {
        echo '<p>Az adatok módosítása sikeres</p>';
        //header("Location: index.php?menu=products");
    } else {
        echo '<p>Az adatok módosítása sikertelen!</p>';
    }
} else {
    //$adatok = $db->getKivalasztottTV(1);
    $adatok["termekid"]="";
    $adatok["termek_nev"]="";
    $adatok["felbontas"]="";
    $adatok["kepatlo"]="";
    $adatok["termek_ar"]="";
}
?>
<form method="post" action="index.php?menu=new_products" enctype="multipart/form-data">
    <input type="hidden" name="termekid" value="<?php echo $adatok['termekid']; ?>">
    <div class="mb-3">
        <label for="termek_nev" class="form-label">Termék neve</label>
        <input type="text" class="form-control" name="termek_nev" id="termek_nev" value="<?php echo $adatok['termek_nev']; ?>">
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <label for="felbontas" class="form-label">Felbontás</label>
            <input type="text" class="form-control" name="felbontas" id="felbontas" value="<?php echo $adatok['felbontas']; ?>">
        </div>
        <div class="mb-3 col-6">
            <label for="kepatlo" class="form-label">Képátló</label>
            <input type="text" class="form-control" name="kepatlo" id="kepatlo" value="<?php echo $adatok['kepatlo']; ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="termek_ar" class="form-label">Termék ár</label>
        <input type="text" class="form-control" name="termek_ar" id="termek_ar" value="<?php echo $adatok['termek_ar']; ?> ">
    </div>
    
    <div class="row">
        <div class="mb-3 col-4">
            <label for="kepfajl" class="form-label">Képfájl</label>
            <input type="file" class="form-control" name="kepfajl" id="kepfajl" value="">
        </div>
    </div>
    <button type="submit" class="btn btn-success" value="true" name="insert">Rögzítés</button>
</form>

