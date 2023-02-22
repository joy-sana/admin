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

$sql1 = "SELECT * FROM `answer`";
$answer = mysqli_query($connection, $sql1);
$num2 = mysqli_num_rows($answer);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>exam page</title>
    <link rel="stylesheet" href="css\exam.css">
    <link rel="stylesheet" href="css\button.css">

</head>

<body>
    <!-- <div class="container"> -->

    <!-- <div><a href="signin.html">
            <button class="btn-log" type="submit">logout</button>
        </a>
    </div> -->
    <!-- <div class="question"> -->


    <form action="calculate.php" method="POST">

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
                            for ($x = 1; $x <= 4; $x++) {
                                $rows2 = $answer->fetch_assoc()
                            ?>

                                <input type="radio" name="option<?php echo $rows['q_no'] ?>]" id="id<?php echo $rows2['id'] ?>" value="value<?php echo $rows2['id'] ?>" required />
                                <?php echo $rows2['options'];
                                // $_SESSION['score'] += $rows2['ans'];
                                ?><br>
                                
                          

                                </p>

                    <?php
                            }
                        }
                    }
                    ?>

            </section>
        </div>

        <input type="submit" name='finish_exam'>

    </form>
    <!-- </div>
</div> -->

</body>

</html>