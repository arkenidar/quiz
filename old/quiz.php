<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Quiz Application</title>
</head>

<body>
	<?php
	$questions = [
		['does a star emit light?', ['yes', 'no'], 0],
		['is a human always right?', ['yes', 'no'], 1],
	];

	if (@$_REQUEST['mode'] == 'solutions') {
		echo "solutions...<br>\n";
		foreach ($questions as $question) {
			echo '<div>';
			echo htmlspecialchars($question[0]) . '<br>' . htmlspecialchars($question[1][$question[2]]);
			echo "</div>\n";
		}
		$correct_count = 0;
		$count = count($questions);
		if (isset($_REQUEST['answers'])) {
			foreach ($_REQUEST['answers'] as $answer_index => $answer) {
				$correct = $questions[$answer_index][2] == $answer;
				if ($correct) $correct_count += 1;
			}
		}
		echo "<div>$correct_count/$count correct</div>";
	} else {
	?>
		<form method="get">
			<input type="hidden" name="mode" value="solutions">
			<?php
			foreach ($questions as $quest_idx => $question) {
				echo '<div>';
				echo htmlspecialchars($question[0]);
				echo '<br>';
				foreach ($question[1] as $poss_idx => $possibility) {
					echo '<input type="radio"' .
						' name="answers[' . $quest_idx . ']"' .
						' value="' . $poss_idx . '"' .
						' required>' .
						htmlspecialchars($possibility) . '<br>';
				}
				echo "</div>\n";
			}
			?>
			<input type="submit" value="Submit">
		</form>
	<?php
	}
	?>
</body>

</html>