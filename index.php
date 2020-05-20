<?php

    $error = array();
    $success = array();

    //error_reporting(0);

    if(!(isset($_GET['c']))){
        header('Location: index.php?c=contact');
    } elseif(($_GET['c'] != 'contact') && ($_GET['c'] != 'phonelist') && ($_GET['c'] != 'manufacturerlist') && ($_GET['c'] != 'addcontent') && ($_GET['c'] != 'editphone') && ($_GET['c'] != 'editmanufacturer') && ($_GET['c'] != 'rate')){
        header('Location: index.php?c=contact');
    } else {
        $connect = new mysqli('localhost', 'root', '', 'telefony');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?version=2">
    <script src="https://kit.fontawesome.com/d4a801d4e7.js" crossorigin="anonymous"></script>
    <title>T3L3FONY</title>
    <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon">
</head>
<body>

    <main class="wrapper">
        <nav class="side-nav">
        <a href="index.php">
            <section class="nav-logo">
                <p>T3L3FONY</p>
            </section>
        </a>
            <section class="nav-links">
                <ul class="main-links">
                    <a href="index.php?c=phonelist"><li <?php if($_GET['c']=='phonelist'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-mobile-alt"></i><p>Telefony</p></li></a>
                    <a href="index.php?c=manufacturerlist"><li <?php if($_GET['c']=='manufacturerlist'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-industry"></i><p>Producenci</p></li></a>
                    <a href="index.php?c=addcontent"><li <?php if($_GET['c']=='addcontent'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-plus"></i><p>Dodaj</p></li></a>
                </ul>
                <ul class="main-links">
                    <a href="index.php?c=editphone"><li <?php if($_GET['c']=='editphone'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-edit"></i><p>Edytuj telefon</p></li></a>
                    <a href="index.php?c=editmanufacturer"><li <?php if($_GET['c']=='editmanufacturer'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-wrench"></i><p>Edytuj producenta</p></li></a>
                    <a href="index.php?c=rate"><li <?php if($_GET['c']=='rate'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-thumbs-up"></i><p>Oceń</p></li></a>
                </ul>
                <ul class="main-links">
                    <a href="index.php?c=contact"><li <?php if($_GET['c']=='contact'){echo 'style="background-color: rgb(86, 86, 92);"';}?>><i class="fas fa-info"></i><p>Kontakt</p></li></a>
                </ul>
                <div class="copyright">&copy; Piotr Mól 2020</div>
            </section>
        </nav>
        <aside class="main-content">

            <?php
                if(isset($_GET['c'])){

                    if($_GET['c'] == 'contact'){
                        require_once 'contact.php';
                    }

                    if($_GET['c'] == 'phonelist'){
                        require_once 'phonelist.php';
                    }

                    if($_GET['c'] == 'manufacturerlist'){
                        require_once 'manufacturerlist.php';
                    }

                    
                    if($_GET['c'] == 'addcontent'){
                        require_once 'addcontent.php';
                    }

                    if($_GET['c'] == 'editphone'){
                        require_once 'editphone.php';
                    }

                    if($_GET['c'] == 'editmanufacturer'){
                        require_once 'editmanufacturer.php';
                    }

                    if($_GET['c'] == 'rate'){
                        require_once 'rate.php';
                    }
                }
            ?>

        </aside>
    </main>

</body>
</html>

<?php

$connect->close();

?>