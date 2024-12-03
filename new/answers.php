<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quiz: Answers and Scored Points</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
</head>

<body>
    <h2>Answers...</h2>
    <?php
    $quiz_set_id = isset($_REQUEST['set']) ? htmlspecialchars($_REQUEST['set']) : "01";

    // Load and decode the questions
    $questions = [];
    $file_path = "set-$quiz_set_id.json";
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
        echo "<ol>";
        foreach ($questions as $question) {
            // Escape output to prevent XSS
            echo "<li><div>" . htmlspecialchars($question[0]) . "</div>";
            echo "<div>" . htmlspecialchars($question[2][$question[1] - 1]) . "</div></li>";
        }
        echo "</ol>";
    } else {
        echo "<p>No questions available.</p>";
    }
    ?>

    <?php
    $correct_count = 0;
    $total_questions = count($questions);

    if (isset($_REQUEST['answers']) && is_array($_REQUEST['answers'])) {
        foreach ($_REQUEST['answers'] as $answer_index => $answer) {
            $question_index = $answer_index - 1; // Adjust for zero-based index
            if (isset($questions[$question_index]) && $questions[$question_index][1] == $answer) {
                $correct_count++;
            }
        }
    } else {
        echo "<p>No answers provided.</p>";
    }
    ?>

    <h2>Scored Points...</h2>
    <div>
        <?= htmlspecialchars($correct_count) ?>/<?= htmlspecialchars($total_questions) ?> correct
    </div>
</body>

</html>