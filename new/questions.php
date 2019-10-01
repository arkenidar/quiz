<!doctype html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<form action="answers.php" method="post">
<input type="hidden" name="set" value="<?=htmlspecialchars($_REQUEST['set'])?>">
<?php foreach(json_decode(file_get_contents('set'.$_REQUEST['set'].'.json')) as $quest_idx=>$question){ ?>
<div><?=$question[0]?><br>
<?php foreach($question[1] as $poss_idx=>$possibility){ ?>
<input type="radio" name="answers[<?=$quest_idx?>]" value="<?=$poss_idx?>"><?=$possibility?><br>
<?php } ?>
</div>
<?php } ?>
<input type="submit">
</form>

