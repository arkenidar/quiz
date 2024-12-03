<!DOCTYPE html>
<html lang="en"> <head>
<title>Quiz: questions</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

</head> <body>

<?php $quiz_set_id = isset($_REQUEST['set'])? $_REQUEST['set'] : "01" ?>
<h2>Questions...</h2>

<form action="answers.php" method="post">
<input type="hidden" name="set" value="<?=htmlspecialchars($quiz_set_id)?>">

<ol>
<?php foreach(json_decode(file_get_contents("set-$quiz_set_id.json"))
    as $quest_idx=>$question){ ?>
    
    <li><?=$question[0]?><br>
    <ol>
    <?php foreach($question[2] as $poss_idx=>$possibility){ ?>
    <li><label> <input type="radio" name="answers[<?=$quest_idx+1?>]" value="<?=$poss_idx+1?>" id="id_<?=$quest_idx+1?>_<?=$poss_idx+1?>">
        <?=$possibility?> 
        </label></li>

    <?php } ?>
    </ol>

    </li>
<?php } ?>
</ol>
<input type="submit">
</form>

</body> </html>
