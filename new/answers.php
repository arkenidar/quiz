<!DOCTYPE html>
<html lang="en"> <head>
<title>Quiz: answers and scored points</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

</head> <body>

<h2>Answers...</h2>
<?php $quiz_set_id = isset($_REQUEST['set'])? $_REQUEST['set'] : "01" ?>
<?php $questions=json_decode(file_get_contents("set-$quiz_set_id.json")); ?>

<ol>
<?php foreach($questions as $question){ ?>
    <li> <div><?=$question[0]?></div> <div><?=$question[2][$question[1]-1]?></div> </li>
<?php } ?>
</ol>

<?php
$correct_count=0;
$count=count($questions);
foreach($_REQUEST['answers'] as $answer_index=>$answer){
    $correct=($questions[$answer_index-1][1])==$answer;
    if($correct) $correct_count++;
}
?>
<h2>Scored points....</h2>
<div><?=$correct_count?>/<?=$count?> correct</div>

</body> </html>
