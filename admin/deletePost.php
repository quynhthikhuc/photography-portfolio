<?php require_once '../include/initialize.php'; ?>

<?php
    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    $query = "DELETE FROM posts WHERE id = $id";
    
    $result = mysqli_query($connection, $query);
    
    header('Location: admin.php');
    
?>