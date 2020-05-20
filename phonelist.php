<?php
if($connect->connect_error == 1){
    $error[] = "Wystąpił błąd podczas połączenia z bazą!";
} else {

if(isset($_GET['delphoneid']) && isset($_GET['manufid'])){
    $PHONE_TO_DELETE=$_GET['delphoneid'];
    $MANUFACTURER_ID=$_GET['manufid'];

    $DELETE_PHONE_QUERY = "DELETE FROM telefon WHERE telefon_id=$PHONE_TO_DELETE";
    $UPDATE_QUANTITY_QUERY = "UPDATE producent SET ilosc_urzadzen=IF(ilosc_urzadzen > 0, ilosc_urzadzen - 1, 0) WHERE producent_id=$MANUFACTURER_ID";
    if($DELETE_PHONE_RESULT = $connect->query($DELETE_PHONE_QUERY) && $UPDATE_QUANTITY_RESULT = $connect->query($UPDATE_QUANTITY_QUERY)){
        unlink($_GET['phoneimg']);
        header('Location: index.php?c=phonelist'); 
    } else {
        $error[] = "Wystąpił błąd podczas usuwania pozycji z bazy danych!";
    }
}
    
?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>LISTA TELEFONÓW</h1>
            <form action="index.php" method="get">
            <input type="hidden" name="c" value="phonelist">
            <select name="sort" onchange="this.form.submit()">
            <option value="0" <?php if(!(isset($_GET['sort']))){echo 'selected';}; ?>><?php if(!isset($_GET['sort'])){echo 'Sortuj producentów';} else {echo 'Wszyscy';}  ?></option>
                <?php
                $MANUFACTURER_SORT_QUERY = "SELECT * FROM producent";
                if($MANUFACTURER_SORT_RESULT = $connect->query($MANUFACTURER_SORT_QUERY)){
                    while($MANUFACTURER_SORT_ROW = $MANUFACTURER_SORT_RESULT->fetch_object()){
                        ?>
                            <option value="<?php echo $MANUFACTURER_SORT_ROW->producent_id ?>" <?php if((isset($_GET['sort'])) && $_GET['sort'] == $MANUFACTURER_SORT_ROW->producent_id){echo 'selected';} ?>><?php echo $MANUFACTURER_SORT_ROW->producent_nazwa ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            </form>
        </div>
    <table>
            <th>PID</th>
            <th>Zdjęcie</th>
            <th>Nazwa</th>
            <th>Producent</th>
            <th>Rok wydania</th>
            <th>Roz. aparatu</th>
            <th>Il. aparatów</th>
            <th>Takt. proc.</th>
            <th>Il. rdzeni</th>
            <th>RAM</th>
            <th>ROM</th>
            <th>Działanie</th>
        <?php
            if(isset($_GET['sort'])){
                $MANUFACTURER_ID=$_GET['sort'];

                if($MANUFACTURER_ID == '0'){
                    header('Location: index.php?c=phonelist');
                }

                $PRODUCT_INFO_QUERY = "SELECT * FROM telefon INNER JOIN producent USING (producent_id) WHERE producent_id=$MANUFACTURER_ID ORDER BY telefon_id";
            } else {
                $PRODUCT_INFO_QUERY = "SELECT * FROM telefon INNER JOIN producent USING (producent_id) ORDER BY telefon_id";
            }
            if($PRODUCT_INFO_RESULT = $connect->query($PRODUCT_INFO_QUERY)){
                
                while($PRODUCT_INFO_ROW=$PRODUCT_INFO_RESULT->fetch_object()){
                    ?>
                    <tr>
                        <td><?php echo $PRODUCT_INFO_ROW->telefon_id ?></td>
                        <td><img style="width: 100px;" src="<?php echo $PRODUCT_INFO_ROW->zdjecie ?>"/></td>
                        <td><?php echo $PRODUCT_INFO_ROW->telefon_nazwa ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->producent_nazwa; ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->rok_wydania ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->rozdzielczosc ?> MP</td>
                        <td><?php echo $PRODUCT_INFO_ROW->ilosc_aparatow ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->taktowanie_procesora ?> GHz</td>
                        <td><?php echo $PRODUCT_INFO_ROW->ilosc_rdzeni ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->pamiec_ram ?> GB</td>
                        <td><?php echo $PRODUCT_INFO_ROW->pamiec_rom ?> GB</td>
                        <td><?php echo  '<a href="index.php?c=phonelist&delphoneid='.$PRODUCT_INFO_ROW->telefon_id.'&manufid='.$PRODUCT_INFO_ROW->producent_id.'&phoneimg='.$PRODUCT_INFO_ROW->zdjecie.'" style="color: #05386B;"><button class="deletebutton"><i class="fas fa-trash-alt"></i></button></a>'?><br>
                        <?php echo  '<a href="index.php?c=editphone&phoneid='.$PRODUCT_INFO_ROW->telefon_id.'" style="color: #05386B;"><button class="deletebutton"><i class="fas fa-edit"></i></button></a>'?><br>
                        <?php echo  '<a href="index.php?c=rate&phoneid='.$PRODUCT_INFO_ROW->telefon_id.'" style="color: #05386B;"><button class="deletebutton"><i class="fas fa-thumbs-up"></i></button></a>'?></td>
                    </tr>
                    <?php
                }

            } else {
                $error[] = "Wystąpił błąd podczas połączenia z bazą!";
            }

        ?>

    </table>
</div>

<?php 

    foreach ($error as $key => $value) {
        ?>

        <div class="error-wrapper">
        <i class="fas fa-exclamation-triangle"></i> <?php echo $value; ?>
        </div>

        <?php
    }

?>

<?php
}
?>