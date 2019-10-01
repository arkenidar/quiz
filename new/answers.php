<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">
solutions...<br>
<?php $questions=json_decode(file_get_contents('set'.$_REQUEST['set'].'.json')); ?>
<?php foreach($questions as $question){ ?>
<div><?=$question[0]?><br><?=$question[1][$question[2]]?></div>
<?php } ?>
<?php
$correct_count=0;
$count=count($questions);
foreach($_REQUEST['answers'] as $answer_index=>$answer){
$correct=$questions[$answer_index][2]==$answer;
if($correct) $correct_count++;
}
?>
<div><?=$correct_count?>/<?=$count?> correct</div>

