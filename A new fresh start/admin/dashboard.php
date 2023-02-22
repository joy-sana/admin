<?php
session_start();
if ( !isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: signin_admin.php");
    exit;
}

$fullname = $_SESSION['admin_name'];
?>

<html>
    <head>

    </head>
<body>
    <div class="container">
        <div class="logout">
        <a href="logout_admin.php">
                <button class="btn-log" type="submit">logout</button>
            </a>
        </div>
        <div class="box">
            <b>student info</b>
            <p></p>
        </div>

        <div class="box">
            <b>User management</b>
        </div>

        <div class="box">
            <b>Exam Management</b>
        </div>
    </div>
</body>
</html>

Overview: The dashboard should provide a quick overview of the key metrics and important information about the online exam system, such as the number of exams taken, average scores, and exam completion rates.

Exam management: The dashboard should allow the admin to manage the exams, including creating new exams, editing existing ones, and scheduling exam dates.

User management: The admin should be able to manage the users who have access to the online exam system. This includes creating and editing user accounts, assigning roles and permissions, and tracking user activity.

Exam analytics: The dashboard should include analytics and reporting features that allow the admin to track and analyze exam results, including performance trends, question analysis, and candidate feedback.

System configuration: The dashboard should provide options for configuring the online exam system, such as customizing the branding, setting up email notifications, and configuring security settings.

Support and help: The dashboard should include resources for providing support and help to users of the online exam system, such as FAQs, help documentation, and customer support contact information.