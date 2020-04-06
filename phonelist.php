<?php

if($connect->connect_error == 1){
    echo "Wystąpił błąd podczas próby połączenia z bazą danych!";
} else {
    
?>

<div class="phonelist-content">
    <h1 class="content-heading">Lista telefonów</h1>
    <table>
        <tr>
            <th>PID</th>
            <th>Nazwa</th>
            <th>Producent</th>
            <th>Rok wydania</th>
        </tr>
        <?php 
            $PRODUCT_INFO_QUERY = "SELECT * FROM telefon INNER JOIN producent USING (producent_id)";
            if($PRODUCT_INFO_RESULT = $connect->query($PRODUCT_INFO_QUERY)){
                
                while($PRODUCT_INFO_ROW=$PRODUCT_INFO_RESULT->fetch_object()){
                    ?>
                    <tr>
                        <td><?php echo $PRODUCT_INFO_ROW->telefon_id ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->telefon_nazwa ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->producent_nazwa ?></td>
                        <td><?php echo $PRODUCT_INFO_ROW->rok_wydania ?></td>
                    </tr>
                    <?php
                }

            } else {
                echo '<h1>Wystąpił błąd podczas wyświetlania porduktów!</h1>';
            }

        ?>

    </table>
</div>

<?php
}
?>