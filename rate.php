<?php 
if($connect->connect_error == 1){
    $error[] = "Wystąpił błąd podczas połączenia z bazą!";
} else {

    if(isset($_GET['rate_pos'])){
        $RATE_POS_QUERY = "UPDATE telefon SET oceny_poz=oceny_poz+1 WHERE telefon_id={$_GET['phoneid']}";
        if($RATE_POS_RESULT = $connect->query($RATE_POS_QUERY)){
            header("Location: index.php?c=rate&phoneid={$_GET['phoneid']}");
        } else {
            $error[] = "Wystąpił błąd podczas oceniania produktu!";
        }
    } elseif(isset($_GET['rate_neg'])){
        $RATE_NEG_QUERY = "UPDATE telefon SET oceny_neg=oceny_neg+1 WHERE telefon_id={$_GET['phoneid']}";
        if($RATE_NEG_RESULT = $connect->query($RATE_NEG_QUERY)){
            header("Location: index.php?c=rate&phoneid={$_GET['phoneid']}");
        } else {
            $error[] = "Wystąpił błąd podczas oceniania produktu!";
        }
    }

?>

<div class="phonelist-content">
        <div class="content-heading">
            <h1>OCEŃ TELEFON</h1>
        </div>

        <div class="edit-wrapper">
            <form action="index.php" method="GET">
            <input type="hidden" name="c" value="rate">
            <select name="phoneid" onchange="this.form.submit()">
            <?php if(!isset($_GET['phoneid'])){echo '<option value="0">Wybierz telefon</option>';} ?>
                <?php
                $phoneid = $_GET['phoneid'];
                $PHONE_RATE_QUERY = "SELECT * FROM telefon";
                if($PHONE_RATE_RESULT = $connect->query($PHONE_RATE_QUERY)){
                    while($PHONE_RATE_ROW = $PHONE_RATE_RESULT->fetch_object()){
                        ?>
                            <option value="<?php echo $PHONE_RATE_ROW->telefon_id ?>" <?php if((isset($_GET['phoneid'])) && $_GET['phoneid'] == $PHONE_RATE_ROW->telefon_id){echo 'selected';} ?>><?php echo '#'.$PHONE_RATE_ROW->telefon_id.' '.$PHONE_RATE_ROW->telefon_nazwa ?></option>
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
                        <i class="fas fa-info-circle"></i> Wybierz telefon z listy, aby go ocenić.
                        </div>
                    <?php
                }

                if(isset($_GET['phoneid'])){
                    if($_GET['phoneid'] == 0){
                        header('Location: index.php?c=rate');
                    }
                    $phone_id = $_GET['phoneid'];

                    $PHONE_INFO_QUERY = "SELECT * FROM telefon INNER JOIN producent USING (producent_id) WHERE telefon_id=$phone_id";
                    if($PHONE_INFO_RESULT = $connect->query($PHONE_INFO_QUERY)){
                        while($PHONE_INFO_ROW = $PHONE_INFO_RESULT->fetch_object()){
                            $p_id = $PHONE_INFO_ROW->telefon_id;
                            $p_name = $PHONE_INFO_ROW->telefon_nazwa;
                            $p_manufacturer = $PHONE_INFO_ROW->producent_nazwa;
                            $p_phoneyear = $PHONE_INFO_ROW->rok_wydania;
                            $p_cammp = $PHONE_INFO_ROW->rozdzielczosc;
                            $p_camquantity = $PHONE_INFO_ROW->ilosc_aparatow;
                            $p_procghz = $PHONE_INFO_ROW->taktowanie_procesora;
                            $p_procquantity = $PHONE_INFO_ROW->ilosc_rdzeni;
                            $p_memram = $PHONE_INFO_ROW->pamiec_ram;
                            $p_memrom = $PHONE_INFO_ROW->pamiec_rom;
                            $p_desc = $PHONE_INFO_ROW->uwagi;
                            $p_imagepath = $PHONE_INFO_ROW->zdjecie;
                            $r_positive = $PHONE_INFO_ROW->oceny_poz;
                            $r_negative = $PHONE_INFO_ROW->oceny_neg;
                        }
                    } else {
                        $error[] = "Wystąpił błąd podczas wyświetlania danych!";
                    }

                    ?>

                    <div class="rate-wrapper">
                        <div class="image-wrapper">
                            <img style="width: 75%; border-right: 1px solid #fff;" src="<?php echo $p_imagepath?>" alt="<?php echo $p_name?>">
                        </div>
                        <div class="info-wrapper">
                            <section class="info-info">
                                <h1>/informacje</h1>
                                <?php echo $p_name; ?> • <?php echo $p_manufacturer; ?> • <?php echo $p_phoneyear; ?> • <?php echo $p_cammp; ?>MP • <?php echo $p_camquantity; ?> aparaty • <?php echo $p_procghz; ?>GHz • <?php echo $p_procquantity; ?> rdzeni/e • <?php echo $p_memram; ?> GB RAM • <?php echo $p_memrom; ?> GB ROM 
                                <br><br>
                                <?php echo $p_desc; ?>
                            </section>
                            <section class="rate-handler">
                                <div class="rating">
                                    <a href="index.php?c=rate&rate_pos&phoneid=<?php echo $p_id; ?>"><button><i class="fas fa-thumbs-up"></i></button></a> <span class="rating-styled"><?php echo $r_positive ?></span>
                                </div>
                                <div class="rating">
                                <a href="index.php?c=rate&rate_neg&phoneid=<?php echo $p_id; ?>"><button><i class="fas fa-thumbs-up negative"></i></button></a> <span class="rating-styled"><?php echo $r_negative ?></span>
                                </div>
                            </section>
                            <div class="avg-rating">
                                    /średnia ocen: 
                                    <?php 
                                        $AVG_RATING_QUERY = "SELECT oceny_poz, oceny_neg FROM telefon WHERE telefon_id={$_GET['phoneid']}";
                                        if($AVG_RATING_RESULT = $connect->query($AVG_RATING_QUERY)){
                                            while($AVG_RATING_ROW = $AVG_RATING_RESULT->fetch_object()){
                                                $pos_rating = $AVG_RATING_ROW->oceny_poz;
                                                $neg_rating = $AVG_RATING_ROW->oceny_neg;

                                                echo ($pos_rating+$neg_rating)/2;
                                            }
                                        }
                                    ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }
} 

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