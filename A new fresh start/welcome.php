<?php
session_start();
if ( !isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: signin.php");
    exit;
}

$fullname = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>exam page</title>
    <link rel="stylesheet" href="admin/new2.css">
    <!-- <link rel="stylesheet" href="css\button.css"> -->

</head>

<body>
    <div class="container">
        <div>
            <h2>Welcome Back <?php echo $fullname ?> </h2>

            <a href="logout.php">
                <button class="btn-log" type="submit">logout</button>
            </a>
            
        </div>
        <div>

            <h1>Welcome To Online Examination</h1>
            <div class="center">
                <p class="lead">Test Your Knowledge on php</p>
                <br />

                <p class="lead">Total Number Of Question: </strong><b> 10 </b></p>
                <p><strong>Question Type: </strong>Multiple Choice (MCQ)</p>
            </div>
            <br />

            <div> <a href="test.php">

                    <button class="btn-start">Start Exam</button>
                </a>
            </div>

        </div>
    </div>
</body>

</html>


'''
if open signin/sign up while logged in
show a new page that shows that already logged in as ---
logout to continue 

'''