<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: signin.php");
    exit;
}

$fullname = $_SESSION['name'];

include "DataBase_Connection.php";
// $eM = $_SESSION['username'];
$_SESSION['score']  = 0;

$sql = "SELECT * FROM `question`";
$result = mysqli_query($connection, $sql);
$num = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>exam page</title>
    <link rel="stylesheet" href="css\exam.css">
    <link rel="stylesheet" href="css\button.css">

</head>

<body>

    <form method="POST">

        <div class="question_tab">
            <section>

                <?php
                if ($num > 0) {
                    while ($rows = $result->fetch_assoc()) {
                ?>
                    <hr>
                    <p>
                        <h2>Question No.
                            <?php echo $rows['q_no']; ?>:
                        </h2>
                        <h3>
                            <?php echo $rows['Mcq_question']; ?>
                        </h3>

                        <?php
                        // Get the answers for the current question
                        $sql1 = "SELECT * FROM `answer` WHERE `q_no` = {$rows['q_no']}";
                        $answer = mysqli_query($connection, $sql1);
                        $num2 = mysqli_num_rows($answer);

                        if ($num2 > 0) {
                            while ($rows2 = $answer->fetch_assoc()) {
                        ?>

                                <input type="radio" name="opt<?php echo $rows['q_no'] ?>" id="id<?php echo $rows2['id'] ?>" value="<?php echo $rows2['id'] ?>" required />
                                <?php echo $rows2['options']; ?><br>

                        <?php
                            }
                        }
                        ?>

                    </p>

                <?php
                    }
                }
                ?>

            </section>
        </div>

        <input type="submit" name='finish_exam'>

    </form>

    <?php
    // Check if the form was submitted
    if (isset($_POST['finish_exam'])) {

        $marks = 0;

        // Loop through each question and check if the selected option is correct
        $sql = "SELECT * FROM `question`";
        $result = mysqli_query($connection, $sql);
        $num = mysqli_num_rows($result);

        for ($i = 1; $i <= $num; $i++) {
            // Get the correct option for the current question
            $sql = "SELECT `correct_option` FROM `answer` WHERE `q_no` = $i AND `ans+` = 1";
            $result = mysqli_query($connection, $sql);
            $correct_option = mysqli_fetch_assoc($result)['correct_option'];

            // Check if the selected option is correct
            $selected_option = $_POST['opt' . $i];
            if ($selected_option == $correct_option) {
                $marks += 1;
            }
        }

        echo "Total Marks Obtained: " . $marks;
    }
    ?>

</body>

</html>
