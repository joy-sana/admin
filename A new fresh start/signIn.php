<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('DataBase_Connection.php');

    $Email_id = $_POST['Email_id'];
    $Username = $_POST['Username'];
    $password = $_POST['Password'];

    $stmt = $connection->Prepare("SELECT * FROM `new_sample` WHERE Email = ?");
    $stmt->bind_param("s", $Email_id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {

        $data = $stmt_result->fetch_assoc();
        if ($data['Password'] === $password && $data['username'] === $Username) {
            $login = true;

            session_start();
            $_SESSION['loggedin'] = $login;
            $_SESSION['username'] = $Username;
            $_SESSION['email'] = $Email_id;
            $_SESSION['name'] = $data['name'];

            if (!headers_sent()) {
                header("location: welcome.php");
            }
        } else {
            $showError = "Wrong Username or Password";
        }
    } else {
        $showError = "You don't have an Account on this Email:" . "$Email_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js\showpass.js"></script>
    <link rel="stylesheet" href="admin\new2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <div>
        <?php
        if ($showError); {
            echo $showError;
        }
        ?>
    </div>
    <h1>sign In hare</h1>

    <div>
        <form method="POST">

            <div>
                <lable for="email">Email:</lable>
                <input type="text" placeholder="Enter Email" name='Email_id' id="email" required>
            </div>

            <div>
                <lable for="username">Username:</lable>
                <input type="text" placeholder="Enter Username" name="Username" id="username" required>
            </div>

            <div>
                <lable for="pwd">password:</lable>
                <div class="password-input-container">
                    <input type="password" placeholder="Enter your password" id="pwd" name='Password' required>
                    <div class="show-password-container">
                        <input type="checkbox" onclick="myFunction('pwd')" id="show-password-checkbox">
                        <label for="show-password-checkbox"><i class="fas fa-eye"></i></label>
                    </div>
                </div>
            </div>

            <div>
                <input type="submit" value="Sign-in" name="submit">
            </div>
            <div class="signup_link">
                Don't Have an Account?<a href="signUp.php"> Sign up and become a member</a>
            </div>
        </form>
    </div>


</body>

</html>