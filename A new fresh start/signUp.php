<?php

$showalert = false;



// create a connection with database
include('DataBase_Connection.php');


if (isset($_POST['SignUp'])) {

    $fullName = $_POST['fullName'];
    $Email_id = $_POST['Email_id'];
    $Username = $_POST['Username'];
    $phone = $_POST['phoneNumber'];
    $gendar = $_POST['gender'];
    $password = $_POST['Password'];
    $con_password = $_POST['C_Password'];

    if ($password == $con_password) {
        //chechks phone number is unique or not
        $statement = $connection->Prepare("SELECT * FROM `new_sample` WHERE Email = ?");

        $statement->bind_param("s", $Email_id);
        $statement->execute();
        $statement_result = $statement->get_result();

        //if number is not uniqe throws a alart
        if ($statement_result->num_rows > 0) {
            $showalert = "Warning: Email Already Exists!!!";
        }
        //else data inserted into database
        else {
            $sql_insert = "INSERT INTO new_sample(name,email,username,phone,gender,Password)VALUES('$fullName','$Email_id','$Username','$phone','$gendar','$password')";
            $query = mysqli_query($connection, $sql_insert);
            $showalert = "Congratulation Your account has been created successfully";
        }
    } else {
        $showalert =  "Warning: Password is not matchning";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="admin\new2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="js\showpass.js"></script>
</head>

<body>

    <div>
        <?php
        if ($showalert) {
            echo $showalert;
        }
        ?>
    </div>

    <h1>sign up page</h1>
    <div>

        <form method="POST">
            <!-- <form action="signUp.php" method="POST"> -->
            <div>
                <lable>Full Name:</lable>

                <input type="text" placeholder="Enter Your Name" name='fullName' required>

            </div>
            <div>
                <lable>Username:</lable>

                <input type="text" placeholder="Create Username" name="Username" required>

            </div>
            <div>
                <lable>Mobile Number:</lable>

                <input type="text" placeholder="Enter Mobile number" name='phoneNumber' required>

            </div>
            <div>
                <lable>Email:</lable>

                <input type="text" placeholder="Enter Email" name='Email_id' required>

            </div>
            <div>
                <lable>Gender:</lable>
                <div class="Gender">
                    <input type="radio" name="gender" value="Male" required>Male
                    <input type="radio" name="gender" value="Female" required>Female
                    <input type="radio" name="gender" value="Others" required>Others
                </div>
            </div>

            <div>
                <lable for="mypwd">Password:</lable>
                <div class="password-input-container">
                    <input type="password" placeholder="Enter a secure password" name='Password' id="mypwd" required>
                    <div class="show-password-container">
                        <input type="checkbox" onclick="myFunction('mypwd')" id="show-password-checkbox">
                        <label for="show-password-checkbox"><i class="fas fa-eye"></i></label>
                    </div>
                </div>
            </div>
            <div>
                <lable for="conpwd">Confirm Password:</lable>
                <div class="password-input-container">
                    <input type="password" placeholder="Re-Enter password" name='C_Password' id="conpwd" required>
                    <div class="show-password-container">
                        <input type="checkbox" onclick="myFunction('conpwd')" id="show-password-checkbox-2">
                        <label for="show-password-checkbox-2"> <i class="fas fa-eye"></i></label>
                    </div>
                </div>
            </div>

            <div>
                <input type="submit" name='SignUp' required>
            </div>

            <div class="signup_link">
            Already a member?<a href="signin.php">click hare to Sign-in</a>
            </div>
        </form>

    </div>

</body>

</html>