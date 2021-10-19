<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', 'root', 'todolist') or die (mysqli_error($mysqli));

$id = 0;
$tasks ="";
$describe ="";
$update =false;

if (isset($_POST['save'])){
    $tasks = $_POST['task'];
    $describe = $_POST['describe'];

    $mysqli->query("INSERT INTO tasks (title, description) VALUES('$tasks', '$describe')") or die($mysqli->error);

    $_SESSION['message'] = "Task successfully added.";
    $_SESSION['msg_type'] = "sucess";

    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    
    $mysqli->query("DELETE FROM tasks WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Task successfully removed.";
    $_SESSION['msg_type'] = "alert";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result =   $mysqli->query("SELECT * FROM tasks WHERE id=$id") or die($mysqli->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $tasks = $row['title'];
        $describe = $row ['description'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $tasks = $_POST['task'];
    $describe = $_POST['describe'];

    $mysqli->query("UPDATE tasks SET title='$tasks', description='$describe' WHERE id=$id") or die($mysqli->error);
    header("location: index.php");
}
?>