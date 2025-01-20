<?php

// $conn = mysqli_connect('localhost', 'root', '', 'use_case_engine');
require("../Admin/conn.php");
session_start();
// $_SESSION['unique_code'] = 'kamal';
// unset();
// session_destroy();
$unique_code = $_REQUEST['unique_code'];

// exit;
// Check if the form is submitted
if (isset($_REQUEST['unique_code'])) {
   // echo $unique_code;
   // exit;
   $promptFetchQuery = "SELECT prompt_one,unique_code FROM prompt1 where unique_code = '$unique_code' order by unique_code desc ";
   $run = mysqli_query($conn, $promptFetchQuery);

   if ($run) {
      // Check if there are rows in the result set
      if (mysqli_num_rows($run) > 0) {
         // Fetch a single row and store it in the $answers array
         $row = mysqli_fetch_assoc($run);

         // print_r($row);
         // exit;

         // Now, $row contains the fetched data from the database
         // Use print_r or var_dump to see the structure of $row

         // Store the column value
         $answer = $row['prompt_one'];
      } else {
         $getuserdata = "SELECT * FROM form_data where unique_code = '$unique_code' order by unique_code desc";
         $query_run = mysqli_query($conn, $getuserdata);

         // Array to hold questions and answers
         while ($row = mysqli_fetch_assoc($query_run)) {
            $assign = "Provide me the answer which contain 200 words about";
            $question = $assign .
               "Génère moi un USE CASE. Le but est d'évaluer les compétences d'un candidat pour un
               poste de product Management. Voici des questions et des réponses qui t’aideront à créer un
               USE CASE personnalisé :,
               Q5: Quel est le nom du poste pour lequel vous recrutez ?:" . $row['q_5'] . ";,
               Q6: Quel est le niveau d'expérience global que vous recherchez chez le candidat ?:" . $row['q_6'] . ";,
               Q7: Dans quel contexte ou industrie s'inscrit ce poste ?:" . $row['q_7'] . ";,
               Q8: Quelles compétences spécifiques souhaitez-vous évaluer dans ce scénario ?: " . $row['q_8'] . ";,
               Q9: Quel est l'objectif principal de ce scénario ?: " . $row['q_9'] . ";,
               Q10: Quel est l'objectif commercial principal du produit dans ce scénario ?: " . $row['q_10'] . ";,
               Q11: Quels sont les principaux défis auxquels le produit est confronté dans ce scénario ?: " . $row['q_11'] . ";,
               Q12: Souhaitez-vous définir un temps maximum pour réaliser ce use case ?: " . $row['q_12'] . ";,
               Q13: Dans quelle langue souhaitez-vous générer votre use case ?:" . $row['q_13'] . ";,
               Q14: Avez-vous des exigences de format ou de structure pour le scénario généré ?: " . $row['q_14'] . ";";
            // Add more questions here...

            $answers = array(); // Array to hold the answers

            // Your OpenAI API endpoint and key
            $openai_endpoint = 'https://api.openai.com/v1/completions';
            $openai_api_key = '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';

            // Loop through each question
            $data = array(
               "model" => "text-davinci-003",
               "prompt" => $question,
               "temperature" => 0.2,
               "max_tokens" => 3500,
               "top_p" => 0.7,
               "frequency_penalty" => 0.8,
               "presence_penalty" => 0.8
            );

            $data = json_encode($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $openai_endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

            $headers = array(
               'Content-Type: application/json',
               'Authorization: Bearer ' . $openai_api_key
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
               echo 'Error:' . curl_error($ch);
            }

            curl_close($ch);

            // print_r($result);
            // exit;

            $response = json_decode($result, true);
            // Store the answer in the $answers array
            $answer = isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : 'Error fetching response';
            // $answers[] = $answer;

            // Prepare the SQL statement with placeholders
            $query = "INSERT INTO prompt1 (prompt_one,unique_code) VALUES (?, ?)";

            // Prepare the statement
            $stmt = mysqli_prepare($conn, $query);

            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "ss", $prompt_one, $unique_code);

            // Set the variables
            $prompt_one = $answer;

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
               echo "";
            } else {
               echo "Error: " . mysqli_error($conn);
            }

            // Close the statement and the connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
         }
      }
   }
   // The unique code is not present in the prompt_2 table

} else {
   header("location:../index.php");
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title>Use Case Engine</title>
   <link rel="stylesheet" href="../style/style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
   <!-- Loading Bar -->
   <div id="loading-bar"></div>
   <div class="container-samad">
      <header class="prompt1">Use case engine</header>
      <h1 class="title-samad-prompt1">Voici votre use case personnalisé</h1>

      <div class="form-outer-samad">
         <div class="prompt-box">
            <div class="page-samad">
               <div class="title d-flex justify-content-end">
                  <!-- Prompt: 1 -->
                  <div class="copy_clipboard" type="button" onclick="copyToClipboard()">copy: <i class="fas fa-copy"
                        id="icon"></i></div>
               </div>
               <div class="copy_clipboard" id="dataToCopy">
                  <div class="field">
                     <div class="answer">
                        <?php echo nl2br($answer); ?>
                     </div>
                  </div>
               </div>
               <div class="field btns">
                  <form action="./prompt_2.php" method="post">
                     <button class="prev" id="prompt2" name="prompt2">Voir le résultat attendu</button>
                  </form>
                  <form action="./startagain.php" method="post">
                     <button class="submit" id="startagain" name="startagain">Créer un nouveau use case</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="../script/script.js"></script>
   <script src="../script/load.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"></script>
</body>

</html>