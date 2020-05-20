<?php

if($connect->connect_error == 1){
    echo "Wystąpił błąd podczas próby połączenia z bazą danych!";
} else {

if(isset($_GET['delmanufid'])){
    $MANUFACTURER_ID=$_GET['delmanufid'];

    $DELETE_MANUFACTURER_QUERY = "DELETE FROM producent WHERE producent_id=$MANUFACTURER_ID";
    if($DELETE_MANUFACTURER_RESULT = $connect->query($DELETE_MANUFACTURER_QUERY)){
        header('Location: index.php?c=manufacturerlist');
    } else {
        echo "<h1 style='text-align: center; border-bottom: 1px solid black'>Wystąpił błąd podczas usuwania pozycji z listy!</h1>";
    }
}
    
?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>LISTA PRODUCENTÓW</h1>
        </div>
    <table>
            <th>MID</th>
            <th>Nazwa</th>
            <th>Siedziba</th>
            <th>Ilość urządzeń</th>
            <th>Działanie</th>
        <?php
            $MANUFACTURER_INFO_QUERY = "SELECT * FROM producent";
            if($MANUFACTURER_INFO_RESULT = $connect->query($MANUFACTURER_INFO_QUERY)){
                
                while($MANUFACTURER_INFO_ROW=$MANUFACTURER_INFO_RESULT->fetch_object()){
                    ?>
                    <tr>
                        <td><?php echo $MANUFACTURER_INFO_ROW->producent_id ?></td>
                        <td><?php echo $MANUFACTURER_INFO_ROW->producent_nazwa ?></td>
                        <td><?php echo $MANUFACTURER_INFO_ROW->producent_miasto ?></td>
                        <td><?php echo $MANUFACTURER_INFO_ROW->ilosc_urzadzen ?></td>
                        <td><?php echo  '<a href="index.php?c=manufacturerlist&delmanufid='.$MANUFACTURER_INFO_ROW->producent_id.'" style="color: #05386B;"><button class="deletebutton"><i class="fas fa-trash-alt"></i></button></a>'?>
                        <?php echo  '<a href="index.php?c=editmanufacturer&manufid='.$MANUFACTURER_INFO_ROW->producent_id.'" style="color: #05386B;"><button class="deletebutton"><i class="fas fa-wrench"></i></button></a>'?></td>
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