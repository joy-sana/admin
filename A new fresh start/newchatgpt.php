<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: signin.php");
    exit;
}

$fullname = $_SESSION['name'];

include "DataBase_Connection.php";
// $eM = $_SESSION['username'];
$_SESSION['score'] = 0;

// Fetch questions and answers
$sql = "SELECT q.*, a.options AS answer_option, a.ans AS answer FROM `question` q INNER JOIN `answer` a ON q.q_no = a.q_no";
$result = mysqli_query($connection, $sql);
$num = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Exam Page</title>
    <link rel="stylesheet" href="css\exam.css">
    <link rel="stylesheet" href="css\button.css">
</head>

<body>
    <form method="POST">
        <div class="question_tab">
            <?php if ($num > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <hr>
                    <h2>Question No. <?php echo $row['q_no']; ?>:</h2>
                    <h3><?php echo $row['Mcq_question']; ?></h3>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php $option = "option" . $i; ?>
                        <input type="radio" name="opt<?php echo $row['q_no']; ?>" value="<?php echo $row[$option]; ?>" required> <?php echo $row[$option]; ?><br>
                    <?php endfor; ?>
                    <?php $_SESSION['answers'][$row['q_no']] = $row['answer']; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <input type="submit" name="finish_exam">
    </form>

    <?php
    if (isset($_POST['finish_exam'])) {
        $marks = 0;
        for ($i = 1; $i <= $num; $i++) {
            $answer = $_POST['opt' . $i];
            if ($answer == $_SESSION['answers'][$i]) {
                $marks += 1;
            }
        }
        $_SESSION['score'] = $marks;
        echo "<h2>Your score is: " . $marks . "</h2>";
    }
    ?>

</body>

</html>
