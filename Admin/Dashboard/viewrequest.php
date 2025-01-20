<?php
include("../conn.php");
session_start();
if (!isset($_SESSION['admin'])) {
  header("location:../admin.php");
}
// $db = new PDO('mysql:host=localhost;dbname=use_case_engine', 'root', '');
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
  .datatable-table th a{
  text-wrap: nowrap !important;
  color: #3D64EE !important;
}
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
  include('./header.php');
  ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php
  include('./sidebar.php');
  ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12" id="grid">
          <div class="row">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">View Requête</h5>

                <!-- Table with hoverable rows -->
                <table class="table table-hover datatable">
                  <thead class="samad-dashborad-header">
                    <tr>
                      <!-- <th scope="col">#</th> -->
                      <th scope="col">Date</th>
                      <th scope="col">Email</th>
                      <th scope="col">Poste recherché</th>
                      <th scope="col">Niveau XP</th>
                      <th scope="col">Industrie</th>
                      <th scope="col">Temps max</th>
                      <th scope="col">Langue</th>
                      <th scope="col">Select</th>
                      <!-- <th scope="col">Compétences spécifiques</th>
                      <th scope="col">Objectif principal</th>
                      <th scope="col">Objectif commercial principal</th>
                      <th scope="col">Principaux défis</th>
                      <th scope="col">Format requis</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = "SELECT * FROM `form_data`";
                    $query_run = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($query_run)) {
                      ?>
                      <tr>
                        <th scope="row">
                          <?php echo $row['date'] ?>
                        </th>
                        <td>
                          <?php echo $row['q_2'] ?>
                          </td>
                        <td>
                          <?php echo $row['q_5'] ?>
                        </td>
                        <td>
                          <?php echo $row['q_6'] ?>
                        </td>
                        <td>
                          <?php echo $row['q_7'] ?>
                        </td>
                        <td >
                          <?php echo $row['q_12'] ?>
                        </td>
                        <td>
                          <?php echo $row['q_13'] ?>
                        </td>
                        <td>
                          <a href="./usecasepage.php?unique_code=<?php echo $row['unique_code']?>">
                          <button class="btn btn-primary btn-sm">Ouvrir</button>
                          </a>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>

              </div>
            </div>

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->

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

  <!-- custom script for changing search input placeholder -->
  <script>
      let inputSearch= document.querySelector('#grid .datatable-search input');
      inputSearch.placeholder="Filter";
      inputSearch.title="Filter By Date, Poste recherché, Niveau XP, Industrie, Langue"
</script>
</body>

</html>