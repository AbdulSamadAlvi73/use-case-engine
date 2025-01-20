<?php
// $conn = mysqli_connect('localhost', 'root', '', 'use_case_engine');
require("../Admin/conn.php");

session_start();
$unique_code = $_SESSION['unique_code'];

// Check if the form is submitted
if (isset($_POST['prompt2'])) {
   $promptFetchQuery = "SELECT prompt_two FROM prompt2 where unique_code = '$unique_code'";
   $run = mysqli_query($conn, $promptFetchQuery);

   if ($run) {
      // Check if there are rows in the result set
      if (mysqli_num_rows($run) > 0) {
         // Fetch a single row and store it in the $answers array
         $row = mysqli_fetch_assoc($run);

         // Now, $row contains the fetched data from the database
         // Use print_r or var_dump to see the structure of $row

         // Store the column value
         $answer = $row['prompt_two'];
      } else {
         $getuserdata = "SELECT * FROM prompt1 where unique_code = '$unique_code'";
         $query_run = mysqli_query($conn, $getuserdata);

         // Array to hold questions and answers
         while ($row = mysqli_fetch_assoc($query_run)) {
            $assign = "Provide me the answer which contain 200 words about";
            $question = $assign . $row['prompt_one'] . " Quel est le résultat type attendu?";



            $answers = array(); // Array to hold the answers

            // Your OpenAI API endpoint and key
            $openai_endpoint = 'https://api.openai.com/v1/completions';

            $openai_api_key = 'api_key';

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

            $response = json_decode($result, true);

            // Store the answer in the $answers array
            $answer = isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : 'Error fetching response';
            // $answers[] = $answer;

            // Prepare the SQL statement with placeholders
            $query = "INSERT INTO prompt2 (prompt_two,unique_code) VALUES (?, ?)";

            // Prepare the statement
            $stmt = mysqli_prepare($conn, $query);

            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "ss", $prompt_two, $unique_code);

            // Set the variables
            $prompt_two = $answer;

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
   header("location:./prompt_1.php");
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
      <h1 class="title-samad-prompt1">Voir le résultat attendu</h1>
      <div class="form-outer-samad">
         <div class="prompt-box">
            <div class="page-samad">
               <div class="title d-flex justify-content-end">
                  <!-- Prompt: 2 -->
                  <div class="copy_clipboard" type="button" onclick="copyToClipboard()">copy: <i class="fas fa-copy"
                        id="icon"></i></div>
               </div>
               <div class="copy_clipboard" id="dataToCopy">
                  <div class="field">
                     <div class="answer">
                        <?php echo nl2br($answer) ?>
                     </div>
                  </div>
               </div>
               <div class="field btns">
                  <form>
                     <button class="prev" id="prompt2"><a href="./prompt_1.php" class="">Retour au use case</a></button>
                  </form>
                  <form action="./prompt_3.php" method="post">
                     <button class="submit" id="prompt3" name="prompt3">Voir un exemple</button>
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