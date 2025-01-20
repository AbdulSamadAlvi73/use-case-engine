<?php

require("./Admin/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $date = date('Y-m-d');
   $q1 = $_POST['q1'];
   $q2 = $_POST['q2'];
   $q3 = $_POST['q3'];
   $q4 = $_POST['q4'];
   $q5 = $_POST['q5'];
   $q6 = $_POST['q6'];
   $q7 = $_POST['q7'];
   $q8 = $_POST['q8'];
   $q9 = $_POST['q9'];
   $q10 = $_POST['q10'];
   $q11 = $_POST['q11'];
   $q12 = $_POST['q12'];
   $q12Extra = $_POST['q12Extra'];
   if ($q12 == "Oui") {
      $q12Final = $q12Extra;
   } else {
      $q12Final = $q12;
   }
   $q13 = $_POST['q13'];
   $q14 = $_POST['q14'];
   $q14Extra = $_POST['q14Extra'];
   if ($q14 == "Oui") {
      $q14Final = $q14Extra;
   } else {
      $q14Final = $q14;
   }
   $status = $_POST['status'];
   $q8Array = implode(", ", $_POST['q8']);
   $q11Array = implode(", ", $_POST['q11']);

   if (isset($_POST['setcookies'])) {
      // Code to set cookies based on form data
      setcookie('q1', $q1, time() + 86400, '/'); // Example: set cookie for 1 day
      setcookie('q2', $q2, time() + 86400, '/');
      setcookie('q3', $q3, time() + 86400, '/');
      setcookie('q4', $q4, time() + 86400, '/');
      setcookie('q5', $q5, time() + 86400, '/');
      setcookie('q6', $q6, time() + 86400, '/');
      setcookie('q7', $q7, time() + 86400, '/');
      setcookie('q8', $q8Array, time() + 86400, '/');
      setcookie('q9', $q9, time() + 86400, '/');
      setcookie('q10', $q10, time() + 86400, '/');
      setcookie('q11', $q11Array, time() + 86400, '/');
      setcookie('q12', $q12Final, time() + 86400, '/');
      setcookie('q13', $q13, time() + 86400, '/');
      setcookie('q14', $q14Final, time() + 86400, '/');
      // Redirect or display a message as needed
      setcookie('status', "submitted", time() + 86400, '/');
      header("Location: index.php");

      exit();
   } elseif (isset($_POST['submit']) && isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

      $secret = '6Lf6JDspAAAAAB2OgQUzS0-gTF5YpNmzh00S9m_H';
      $response = $_POST['g-recaptcha-response'];
      $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response);
      $responseData = json_decode($verifyResponse, true);
      // print_r($responseData);die();

      $email = $_POST['q2']; // Assuming 'q2' contains the email
      $submissionLimit = 3; // Define the submission limit

      $query = "SELECT COUNT(*) as submission_count FROM form_data WHERE q_2 = ?"; // Assuming q_2 is the column name for email in your database

      $stmt = $conn->prepare($query);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $currentSubmissions = $row['submission_count'];

      if ($currentSubmissions >= $submissionLimit) {
         // Alert or handle the case when the user reaches the submission limit
         echo "<script>alert('You have reached the maximum submission limit.');
         window.location.href = 'index.php';</script>";
         setcookie('q1', '', time() - 86400, '/');
         setcookie('q2', '', time() - 86400, '/');
         setcookie('q3', '', time() - 86400, '/');
         setcookie('q4', '', time() - 86400, '/');
         setcookie('q5', '', time() - 86400, '/');
         setcookie('q6', '', time() - 86400, '/');
         setcookie('q7', '', time() - 86400, '/');
         setcookie('q8', '', time() - 86400, '/');
         setcookie('q9', '', time() - 86400, '/');
         setcookie('q10', '', time() - 86400, '/');
         setcookie('q11', '', time() - 86400, '/');
         setcookie('q12', '', time() - 86400, '/');
         setcookie('q13', '', time() - 86400, '/');
         setcookie('q14', '', time() - 86400, '/');
         setcookie('status', '', time() - 86400, '/');
         exit();
      } else {


         if ($responseData['success'] === true) {

            session_start();
            $uniqueCode = md5(uniqid());
            // Set the session variable
            $_SESSION['unique_code'] = $uniqueCode;

            // Sample query with placeholders for 16 columns
            $query = "INSERT INTO form_data (q_1, q_2, q_3, q_4, q_5, q_6, q_7, q_8, q_9, q_10, q_11, q_12, q_13, q_14,`date`,unique_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Assuming $q1, $q2, ..., $q14 are your values for each column
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bind_param("ssssssssssssssss", $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8Array, $q9, $q10, $q11Array, $q12Final, $q13, $q14Final, $date, $_SESSION['unique_code']);

            // 
            if ($query) {
               setcookie('q1', '', time() - 86400, '/');
               setcookie('q2', '', time() - 86400, '/');
               setcookie('q3', '', time() - 86400, '/');
               setcookie('q4', '', time() - 86400, '/');
               setcookie('q5', '', time() - 86400, '/');
               setcookie('q6', '', time() - 86400, '/');
               setcookie('q7', '', time() - 86400, '/');
               setcookie('q8', '', time() - 86400, '/');
               setcookie('q9', '', time() - 86400, '/');
               setcookie('q10', '', time() - 86400, '/');
               setcookie('q11', '', time() - 86400, '/');
               setcookie('q12', '', time() - 86400, '/');
               setcookie('q13', '', time() - 86400, '/');
               setcookie('q14', '', time() - 86400, '/');
               setcookie('status', '', time() - 86400, '/');
            }
            if ($stmt->execute()) {
               // Destroying Cookies
               // echo "kamal";
               // exit;
               // $stmt->close();
               header("location:./pages/prompt_1.php?unique_code=" . $_SESSION['unique_code']);
               // exit;
               // ob_end();
            } else {
               echo "Error: " . $stmt->error;
            }
            $stmt->close();

            $msg = "Thanks Your Message is Submited";

            $html = "
    <h2 style='font-size:13px;'>Nouveau use case généré:</h2>
    <table>
    <tr>
    <th style='text-align:left;'>Nom:</th>
    <td>$q1</td>
    </tr>
    <tr>
    <th style='text-align:left;'>Email:</th>
    <td>$q2</td>
    </tr>
    <tr>
    <th style='text-align:left;'>Entreprise:</th>
    <td>$q3</td>
    </tr>
    <tr>
    <th style='text-align:left;'>Rôle:</th>
    <td>$q4</td>
    </tr>
    </table>";

            include('./smtp/PHPMailerAutoload.php');
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587;
            $mail->SMTPSecure = "tls";
            $mail->SMTPAuth = true;
            $mail->Username = "samad@gmail.com";
            $mail->Password = "bmjn mxgc mqij zruh";
            $mail->SetFrom("samad@gmail.com");
            $mail->addAddress("samad@gmail.com");
            // $mail->Username = "ryzwan@lakanatek.fr";
            // $mail->Password = "bmjn mxgc mqij zruh";
            // $mail->SetFrom("ryzwan@lakanatek.fr");
            // $mail->addAddress("ryzwan@lakanatek.fr");
            $mail->IsHTML(true);
            $mail->Subject = "Use case engine - Nouveau use case généré";
            $mail->Body = $html;
            $mail->SMTPOptions = array(
               'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => false
               )
            );
            if ($mail->send()) {
               //echo "Mail send";
            } else {
               //echo "Error occur";
            }
            // echo $msg;


         } else {
            echo '<script>alert("Something went wrong")</script>';
            ?>
            <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> Something went wrong, please try again
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div> -->
            <?php
         }
      }
   } else {
      echo '<script>alert("make sure you are not a robot")</script>';

      ?>
      <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>Captcha Alert!</strong> Make sure your are not a robot.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> -->
      <?php

   }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Use Case Engine</title>
   <link rel="stylesheet" href="./style/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
   <!-- Loading Bar -->
   <div id="loading-bar"></div>
   <div class="container-samad">
      <header>Use case engine</header>
      <h5 class="title-samad">Créer un use case unique pour évaluer vos candidats. Notre I.A construit le use case
         parfait pour vos besoins</h5>
      <div class="progress-bar-samad">
         <div class="step-samad">
            <div class="bullet-samad">
               <span>1</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>2</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>3</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>4</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>5</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>6</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
         <div class="step-samad">
            <div class="bullet-samad">
               <span>7</span>
            </div>
            <div class="check fas fa-check"></div>
         </div>
      </div>
      <div class="form-outer-samad">
         <form action="#" method="POST" enctype="multipart/form-data">
            <input type="text" style="display: none;" readonly id="formStatus" name="status"
               value="<?php echo isset($_COOKIE['status']) ? htmlspecialchars($_COOKIE['status']) : ''; ?>">
            <div class="page-samad slide-page">
               <div class="title">
                  STEP 1:
               </div>
               <h5 class="step1-title">Une série de questions vous sera posée afin de personnaliser au mieux
                  le use case pour vos besoins. Dans quelques minutes notre I.A. va construire
                  votre use case. Il est unique!</h5>
               <div class="field">
                  <button class="firstNext next-samad">Démarrer</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP 2:
               </div>
               <div class="field">
                  <div class="label">
                     Q1: Quel est votre nom complet?
                  </div>
                  <input type="text" name="q1" placeholder="Full Name"
                     value="<?php echo isset($_COOKIE['q1']) ? htmlspecialchars($_COOKIE['q1']) : ''; ?>" required>
               </div>
               <div class="field">
                  <div class="label">
                     Q2: Quelle est votre adresse email ?
                  </div>
                  <input type="email" name="q2" placeholder="Email Addres"
                     value="<?php echo isset($_COOKIE['q2']) ? htmlspecialchars($_COOKIE['q2']) : ''; ?>" required>
               </div>
               <div class="field">
                  <div class="label">
                     Q3: Quel est le nom de votre entreprise ?
                  </div>
                  <input type="text" name="q3" placeholder="Company Name"
                     value="<?php echo isset($_COOKIE['q3']) ? htmlspecialchars($_COOKIE['q3']) : ''; ?>" required>
               </div>
               <div class="field">
                  <div class="label">
                     Q4: Quel est votre poste dans l’entreprise ?
                  </div>
                  <input type="text" name="q4" placeholder="Company Position"
                     value="<?php echo isset($_COOKIE['q4']) ? htmlspecialchars($_COOKIE['q4']) : ''; ?>" required>
               </div>
               <div class="field btns">
                  <button class="prev-1 prev">Précédent</button>
                  <button class="next-1 next">Suivant</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP 3:
               </div>
               <div class="field">
                  <div class="label">
                     Q5: Quel est le nom du poste pour lequel vous recrutez ?
                  </div>
                  <select id="q5" name="q5" onchange="showSpecifyInput('q5','q7','q5field','q7field','disabled7')">
                     <option <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Product Owner" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Product Owner') ? 'selected' : ''; ?>>Product Owner</option>
                     <option value="Product Manager" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Product Manager') ? 'selected' : ''; ?>>Product Manager</option>
                     <option value="Lead product manager" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Lead product manager') ? 'selected' : ''; ?>>Lead product manager</option>
                     <option value="Product director" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Product director') ? 'selected' : ''; ?>>Product director</option>
                     <option value="Vice-president (VP) product" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Vice-president (VP) product') ? 'selected' : ''; ?>>Vice-president (VP) product
                     </option>
                     <option value="Chief product officer (CPO)" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Chief product officer (CPO)') ? 'selected' : ''; ?>>Chief product officer (CPO)
                     </option>
                     <option value="Autre" <?php echo (isset($_COOKIE['q5']) && $_COOKIE['q5'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                  </select>

               </div>
               <div id="q5field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field">
                  <div class="label">
                     Q6: Quel est le niveau d'expérience global que vous recherchez chez le candidat ?
                  </div>
                  <select id="options" name="q6">
                     <option <?php echo (isset($_COOKIE['q6']) && $_COOKIE['q6'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Junior" <?php echo (isset($_COOKIE['q6']) && $_COOKIE['q6'] == 'Junior') ? 'selected' : ''; ?>>Junior</option>
                     <option value="Intermédiaire" <?php echo (isset($_COOKIE['q6']) && $_COOKIE['q6'] == 'Intermédiaire') ? 'selected' : ''; ?>>Intermédiaire</option>
                     <option value="Senior" <?php echo (isset($_COOKIE['q6']) && $_COOKIE['q6'] == 'Senior') ? 'selected' : ''; ?>>Senior</option>
                  </select>

               </div>
               <div class="field">
                  <div class="label">
                     Q7: Dans quel contexte ou industrie s'inscrit ce poste ?
                  </div>
                  <select id="q7" name="q7" onchange="showSpecifyInput('q5','q7','q5field','q7field','disabled7')">
                     <option <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Technologie" <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'Technologie') ? 'selected' : ''; ?>>Technologie</option>
                     <option value="Santé" <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'Santé') ? 'selected' : ''; ?>>Santé</option>
                     <option value="Éducation" <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'Éducation') ? 'selected' : ''; ?>>Éducation</option>
                     <option value="E-commerce" <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'E-commerce') ? 'selected' : ''; ?>>E-commerce</option>
                     <option value="Autre" <?php echo (isset($_COOKIE['q7']) && $_COOKIE['q7'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                  </select>

               </div>
               <div id="q7field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field btns">
                  <button class="prev-2 prev">Précédent</button>
                  <button class="next-2 next" id="disabled7">Suivant</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP 4:
               </div>
               <div class="field" style="height:max-content; flex-wrap:wrap;">
                  <div class="label">
                     Q8: Quelles compétences spécifiques souhaitez-vous évaluer dans cescénario ? (Sélectionnez au moins
                     une)
                  </div>
                  <div class="row mt-4">
                     <div class="col col-lg-4 col-md-6 col-12 text-start">
                        <div class="form-check">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox1"
                              value="Gestion de produit strategique" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], 'Gestion de produit strategique') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox1">Gestion de produit stratégique</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox2"
                              value="efinition de la vision produit" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], 'efinition de la vision produit') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox2">éfinition de la vision produit</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox3"
                              value="Élaboration de la feuille de route" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], 'Élaboration de la feuille de route') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox3">Élaboration de la feuille de
                              route</label>
                        </div>
                     </div>
                     <div class="col col-lg-4 col-md-6 col-12 text-start">
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox5"
                              value="Gestion de l'équipe produit" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], `Gestion de l'équipe produit`) !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox5">Gestion de l'équipe produit</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox6"
                              value="Analyse de données et prise de décision" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], 'Analyse de données et prise de décision') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox6">Analyse de données et prise de
                              décision</label>
                        </div>
                     </div>
                     <div class="col col-lg-4 col-md-6 col-12 text-start">
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox7"
                              value="Communication et interaction avec les parties prenantes" <?php echo (isset($_COOKIE['q8']) && strpos($_COOKIE['q8'], 'Communication et interaction avec les parties prenantes') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="inlineCheckbox7">Communication et interaction avec les
                              parties prenantes</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q8[]" type="checkbox" id="inlineCheckbox8"
                              value="Autre"
                              onchange="showSpecifyInput('inlineCheckbox8','q9','q8field','q9field','disabled9')">
                           <input type="hidden" id="Valuechecker" readonly disabled>
                           <label class="form-check-label" for="inlineCheckbox8">Autre</label>
                        </div>
                     </div>
                  </div>
               </div>

               <div id="q8field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror  d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field">
                  <div class="label">
                     Q9: Quel est l'objectif principal de ce scénario ?
                  </div>
                  <select id="q9" name="q9"
                     onchange="showSpecifyInput('inlineCheckbox8','q9','q8field','q9field','disabled9')">
                     <option <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Évaluer la capacité à prioriser des fonctionnalités" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Évaluer la capacité à prioriser des fonctionnalités') ? 'selected' : ''; ?>>Évaluer la capacité à prioriser des fonctionnalités</option>
                     <option value="Tester la communication de la vision produit" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Tester la communication de la vision produit') ? 'selected' : ''; ?>>Tester la
                        communication de la vision produit</option>
                     <option value="Évaluer la gestion de l'équipe" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Évaluer la gestion de l\'équipe') ? 'selected' : ''; ?>>Évaluer la gestion de
                        l'équipe</option>
                     <option value="Mesurer la prise de décision basée sur les données" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Mesurer la prise de décision basée sur les données') ? 'selected' : ''; ?>>Mesurer la prise de décision basée sur les données</option>
                     <option value="Évaluer la créativité en matière de développement produit" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Évaluer la créativité en matière de développement produit') ? 'selected' : ''; ?>>Évaluer la créativité en matière de développement produit
                     </option>
                     <option value="Autre" <?php echo (isset($_COOKIE['q9']) && $_COOKIE['q9'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                  </select>

               </div>
               <div id="q9field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field btns">
                  <button class="prev-3 prev">Précédent</button>
                  <button class="next-3 next" id="disabled9">Suivant</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP: 5
               </div>
               <div class="field">
                  <div class="label">
                     Q10: Quel est l'objectif commercial principal du produit dans ce scénario ?
                  </div>
                  <select id="q10" name="q10"
                     onchange="showSpecifyInput('q11inlineCheckbox6','q10','q11field','q10field','disabled10')">
                     <option <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Croissance des revenus" <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Croissance des revenus') ? 'selected' : ''; ?>>Croissance des revenus</option>
                     <option value="Acquisition de clients" <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Acquisition de clients') ? 'selected' : ''; ?>>Acquisition de clients</option>
                     <option value="Fidélisation des clients" <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Fidélisation des clients') ? 'selected' : ''; ?>>Fidélisation des clients
                     </option>
                     <option value="Amélioration de la rentabilité" <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Amélioration de la rentabilité') ? 'selected' : ''; ?>>Amélioration de la
                        rentabilité</option>
                     <option value="Autre" <?php echo (isset($_COOKIE['q10']) && $_COOKIE['q10'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                  </select>

               </div>
               <div id="q10field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field" style="height:max-content;">
                  <div class="label">
                     Q11: Quels sont les principaux défis auxquels le produit est confronté dans ce scénario ?
                     (Sélectionnez au moins un)
                  </div>
                  <div class="row mt-4">
                     <div class="col col-lg-6 col-12 text-start">
                        <div class="form-check">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox1"
                              value="Concurrence féroce" <?php echo (isset($_COOKIE['q11']) && strpos($_COOKIE['q11'], 'Concurrence féroce') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="q11inlineCheckbox1">Concurrence féroce</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox2"
                              value="Changements rapides sur le marché" <?php echo (isset($_COOKIE['q11']) && strpos($_COOKIE['q11'], 'Changements rapides sur le marché') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="q11inlineCheckbox2">Changements rapides sur le
                              marché</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox3"
                              value="Complexité technique" <?php echo (isset($_COOKIE['q11']) && strpos($_COOKIE['q11'], 'Complexité technique') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="q11inlineCheckbox3">Complexité technique</label>
                        </div>
                     </div>
                     <div class="col col-lg-6 col-12 text-start">
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox4"
                              value="Évolution des besoins des clients" <?php echo (isset($_COOKIE['q11']) && strpos($_COOKIE['q11'], 'Évolution des besoins des clients') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="q11inlineCheckbox4">Évolution des besoins des
                              clients</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox5"
                              value="Contraintes budgétaires" <?php echo (isset($_COOKIE['q11']) && strpos($_COOKIE['q11'], 'Contraintes budgétaires') !== false) ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="q11inlineCheckbox5">Contraintes budgétaires</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" name="q11[]" type="checkbox" id="q11inlineCheckbox6"
                              value="Autre"
                              onchange="showSpecifyInput('q11inlineCheckbox6','q10','q11field','q10field','disabled10')">
                           <label class="form-check-label" for="q11inlineCheckbox6">Autre</label>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="q11field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror  d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field btns">
                  <button class="prev-4 prev">Previous</button>
                  <button class="next-4 next" id="disabled10">Next</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP: 6
               </div>
               <div class="field">
                  <div class="label">
                     Q12: Souhaitez-vous définir un temps maximum pour réaliser ce use case ?
                  </div>
                  <div class="d-flex flex-md-row flex-column gap-3">
                     <select id="q12" name="q12" onchange="showSpecifyInput2('q12','q12field')"
                        value="<?php echo isset($_COOKIE['q12']) ? htmlspecialchars($_COOKIE['q12']) : ''; ?>">
                        <option <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                        <option value="Oui" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == 'Oui') ? 'selected' : ''; ?>>Oui</option>
                        <option value="Non" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == 'Non') ? 'selected' : ''; ?>>Non</option>
                     </select>
                     <select id="q12field" name="q12Extra" style="display: none;">
                        <option <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                        <option value="1 heure" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '1 heure') ? 'selected' : ''; ?>>1 heure</option>
                        <option value="2 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '2 heures') ? 'selected' : ''; ?>>2 heures</option>
                        <option value="3 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '3 heures') ? 'selected' : ''; ?>>3 heures</option>
                        <option value="4 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '4 heures') ? 'selected' : ''; ?>>4 heures</option>
                        <option value="5 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '5 heures') ? 'selected' : ''; ?>>5 heures</option>
                        <option value="6 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '6 heures') ? 'selected' : ''; ?>>6 heures</option>
                        <option value="7 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '7 heures') ? 'selected' : ''; ?>>7 heures</option>
                        <option value="8 heures" <?php echo (isset($_COOKIE['q12']) && $_COOKIE['q12'] == '8 heures') ? 'selected' : ''; ?>>8 heures</option>
                     </select>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q13: Dans quelle langue souhaitez-vous générer votre use case ?
                  </div>
                  <select id="q13" name="q13" onchange="showSpecifyInput3('q13','q13field','disabled12')">
                     <option <?php echo (isset($_COOKIE['q13']) && $_COOKIE['q13'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                     <option value="Anglais" <?php echo (isset($_COOKIE['q13']) && $_COOKIE['q13'] == 'Anglais') ? 'selected' : ''; ?>>Anglais</option>
                     <option value="Français" <?php echo (isset($_COOKIE['q13']) && $_COOKIE['q13'] == 'Français') ? 'selected' : ''; ?>>Français</option>
                     <option value="Autre" <?php echo (isset($_COOKIE['q13']) && $_COOKIE['q13'] == 'Autre') ? 'selected' : ''; ?>>Autre</option>
                  </select>

               </div>
               <div id="q13field" class="field" style="display: none;">
                  <label class="label" for="otherText">Specify:</label>
                  <input type="text" id="otherText" name="otherText">
                  <span class="specifyerror d-block">Désolé, pour l’instant le Use case engine ne propose pas de cas
                     pour ce rôle</span>
               </div>
               <div class="field">
                  <div class="label">
                     Q14: Avez-vous des exigences de format ou de structure pour le scénario généré ?
                  </div>
                  <div class="d-flex flex-md-row flex-column gap-3">
                     <select id="q14" name="q14" onchange="showSpecifyInput2('q14','q14field')">
                        <option <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Select option') ? 'selected' : ''; ?>>Select option</option>
                        <option value="Oui" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Oui') ? 'selected' : ''; ?>>Oui</option>
                        <option value="Non" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Non') ? 'selected' : ''; ?>>Non</option>
                     </select>
                     <select id="q14field" name="q14Extra" style="display: none;">
                        <option <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Select Option') ? 'selected' : ''; ?>>Select option</option>
                        <option value="Slides" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Slides') ? 'selected' : ''; ?>>Slides</option>
                        <option value="Spreadsheet" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Spreadsheet') ? 'selected' : ''; ?>>Spreadsheet</option>
                        <option value="Notion page" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Notion page') ? 'selected' : ''; ?>>Notion page</option>
                        <option value="Tableau" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Tableau') ? 'selected' : ''; ?>>Tableau</option>
                        <option value="Document texte" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Document texte') ? 'selected' : ''; ?>>Document texte</option>
                        <option value="Figma" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Figma') ? 'selected' : ''; ?>>Figma</option>
                        <option value="Wireframes" <?php echo (isset($_COOKIE['q14']) && $_COOKIE['q14'] == 'Wireframes') ? 'selected' : ''; ?>>Wireframes</option>
                     </select>
                  </div>
               </div>
               <div class="field btns">
                  <button class="prev-5 prev">Previous</button>
                  <button class="next-5 next" name="setcookies" role="button" type="submit"
                     id="disabled12">Next</button>
               </div>
            </div>
            <div class="page-samad">
               <div class="title">
                  STEP: 7 Résumé
               </div>
               <div class="field">
                  <div class="label">
                     Q5: Quel est le nom du poste pour lequel vous recrutez ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q5']) ? htmlspecialchars($_COOKIE['q5']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-28.6%','2')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q6: Quel est le niveau d'expérience global que vous recherchez chez le candidat ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q6']) ? htmlspecialchars($_COOKIE['q6']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-28.6%','2')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q7: Dans quel contexte ou industrie s'inscrit ce poste ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q7']) ? htmlspecialchars($_COOKIE['q7']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-28.6%','2')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q8: Quelles compétences spécifiques souhaitez-vous évaluer dans ce scénario ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q8']) ? htmlspecialchars($_COOKIE['q8']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-42.9%','3')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q9: Quel est l'objectif principal de ce scénario ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q9']) ? htmlspecialchars($_COOKIE['q9']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-42.9%','3')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q10: Quel est l'objectif commercial principal du produit dans ce scénario ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q10']) ? htmlspecialchars($_COOKIE['q10']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-57.2%','4')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q11: Quels sont les principaux défis auxquels le produit est confronté dans ce scénario ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q11']) ? htmlspecialchars($_COOKIE['q11']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-57.2%','4')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q12: Souhaitez-vous définir un temps maximum pour réaliser ce use case ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q12']) ? htmlspecialchars($_COOKIE['q12']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-71.5%','5')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q13: Dans quelle langue souhaitez-vous générer votre use case ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q13']) ? htmlspecialchars($_COOKIE['q13']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-71.5%','5')"></i>
                  </div>
               </div>
               <div class="field">
                  <div class="label">
                     Q14: Avez-vous des exigences de format ou de structure pour le scénario généré ?
                  </div>
                  <div class="answer d-flex justify-content-between">
                     Ans:
                     <?php echo isset($_COOKIE['q14']) ? htmlspecialchars($_COOKIE['q14']) : ''; ?>
                     <i class="fas fa-edit" onclick="edit('-71.5%','5')"></i>
                  </div>
               </div>
               <div class="mb-3" style="text-align:-webkit-center">
                  <div class="g-recaptcha" data-sitekey="6Lf6JDspAAAAADIaxF5pNkOw7fj0b6OGiQBJeKHb"></div>
               </div>
               <div class="field btns">
                  <button class="prev-6 prev">Previous</button>
                  <button class="submit" name="submit">Submit</button>
               </div>
            </div>
         </form>
      </div>
   </div>

   <script src="./script/script.js"></script>
   <script src="./script/load.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
</body>

</html>