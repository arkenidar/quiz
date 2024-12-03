<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quiz: Questions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
</head>

<body>
    <?php
    $quiz_set_id = isset($_REQUEST['set']) ? htmlspecialchars($_REQUEST['set']) : "01";
    $questions = [];
    $file_path = "set-$quiz_set_id.json";

    // Load the quiz questions
    if (file_exists($file_path)) {
        $questions = json_decode(file_get_contents($file_path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "<div>Error decoding JSON: " . htmlspecialchars(json_last_error_msg()) . "</div>";
            $questions = [];
        }
    } else {
        echo "<div>Quiz set not found.</div>";
    }

    if (!empty($questions)) {
    ?>
        <h2>Questions...</h2>
        <form action="answers.php" method="post">
            <input type="hidden" name="set" value="<?= htmlspecialchars($quiz_set_id) ?>">

            <ol>
                <?php foreach ($questions as $quest_idx => $question) { ?>
                    <li>
                        <div><?= htmlspecialchars($question[0]) ?></div>
                        <ol>
                            <?php foreach ($question[2] as $poss_idx => $possibility) { ?>
                                <li>
                                    <label>
                                        <input type="radio" name="answers[<?= htmlspecialchars($quest_idx + 1) ?>]"
                                            value="<?= htmlspecialchars($poss_idx + 1) ?>"
                                            id="id_<?= htmlspecialchars($quest_idx + 1) ?>_<?= htmlspecialchars($poss_idx + 1) ?>">
                                        <?= htmlspecialchars($possibility) ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ol>
                    </li>
                <?php } ?>
            </ol>
            <input type="submit" value="Submit">
        </form>
    <?php
    } else {
        echo "<p>No questions available.</p>";
    }
    ?>
</body>

</html>