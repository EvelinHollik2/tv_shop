<div class="row">
    <?php
    foreach ($db->osszesTV() as $row) {
        $image = null;
        if (file_exists("./kepek/" . $row['termek_nev'] . ".jpg")) {
            $image = "./kepek/" . $row['termek_nev'] . ".jpg";
        } else if (file_exists("./kepek/" . $row['termek_nev'] . ".jpeg")) {
            $image = "./kepek/" . $row['termek_nev'] . ".jpeg";
        } else if (file_exists("./kepek/" . $row['termek_nev'] . ".png")) {
            $image = "./kepek/" . $row['termek_nev'] . ".png";
        } else if (file_exists("./kepek/" . $row['termek_nev'] . ".webp")) {
            $image = "./kepek/" . $row['termek_nev'] . ".webp";
        } else {
            $image = "./images/";
        }
        $card = '<div class="card" style="width: 18rem;">
                    <img src="'.$image.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['termek_nev'] . '</h5>' .
                '<p class="card-text">Felbontás: ' . $row['felbontas'] . '</p>' .
                '<p class="card-text">Lépátló: ' . $row['kepatlo'] . '</p>' .
                '<p class="card-text">Termék ár: ' . $row['termek_ar'] . '</p>' .
                '<a href="index.php?menu=products&id=' . $row['termekid'] . '" class="btn btn-primary">Kiválaszt</a>
                    </div>
                </div>
            ';
        echo $card;
    }
    ?>

</div>