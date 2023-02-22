<?php

session_start();
include('DataBase_Connection.php');

$stmt = $connection->Prepare("SELECT * FROM `question`");
// $stmt->bind_param("s", $Email_id);
$stmt->execute();
$stmt_result = $stmt->get_result();

// $stmt_result->num_rows?

$marks=0;


for($i=1;$i<=$stmt_result->num_rows;$i++){
    
    if (isset($_POST['option'.$i])) {
        $result = $_POST['option'.$i];
        echo $result;
        // $marks = $marks+$result;
    }
}
echo $marks;
?>