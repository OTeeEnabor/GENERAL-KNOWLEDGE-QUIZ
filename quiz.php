<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/quizstylesheet.css">
    <title>QUIZ</title>
</head>
<body>
<body id ="firstPageBody">

<!--PHP Code starts here -->

<?php

# load the quiz questions and choices into an array of arrays. 
// function{

// }
$filename_q = "questions.txt";
$filename_a = "answers.txt";

#loads a text file which has the questions and choices into an array.

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
#The is a 2 dimensional array with the first element in the array = question and the second = answer.
function loadQuestions($filename){
    if(file_exists($filename)){
        $questionsA = file($filename);
    }
    else{echo"Error file does not exist";}
    return $questionsA;
}

#this function will sepererate the array of arrays into an array of questions and array of answers. 

$QA_array = file($filename_q);
#load answers text file into an array.
$answers_array = file($filename_a);

#create an array that has only the questions
$question_only =array();

foreach($QA_array as $key => $value){
    $question_only[]=explode(':',$value);
}
var_dump($question_only);
var_dump($QA_array);
var_dump($answers_array);





?>
<!--PHP code ends here--->

<!--Main Section Starts Here-->
    <main>
        <div class=''>
            <h1 id="heading1">
                CodeSpace General Knowledge Quiz
            </h1>
        </div>
        <form action="" method="post">
            input




        </form>
        
    </main>


    
</body>
</html>
</body>
</html>