<?php
$login = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('C:\xamppnew\htdocs\A new fresh start\DataBase_Connection.php');

    $admin_id = $_POST['admin_id'];
    $password = $_POST['password'];

    $stmt = $connection->Prepare("SELECT * FROM `admin` WHERE admin_id = ?");
    $stmt->bind_param("s", $admin_id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {

        $data = $stmt_result->fetch_assoc();
        if ($data['admin_password'] === $password) {
            $login = true;

            session_start();
            $_SESSION['loggedin'] = $login;
            $_SESSION['admin_name'] = $data['admin_name'];
            $_SESSION['admin_id'] = $admin_id;
            // $_SESSION['name'] = $data['name'];

            if (!headers_sent()) {
                header("location: Dashboard.php");
            }
        } else {
            $showError = "you've Enterd Wrong Password";
        }
    } else {
        $showError = "They're are no ID such as: " . "$admin_id";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <script>
        function myFunction(newid) {
            var x = document.getElementById(newid);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <link rel="stylesheet" href="new2.css">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


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
                <lebel for="administrator_id">Administrator Id:</lebel>
                <input type="text" placeholder="Enter Administrator Id" name="admin_id" id="administrator_id" required>

            </div>

            <div>
                <label for="pwd">Password:</label>
                <div class="password-input-container">
                    <input type="password" placeholder="Enter Password" name="password" id="pwd" required>
                    <div class="show-password-container">
                        <input type="checkbox" onclick="myFunction('pwd')" id="show-password-checkbox">
                        <label for="show-password-checkbox"><i class="fas fa-eye"></i></label>
                    </div>
                </div>
            </div>
            <div>
                <input type="submit" value="Sign-in" name="submit">
            </div>
        </form>
    </div>


</body>

</html>