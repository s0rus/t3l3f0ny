<?php 
if($connect->connect_error == 1){
    $error[] = "Wystąpił błąd podczas połączenia z bazą!";
} else {

    if(isset($_POST['addmanufacturer'])){
        if(isset($_POST['manufname']) && isset($_POST['manufcity'])){
            $m_name = $_POST['manufname'];
            $m_city = $_POST['manufcity'];

            $ADD_MANUFACTURER_QUERY = "INSERT INTO producent (producent_nazwa, producent_miasto, ilosc_urzadzen) VALUES ('$m_name', '$m_city', 0)";
            if($ADD_MANUFACTURER_RESULT = $connect->query($ADD_MANUFACTURER_QUERY)){
                $success[] = "Dodano producenta do bazy!";
            }
        }
    }

    if(isset($_POST['addphone'])){
        if(isset($_POST['phonename']) && isset($_POST['manufacturername']) && isset($_POST['phoneyear']) && isset($_POST['camquantity']) && isset($_POST['cammp']) && isset($_POST['procquantity']) && isset($_POST['procghz']) && isset($_POST['memram']) && isset($_POST['memrom']) && isset($_POST['description'])){

            $p_name = $_POST['phonename'];
            $p_manufname = $_POST['manufacturername'];
            $p_year = $_POST['phoneyear'];
            $p_camquant = $_POST['camquantity'];
            $p_cammp = $_POST['cammp'];
            $p_procquant = $_POST['procquantity'];
            $p_procghz = $_POST['procghz'];
            $p_memram = $_POST['memram'];
            $p_memrom = $_POST['memrom'];
            $p_desc = $_POST['description'];
            $p_image = $_FILES['phoneimage']['name'];

            $image_ext = strtolower(pathinfo($p_image,PATHINFO_EXTENSION));

            if($image_ext == 'png'){

                $correct_image_name = str_replace(' ','_', $p_name);
                $_FILES['phoneimage']['name'] = $correct_image_name.'.png';

                $wholepath = 'images/'.$_FILES['phoneimage']['name'];
    
                $ADD_PHONE_QUERY = "INSERT INTO telefon (zdjecie, telefon_nazwa, rok_wydania, rozdzielczosc, ilosc_aparatow, taktowanie_procesora, ilosc_rdzeni, pamiec_ram, pamiec_rom, uwagi, producent_id, oceny_poz, oceny_neg) VALUES ('$wholepath', '$p_name', $p_year, $p_cammp, $p_camquant, $p_procghz, $p_procghz, $p_memram, $p_memrom, '$p_desc', $p_manufname, 0, 0)";
                if($ADD_PHONE_RESULT = $connect->query($ADD_PHONE_QUERY)){

                    $UPDATE_QUANTITY_QUERY = "UPDATE producent SET ilosc_urzadzen=ilosc_urzadzen+1 WHERE producent_id=$p_manufname";
                    if($UPDATE_QUANTITY_RESULT = $connect->query( $UPDATE_QUANTITY_QUERY)){
                        move_uploaded_file($_FILES['phoneimage']['tmp_name'], 'images/'.$_FILES['phoneimage']['name']);
                        $success[] = "Dodano telefon do bazy!";
                    } else {
                        $error[] = "Wystąpił błąd podczas dodawania pozycji do bazy danych!";
                    }

                } else {
                    $error[] = "Wystąpił błąd podczas dodawania pozycji do bazy danych!";
                }
            } else {
                $error[] = "Błędne rozszerzenie obrazu!";
            }
        }
    }
?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>DODAJ TELEFON/PRODUCENTA</h1>
        </div>

        <?php 

            foreach ($error as $key => $value) {
                ?>

                <div class="error-wrapper">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $value; ?>
                </div>

                <?php
            }

            foreach ($success as $key => $value) {
                ?>

                <div class="error-wrapper">
                <i class="far fa-check-square"></i> <?php echo $value; ?>
                </div>

                <?php
            }   
        ?>

            <form action="index.php?c=addcontent" method="POST" enctype="multipart/form-data" class="add-content-form">
            <h3>DODAJ TELEFON</h3>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="phonename">Nazwa telefonu</label><br>
                        <input type="text" name="phonename" required>
                    </div>
                    <div class="form-entry">
                        <label for="manufacturername">Producent</label><br>
                        <select name="manufacturername" class="manufacturername" required>
                            <?php

                                $MANUFACTURER_LIST_QUERY = "SELECT * FROM producent ORDER BY producent_nazwa";
                                if($MANUFACTURER_LIST_RESULT = $connect->query($MANUFACTURER_LIST_QUERY)){
                                    while($MANUFACTURER_LIST_ROW = $MANUFACTURER_LIST_RESULT->fetch_object()){
                                    ?>
                                        <option value="<?php echo $MANUFACTURER_LIST_ROW->producent_id; ?>"><?php echo $MANUFACTURER_LIST_ROW->producent_nazwa; ?></option>
                                    <?php
                                    }
                                }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="phoneimage">Zdjęcie <span class="note">(rozszerzenie PNG)</span></label><br>
                        <input type="file" name="phoneimage" required>
                    </div>
                    <div class="form-entry">
                        <label for="phoneyear">Rok wydania</label><br>
                        <input type="number" name="phoneyear" min="0" required>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="camquantity">Ilość aparatów</label><br>
                        <input type="number" name="camquantity" min="0" required>
                    </div>
                    <div class="form-entry">
                        <label for="cammp">Rozdzielczość aparatu <span class="note">(w MP)</span></label><br>
                        <input type="number" name="cammp" min="0" required>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="procquantity">Ilość rdzeni</label><br>
                        <input type="number" name="procquantity" min="0" required>
                    </div>
                    <div class="form-entry">
                        <label for="procghz">Taktowanie procesora <span class="note">(w GHz)</span></label><br>
                        <input type="number" name="procghz" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="memram">Pamięć RAM <span class="note">(w GB)</span></label><br>
                        <input type="number" name="memram" min="0" required>
                    </div>
                    <div class="form-entry">
                        <label for="memrom">Pamięć ROM <span class="note">(w GB)</span></label><br>
                        <input type="number" name="memrom" min="0" required>
                    </div>
                </div>
                <div class="form-entry" style="width: 99%; margin: 5px auto;">
                        <label for="description">Uwagi</label><br>
                        <textarea name="description" class="description"  maxlength ="100" placeholder="Maksymalnie 100 znaków."></textarea>
                </div>
                <input type="submit" value="DODAJ" name="addphone" class="addcontent">
            </form>

            <form action="index.php?c=addcontent" method="POST" class="add-content-form">
            <h3>DODAJ PRODUCENTA</h3>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="manufname">Nazwa producenta</label><br>
                        <input type="text" name="manufname" required>
                    </div>
                    <div class="form-entry">
                        <label for="manufcity">Miasto</label><br>
                        <input type="text" name="manufcity" required>
                    </div>
                </div>
                <input type="submit" value="DODAJ" name="addmanufacturer" class="addcontent">
            </form>

</div>

<?php
}
?>
