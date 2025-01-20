<!doctype html>
<html lang="en">
<head>
  <title>Dashboard - Use Engine Case</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="../style/style.css">
<style>
      .alert {
         padding: 20px;
         background-color: #f44336;
         color: white;
         position: fixed;
         top: 20%;
         left: 50%;
         width: max-content;
         max-width: 90vw;
         z-index: 2;
         transform: translate(-50%, -20%);
      }

      .closebtn {
         margin-left: 15px;
         color: white;
         font-weight: bold;
         float: right;
         font-size: 22px;
         line-height: 20px;
         cursor: pointer;
         transition: 0.3s;
      }

      .closebtn:hover {
         color: black;
      }
   </style>
</head>

<body id="body">
<?php
session_start();
require('conn.php');
if(isset($_POST['adminLogin'])){
  $email = $_POST['email'];
$pass = $_POST['pass'];
$query = "SELECT * FROM admin Where email = '$email' AND password = '$pass'";
$row = mysqli_query($conn,$query);
$data = mysqli_fetch_assoc($row);
if($data){
    $_SESSION['admin'] = $data['name'];
    header('location:Dashboard/index.php?session='.$_SESSION['admin']);
}else{
    ?>
     <script>
        let alertDiv = document.createElement("div");
        let body =document.getElementById("body");
    alertDiv.className="alert";
    alertDiv.innerHTML = `
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
    <strong>Alert !</strong> L'email et le mot de passe ne correspondent pas`;
    body.appendChild(alertDiv);
    </script>
    <?php
}
};
?>
    <!-- admin-login-form-->
    <section class="user-bgr">
       <div class="user-login m-0 pt-5 pb-5 px-5">
            <h1 class="user-title">Login as a ADMIN</h1>
            <form action="admin.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <label for="message-text" class="col-form-label user-label">Email</label>
                        <input type="email" class="form-control user-input" required placeholder="Enter Your Email" id="recipient-name"
                            name="email">
                    </div>
                    <div class="col-md-12">
                        <label for="message-text" class="col-form-label user-label">Password</label>
                        <input type="password" class="form-control user-input" required placeholder="Enter Your Password" id=""
                            name="pass">
                    </div>
                    <div class="col-md-12 mt-3">
                       <input type="submit" name="adminLogin" value="Login" class="user-btn">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- user-login-form-->



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>