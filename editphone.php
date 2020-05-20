<?php 
if($connect->connect_error == 1){
    $error[] = "Wystąpił błąd podczas połączenia z bazą!";
} else {

?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>EDYTUJ TELEFON</h1>
        </div>

        <div class="edit-wrapper">
            <form action="index.php" method="GET">
            <input type="hidden" name="c" value="editphone">
            <select name="phoneid" onchange="this.form.submit()">
            <?php if(!isset($_GET['phoneid'])){echo '<option value="0">Wybierz telefon</option>';} ?>
                <?php
                $phoneid = $_GET['phoneid'];
                $PHONE_EDIT_QUERY = "SELECT * FROM telefon";
                if($PHONE_EDIT_RESULT = $connect->query($PHONE_EDIT_QUERY)){
                    while($PHONE_EDIT_ROW = $PHONE_EDIT_RESULT->fetch_object()){
                        ?>
                            <option value="<?php echo $PHONE_EDIT_ROW->telefon_id ?>" <?php if((isset($_GET['phoneid'])) && $_GET['phoneid'] == $PHONE_EDIT_ROW->telefon_id){echo 'selected';} ?>><?php echo '#'.$PHONE_EDIT_ROW->telefon_id.' '.$PHONE_EDIT_ROW->telefon_nazwa ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            </form>

        </div>

        <?php 

                if(!isset($_GET['phoneid'])){
                    ?>
                        <div class="edit-info">
                        <i class="fas fa-info-circle"></i> Wybierz telefon z listy, aby go edytować.
                        </div>
                    <?php
                }

                if(isset($_GET['phoneid'])){
                    if($_GET['phoneid'] == 0){
                        header('Location: index.php?c=editphone');
                    }

                    $PHONE_INFO_QUERY = "SELECT * FROM telefon INNER JOIN producent USING (producent_id) WHERE telefon_id={$_GET['phoneid']}";
                    if($PHONE_INFO_RESULT = $connect->query($PHONE_INFO_QUERY)){
                        while($PHONE_INFO_ROW = $PHONE_INFO_RESULT->fetch_object()){
                            $old_name = $PHONE_INFO_ROW->telefon_nazwa;
                            $old_manufacturer = $PHONE_INFO_ROW->producent_id;
                            $old_phoneyear = $PHONE_INFO_ROW->rok_wydania;
                            $old_cammp = $PHONE_INFO_ROW->rozdzielczosc;
                            $old_camquantity = $PHONE_INFO_ROW->ilosc_aparatow;
                            $old_procghz = $PHONE_INFO_ROW->taktowanie_procesora;
                            $old_procquantity = $PHONE_INFO_ROW->ilosc_rdzeni;
                            $old_memram = $PHONE_INFO_ROW->pamiec_ram;
                            $old_memrom = $PHONE_INFO_ROW->pamiec_rom;
                            $old_desc = $PHONE_INFO_ROW->uwagi;
                            $old_imagepath = $PHONE_INFO_ROW->zdjecie;
                        }
                    } else {
                        $error[] = "Wystąpił błąd podczas wyświetlania danych!";
                    }

        ?>

            <form action="index.php?c=editphone" method="POST" enctype="multipart/form-data" class="add-content-form">
            <h3>EDYCJA TELEFONU #<?php echo $phoneid ?></h3>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="phonename">Nazwa telefonu</label><br>
                        <input type="text" name="phonename" required <?php echo 'value="';if(isset($old_name)){echo $old_name;} else {header('Location: index.php?c=editphone');}echo '"'; ?>>
                    </div>
                    <div class="form-entry">
                        <label for="manufacturername">Producent</label><br>
                        <select name="manufacturername" class="manufacturername" required>
                            <?php

                                $MANUFACTURER_LIST_QUERY = "SELECT * FROM producent ORDER BY producent_nazwa";
                                if($MANUFACTURER_LIST_RESULT = $connect->query($MANUFACTURER_LIST_QUERY)){
                                    while($MANUFACTURER_LIST_ROW = $MANUFACTURER_LIST_RESULT->fetch_object()){
                                    ?>
                                        <option value="<?php echo $MANUFACTURER_LIST_ROW->producent_id;?>"<?php if($MANUFACTURER_LIST_ROW->producent_id==$old_manufacturer){echo 'selected';}?>><?php echo $MANUFACTURER_LIST_ROW->producent_nazwa;?></option>
                                    <?php
                                    }
                                } else {
                                    $error[] = "Wystąpił błąd podczas wyświetlania danych!";
                                }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="phoneimage">Zdjęcie <span class="note">(rozszerzenie PNG)</span></label><br>
                        <input type="file" name="phoneimage">
                    </div>
                    <div class="form-entry">
                        <label for="phoneyear">Rok wydania</label><br>
                        <input type="number" name="phoneyear" min="0" required <?php echo 'value="'.$old_phoneyear.'"'; ?>>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="camquantity">Ilość aparatów</label><br>
                        <input type="number" name="camquantity" min="0" required <?php echo 'value="'.$old_camquantity.'"'; ?>>
                    </div>
                    <div class="form-entry">
                        <label for="cammp">Rozdzielczość aparatu <span class="note">(w MP)</span></label><br>
                        <input type="number" name="cammp" min="0" required <?php echo 'value="'.$old_cammp.'"'; ?>>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="procquantity">Ilość rdzeni</label><br>
                        <input type="number" name="procquantity" min="0" required <?php echo 'value="'.$old_procquantity.'"'; ?>>
                    </div>
                    <div class="form-entry">
                        <label for="procghz">Taktowanie procesora <span class="note">(w GHz)</span></label><br>
                        <input type="number" name="procghz" min="0" step="0.01" required <?php echo 'value="'.$old_procghz.'"'; ?>>
                    </div>
                </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="memram">Pamięć RAM <span class="note">(w GB)</span></label><br>
                        <input type="number" name="memram" min="0" required <?php echo 'value="'.$old_memram.'"'; ?>>
                    </div>
                    <div class="form-entry">
                        <label for="memrom">Pamięć ROM <span class="note">(w GB)</span></label><br>
                        <input type="number" name="memrom" min="0" required <?php echo 'value="'.$old_memrom.'"'; ?>>
                    </div>
                </div>
                <div class="form-entry" style="width: 99%; margin: 5px auto;">
                        <label for="description">Uwagi</label><br>
                        <textarea name="description" class="description"  maxlength ="100" placeholder="Maksymalnie 100 znaków."><?php echo $old_desc; ?></textarea>
                </div>
                <input type="hidden" name="pid" value="<?php echo $phoneid; ?>">
                <input type="hidden" name="old_manuf" value="<?php echo $old_manufacturer; ?>">
                <input type="hidden" name="old_phoneimage" value="<?php echo $old_imagepath; ?>">
                <input type="submit" value="EDYTUJ" name="editphoneproc" class="addcontent">
            </form>

</div>
<?php
                }

                if(isset($_POST['editphoneproc'])){
                    if(isset($_POST['pid'])){$pid = $_POST['pid'];}
                    if(isset($_POST['phonename'])){$new_name = $_POST['phonename'];}else{$new_name = $old_name;}
                    if(isset($_POST['manufacturername'])){$new_manufacturer = $_POST['manufacturername'];}else{$new_manufacturer = $old_manufacturer;}
                    if(isset($_POST['phoneyear'])){$new_phoneyear = $_POST['phoneyear'];}else{$new_phoneyear = $old_phoneyear;}
                    if(isset($_POST['camquantity'])){$new_camquantity = $_POST['camquantity'];}else{$new_camquantity = $old_camquantity;}
                    if(isset($_POST['cammp'])){$new_cammp = $_POST['cammp'];}else{$new_cammp = $old_cammp;}
                    if(isset($_POST['procquantity'])){$new_procquantity = $_POST['procquantity'];}else{$new_procquantity = $old_procquantity;}
                    if(isset($_POST['procghz'])){$new_procghz = $_POST['procghz'];}else{$new_procghz = $old_procghz;}
                    if(isset($_POST['memram'])){$new_memram = $_POST['memram'];}else{$new_memram = $old_memram;}
                    if(isset($_POST['memrom'])){$new_memrom = $_POST['memrom'];}else{$new_memrom = $old_memrom;}
                    if(isset($_POST['description'])){$new_desc = $_POST['description'];}else{$new_desc = $old_desc;}
                    if(isset($_POST['old_manuf'])){$old_manuf = $_POST['old_manuf'];}
                    $old_imagepath = $_POST['old_phoneimage'];

                    if($_FILES['phoneimage']['size']){
                        $new_phoneimage = $_FILES['phoneimage']['name'];
                        $newimage_ext = strtolower(pathinfo($new_phoneimage,PATHINFO_EXTENSION));

                        if($newimage_ext == 'png'){
                            $correct_image_name = str_replace(' ','_', $new_name);
                            $_FILES['phoneimage']['name'] = $correct_image_name.'.png';
                            $wholepath = 'images/'.$_FILES['phoneimage']['name'];

                            if(file_exists($old_imagepath)){
                                unlink($old_imagepath);
                            }

                            if(move_uploaded_file($_FILES['phoneimage']['tmp_name'], 'images/'.$_FILES['phoneimage']['name'])){
                                $EDIT_PHONE_QUERY = "UPDATE telefon SET zdjecie='$wholepath', telefon_nazwa='$new_name', rok_wydania=$new_phoneyear, rozdzielczosc=$new_cammp, ilosc_aparatow=$new_camquantity, taktowanie_procesora=$new_procghz, ilosc_rdzeni=$new_procquantity, pamiec_ram=$new_memram, pamiec_rom=$new_memrom, uwagi='$new_desc', producent_id=$new_manufacturer WHERE telefon_id=$pid";
                            } else {
                                $error[] = "Wystąpił błąd podczas edycji telefonu!";
                            }
                        } else {
                            $error[] = "Błędne rozszerzenie obrazu!";
                        }
                    } else {
                        $EDIT_PHONE_QUERY = "UPDATE telefon SET telefon_nazwa='$new_name', rok_wydania=$new_phoneyear, rozdzielczosc=$new_cammp, ilosc_aparatow=$new_camquantity, taktowanie_procesora=$new_procghz, ilosc_rdzeni=$new_procquantity, pamiec_ram=$new_memram, pamiec_rom=$new_memrom, uwagi='$new_desc', producent_id=$new_manufacturer WHERE telefon_id=$pid";
                    }

                    if($old_manuf != $new_manufacturer){
                        $UPDATE_NEW_QUANTITY_QUERY = "UPDATE producent SET ilosc_urzadzen=ilosc_urzadzen+1 WHERE producent_id=$new_manufacturer";
                        $UPDATE_OLD_QUANTITY_QUERY = "UPDATE producent SET ilosc_urzadzen=IF(ilosc_urzadzen > 0, ilosc_urzadzen - 1, 0) WHERE producent_id=$old_manuf";
                        if($UPDATE_OLD_QUANTITY_RESULT = $connect->query( $UPDATE_OLD_QUANTITY_QUERY) && $UPDATE_NEW_QUANTITY_RESULT = $connect->query( $UPDATE_NEW_QUANTITY_QUERY)){
                            if($EDIT_PHONE_RESULT = $connect->query($EDIT_PHONE_QUERY)){
                                header('Location: index.php?c=editphone&phoneid='.$pid);
                            } else {
                                $error[] = "Wystąpił błąd podczas edycji telefonu!";
                            }
                        } else {
                            $error[] = "Wystąpił błąd podczas edycji telefonu!";
                        }
                    } else {
                        if($EDIT_PHONE_RESULT = $connect->query($EDIT_PHONE_QUERY)){
                            header('Location: index.php?c=editphone&phoneid='.$pid);
                        } else {
                            $error[] = "Wystąpił błąd podczas edycji telefonu!";
                        }
                    }

                }
} 

foreach ($error as $key => $value) {
    ?>

    <div class="error-wrapper">
    <i class="fas fa-exclamation-triangle"></i> <?php echo $value; ?>
    </div>

    <?php
}
?>



