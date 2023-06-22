<!DOCTYPE html>
<html lang="en"> <head>
<title>quiz answers</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

</head> <body>

<h2>Solutions...</h2>
<?php $questions=json_decode(file_get_contents('set'.$_REQUEST['set'].'.json')); ?>

<ol>
<?php foreach($questions as $question){ ?>
    <li> <div><?=$question[0]?></div> <div><?=$question[1][$question[2]-1]?></div> </li>
<?php } ?>
</ol>

<?php
$correct_count=0;
$count=count($questions);
foreach($_REQUEST['answers'] as $answer_index=>$answer){
$correct=($questions[$answer_index-1][2])==$answer;
if($correct) $correct_count++;
}
?>
<h2>Punteggio</h2>
<div><?=$correct_count?>/<?=$count?> correct</div>

</body> </html>
