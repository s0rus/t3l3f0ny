<?php 
if($connect->connect_error == 1){
    $error[] = "Wystąpił błąd podczas połączenia z bazą!";
} else {

?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>EDYTUJ PRODUCENTA</h1>
        </div>

        <div class="edit-wrapper">
            <form action="index.php" method="GET">
            <input type="hidden" name="c" value="editmanufacturer">
            <select name="manufid" onchange="this.form.submit()">
            <?php if(!isset($_GET['manufid'])){echo '<option value="0">Wybierz producenta</option>';} ?>
                <?php
                $manufid = $_GET['manufid'];
                $MANUFACTURER_EDIT_QUERY = "SELECT * FROM producent";
                if($MANUFACTURER_EDIT_RESULT = $connect->query($MANUFACTURER_EDIT_QUERY)){
                    while($MANUFACTURER_EDIT_ROW = $MANUFACTURER_EDIT_RESULT->fetch_object()){
                        ?>
                            <option value="<?php echo $MANUFACTURER_EDIT_ROW->producent_id ?>" <?php if((isset($_GET['manufid'])) && $_GET['manufid'] == $MANUFACTURER_EDIT_ROW->producent_id){echo 'selected';} ?>><?php echo '#'.$MANUFACTURER_EDIT_ROW->producent_id.' '.$MANUFACTURER_EDIT_ROW->producent_nazwa ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            </form>

        </div>

        <?php 

                if(!isset($_GET['manufid'])){
                    ?>
                        <div class="edit-info">
                        <i class="fas fa-info-circle"></i> Wybierz producenta z listy, aby go edytować.
                        </div>
                    <?php
                }

                if(isset($_GET['manufid'])){
                    if($_GET['manufid'] == 0){
                        header('Location: index.php?c=editmanufacturer');
                    }

                    $MANUFACTURER_INFO_QUERY = "SELECT * FROM producent WHERE producent_id=$manufid";
                    if($MANUFACTURER_INFO_RESULT = $connect->query($MANUFACTURER_INFO_QUERY)){
                        while($MANUFACTURER_INFO_ROW = $MANUFACTURER_INFO_RESULT->fetch_object()){
                            $old_manufname = $MANUFACTURER_INFO_ROW->producent_nazwa;
                            $old_manufcity = $MANUFACTURER_INFO_ROW->producent_miasto;
                            $old_manufquantity = $MANUFACTURER_INFO_ROW->ilosc_urzadzen;
                            $mid = $MANUFACTURER_INFO_ROW->producent_id;
                        }
                    } else {
                        $error[] = "Wystąpił błąd podczas wyświetlania danych!";
                    }

        ?>

            <form action="index.php?c=editmanufacturer" method="POST" class="add-content-form">
            <h3>EDYCJA PRODUCENTA #<?php echo $manufid ?></h3>
                    <div class="form-entry" style="width: 99%; margin: 0 auto;">
                        <label for="manufname">Nazwa producenta</label><br>
                        <input type="text" name="manufname" required <?php echo 'value="';if(isset($old_manufname)){echo $old_manufname;} else {header('Location: index.php?c=editmanufacturer');}echo '"'; ?>>
                    </div>
                <div class="double-form-entry">
                    <div class="form-entry">
                        <label for="manufcity">Siedziba</label><br>
                        <input type="text" name="manufcity" required <?php echo 'value="'.$old_manufcity.'"'; ?>>
                    </div>
                    <div class="form-entry">
                        <label for="manufquantity">Ilość urządzeń</label><br>
                        <input type="number" name="manufquantity" min="0" required <?php echo 'value="'.$old_manufquantity.'"'; ?>>
                    </div>
                </div>
                <input type="hidden" name="mid" <?php echo 'value="'.$mid.'"'; ?>>
                <input type="submit" value="EDYTUJ" name="editmanufproc" class="addcontent">
            </form>

</div>
<?php
                }          
}

    if(isset($_POST['editmanufproc'])){
        if(isset($_POST['manufname'])){$new_manufname = $_POST['manufname'];}else{$new_manufname = $old_manufname;}
        if(isset($_POST['manufcity'])){$new_manufcity = $_POST['manufcity'];}else{$new_manufcity = $old_manufcity;}
        if(isset($_POST['manufquantity'])){$new_manufquantity = $_POST['manufquantity'];}else{$new_manufquantity = $old_manufquantity;}
        $mid = $_POST['mid'];

        $EDIT_MANUFACTURER_QUERY = "UPDATE producent SET producent_nazwa='$new_manufname', producent_miasto='$new_manufcity', ilosc_urzadzen=$new_manufquantity WHERE producent_id=$mid";
        if($EDIT_MANUFACTURER_RESULT = $connect->query($EDIT_MANUFACTURER_QUERY)){
                header('Location: index.php?c=editmanufacturer&manufid='.$mid);
        } else {
                $error[] = "Wystąpił błąd podczas edycji producenta!";
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