<?php
require('../conn.php');
session_start();
if (isset($_SESSION['admin'])) {
    $query = "SELECT * FROM admin";
    $row = mysqli_query($conn, $query);
    
    $getuniquecode = $_GET['unique_code'];
    $db = new PDO("mysql:host=" . $_SERVER['WORDPRESS_DB_HOST'] . ";dbname=" . $_SERVER['WORDPRESS_DB_NAME'], $_SERVER['WORDPRESS_DB_USER'], $_SERVER['WORDPRESS_DB_PASSWORD']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Dashboard - Use Case Engine</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="../../images/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <style>
            .useCasePageTitle {
                color: #3D64EE;
            }
            .usecaseList{
                list-style: none;
                font-size: .85em;
            }
            .promptText{
                font-size: .85em;
            }
            #footer{
                margin: 0 !important;
            }
        </style>
    </head>

    <body class="" style="background-color: #f6f9ff;">
        <header class="p-5">
            <h2 class="text-center useCasePageTitle">Détails du cas d'utilisation de l'utilisateur</h2>
        </header>
        <main class="main">
            <div class="container useCasePageContainer">
            <div class="row g-5 bg-light mx-0">
                <div class="row g-2 flex-lg-row flex-column-reverse">
                <div class="col col-lg-7 col-12 p-sm-4 p-2 border  rounded-2 bg-white shadow">
                    <h3 class="fs-4">
                        Requête
                    </h3>
                    
                    <ul class="usecaseList">
                    <?php 
                    $stmt = mysqli_prepare($conn, "SELECT * FROM `form_data` WHERE unique_code = ?");
                    mysqli_stmt_bind_param($stmt, "s", $getuniquecode);
                    mysqli_stmt_execute($stmt);
                                       
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){
                    ?>
                        <li class="p-1"><b>Date :</b> <span><?php echo $row['date'] ?></span></li>
                        <li class="p-1"><b>Poste recherché :</b> <span><?php echo $row['q_5'] ?></span></li>
                        <li class="p-1"><b>Niveau XP :</b> <span><?php echo $row['q_6'] ?></span></li>
                        <li class="p-1"><b>Industrie :</b> <span><?php echo $row['q_7'] ?></span></li>
                        <li class="p-1"><b>Compétences spécifiques évaluées :</b> <span><?php echo $row['q_8'] ?></span></li>
                        <li class="p-1"><b>Objectif principal de ce scénario :</b> <span><?php echo $row['q_9'] ?></span></li>
                        <li class="p-1"><b>Objectif commercial principal du produit dans ce scénario :</b> <span><?php echo $row['q_10'] ?></span></li>
                        <li class="p-1"><b>Principaux défis auxquels le produit est confronté dans ce scénario :</b> <span><?php echo $row['q_11'] ?></span></li>
                        <li class="p-1"><b>Temps max :</b> <span><?php echo $row['q_12'] ?></span></li>
                        <li class="p-1"><b>Langue :</b> <span><?php echo $row['q_13'] ?></span></li>
                        <li class="p-1"><b>Format requis :</b> <span><?php echo $row['q_14'] ?></span></li>
                        <?php
                    }
                    ?>
                    </ul>
                    
                </div>
                <div class="col-1 d-lg-block d-none"></div>
                <div class="col col-lg-4 col-12 p-sm-4 p-2 border rounded-2 bg-white shadow" style="height: max-content;">
                    <h3 class="fs-4">Utilisateur</h3>
                    <ul class="usecaseList">
                        <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM `form_data` WHERE unique_code = ?");
                    mysqli_stmt_bind_param($stmt, "s", $getuniquecode);
                    mysqli_stmt_execute($stmt);
                                       
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                        <li class="p-1"><b>Nom :</b> <span><?php echo $row['q_1'] ?></span></li>
                        <li class="p-1"><b>Email :</b> <span><?php echo $row['q_2'] ?></span></li>
                        <li class="p-1"><b>Entreprise :</b> <span><?php echo $row['q_3'] ?></span></li>
                        <li class="p-1"><b>Rôle :</b> <span><?php echo $row['q_4'] ?></span></li>
                        <?php
                    }
                    ?>
                    </ul>
                </div>
                </div>
                <div class="col col-12 p-sm-4 p-2 border rounded-2 bg-white shadow">
                    <h3 class="fs-4">Cas d'utilisation généré</h3>
                    <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM `prompt1` WHERE unique_code = ?");
                    mysqli_stmt_bind_param($stmt, "s", $getuniquecode);
                    mysqli_stmt_execute($stmt);
                                       
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                    <p class="promptText">
                    <?php echo $row['prompt_one'] ?>
                    </p>
                    <?php
                    }
                    ?>
                </div>
                <div class="col col-12 p-sm-4 p-2 border rounded-2 bg-white shadow">
                    <h3 class="fs-4">Résultat attendu</h3>
                    <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM `prompt2` WHERE unique_code = ?");
                    mysqli_stmt_bind_param($stmt, "s", $getuniquecode);
                    mysqli_stmt_execute($stmt);
                                       
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                    <p class="promptText">
                    <?php echo $row['prompt_two'] ?>
                    </p>
                    <?php
                    }
                    ?>
                </div>
                <div class="col col-12 p-sm-4 p-2 border rounded-2 bg-white shadow">
                    <h3 class="fs-4">Exemple de résultat</h3>
                    <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM `prompt3` WHERE unique_code = ?");
                    mysqli_stmt_bind_param($stmt, "s", $getuniquecode);
                    mysqli_stmt_execute($stmt);
                                       
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)){ 
                        ?>
                    <p class="promptText">
                    <?php echo $row['prompt_three'] ?>
                    </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            </div>
        </main>

        <!-- ======= Footer ======= -->
        <?php
        include('./footer.php');
        ?>
        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

    </html>
<?php

} else {
    header('location:../admin.php');
}
?>