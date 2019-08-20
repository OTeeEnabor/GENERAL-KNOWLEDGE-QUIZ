<?php
session_start();
?>
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
    <title>CodeSpace Results</title>
</head>
<body class="quiz-results-body">
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
        //this array will store the 20 questions. 
        $questionsOnly =array();
        //Check if the file exists if it does store the file contents into an array.
        if(file_exists($filename)){
        //Array of file content.
            $questionsA = file($filename);
    
    //Seperate the questions and store them into an array
            foreach($questionsA as $key => $value){
                $questionsOnly[] = explode(":",$value);
            }
        }
        else{echo"Error file does not exist";}
        return $questionsOnly;
    }
    
    #create a function that will show each question, and store the choices into an array.
    function showQuestions($questionsA){
    
        foreach($questionsA as $key => $value){
    
            #show the question
            echo <<<END
    
            <br>
            <div class ="question-style">
    
            <b>$value[0]</b>
    
            </div>
END;
    
            //Store choices of each question into a choice array
             $option = explode(",",$value[1]);
    
                foreach($option as $value){
            //Take the first element in the choice array, i.e the letters corresponding to each choice.
                    $choice_value = substr(trim($value),0,1);
    
                    echo <<<END
                    
                     <input type="radio" name="$key" 
                    value="$choice_value"></input>
                    <span class="question-option-style">$value</span>
                    <br>
END;
                }
        }
    }
    
    //Grade the quiz once the submit button is clicked.
    if(isset($_POST['submitquiz'])){
        //load the textfile that has the answers. 
        $answer_array = loadAnswer($filename_a);
        //Number of answers
        $answer_count = count($answer_array);
        //initialize the variable that will count the number of correct answers. 
        $count_correct = 0;
        //loop through the answer file and compare it with the answers submitted by the quiz taker. 
        foreach($answer_array as $key => $correct_answer){
            if(isset($_POST[$key])){
                if (strtoupper(rtrim($correct_answer)) == strtoupper($_POST[$key])){
                    $count_correct++;
                }
                else{
                    $incorrect_answer =array();
                    $incorrect_answers[] = strtoupper($_POST[$key]);
                }
            }
        }
    }
    // $count_correct;
    // echo $count_correct;
    ?>
<?php
   //GRADE THE QUIZ
   # A function to grade the quiz 
function gradeQuiz($quizResult){

    if ($quizResult  < 10){
        echo <<<END
        <div class="results-container">
            <p>
            You got $quizResult out of 20.
            </p>
            <p>
            You can improve your quiz result. Try again.
            </p>

            <div class="quiz-image-reaction-container">
            <img src="images/sad-face.png" alt="lol you can do it">
            </div>

            <a class="quiz-redo btn bg-primary" href ="quiz.php"> Try Again :)</a>
        </div>
        
END;
        
        #Reload the quiz
    }
    elseif($quizResult >10 && $quizResult <15){
        echo<<<END
        <div class="results-container">
        <p>
        Well done you got $quizResult out of 20
        </p>
        <p>
        Would you like to try again??
        </p>
        <div class="quiz-image-reaction-container">
            <img src="images/clever-face-edit.jpg" alt="lol you can do it">
            </div>
        <a class="quiz-redo btn" href ="quiz.php">Improve your score?</a>
        </div>
        
        
END;
    }

    else{
        echo<<<END
        <div class = results-container>
        <p>
        Well done, you got $quizResult out of 20 <br>
        </p>
        <div class="quiz-image-reaction-container">
            <img src="images/cool-face-edit.jpg" alt="lol you can do it">
        </div>

        </div>
        

END;
    }
}
// var_dump($_POST);
// var_dump($_SESSION["quiz-result"]) ;
// $test = 15;
$quiz_score = gradeQuiz($count_correct);
    ?>

</body>
</html>