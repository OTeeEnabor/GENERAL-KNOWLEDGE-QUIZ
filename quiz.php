<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Custom Stylesheet-->
    <link href="css/stylesheet.css"rel="stylesheet" type="text/css" >
    
    <title>QUIZ</title>
</head>
<body class ="page-body">

<!--PHP Code starts here -->

<?php
$filename_q = "questions.txt";
$filename_a = "answers.txt";

#this returns array of answers if the filename is found in the directory
function loadAnswer($filename){
    if (file_exists($filename)){
        $answer_array =file($filename);
    }
    else{
        echo "Error file does not exist.";
    }
    return $answer_array;
}
#this function returns an array of arrays with questions and answers if the file name in the directory. 

#The is a 2 dimensional array with the first element in the array = question and the second element = answer.
function loadQuestions($filename){
    $questionsOnly =array();
    if(file_exists($filename)){
        $questionsA = file($filename);

        foreach($questionsA as $key => $value){
            $questionsOnly[] = explode(":",$value);
        }
    }
    else{echo"Error file does not exist";}
    return $questionsOnly;
}

#create a function that seperates the questions and stores the choices into a seperate arrray.

function showQuestions($questionsA){
    foreach($questionsA as $key => $value){
        #show the question

        echo "<br><b>$value[0]</b><br>";

        #store choices of each question into a choice array
         $option = explode(",",$value[1]);
            foreach($option as $value){
                $choice_value = substr(trim($value),0,1);

                echo"<input type=\"radio\" name=\"$key\" value=\"$choice_value\">$value</input><br>";
            }
    }
// return $option;
}

## A function to grade the quiz

function gradeQuiz($quizResult){
    if ($quizResult  < 10){
        echo "You got $quizResult out of 20 <br>";
        echo "You can improve your quiz result. Try again.";
        #Reload the quiz
    }
    elseif($quizResult >10 && $quizResult <15){
        echo "Well done, you got $quizResult out of 20 <br>";
        echo "Would you like to try again";
    }

    else{
        echo "Well done, you got $quizResult out of 20 <br>";  
    }

}

?>
<?php

?>
<!--PHP code ends here--->

<!--Main Section Starts Here-->
    <main>
        <div class="quiz-heading-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                    <h1 id="heading1">
                CodeSpace General Knowledge Quiz
                </h1> 
                    </div>
                </div>
            </div>
        </div>

<!--START OF FORM HERE-->        
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<?php

        $loadedQuestions = loadQuestions($filename_q);
        showQuestions($loadedQuestions);
?>

        <input type="submit" name="submitquiz" value="Submit Quiz"/>

<!--END OF FORM HERE-->   

<?php
//Grade the quiz once the submit button is clicked.

if(isset($_POST['submitquiz'])){

    //load the textfile that has the answers. 
    $answer_array = loadAnswer($filename_a);
    //Number of answers
    $answer_count = count($answer_array);
    //initialize the variable that will count the number of correct answers. 
    $count_correct = 0;

    //loop through the answer file and compare it with the answers submitted by the quiz taker. 

    foreach($answer_array as $key =>$correct_answer){

        if(isset($_POST[$key])){

            if ($correct_answer == $_POST[$key]){

                $count_correct++;
            }
        }
    }

    echo "<br>Total number of correct answers: $count_correct";
}

?>
        
    </main>
   <!--Bootstrap JS pluggins--> 
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>