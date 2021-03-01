<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>
<?php session_start() ?>

<?php
    if($_SESSION['loggedIn'] != true){
        header('Location: login.php');
        exit;
    }
?>

<body>
    <?php require_once '../public/includes/_header.php'; ?>
    <h1>Manage Posts</h1>
    <a href="addPost.php">Add Post</a>
    <a href="logout.php">Log Out</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Action</th>
        </tr>
        <?php

            $query = 'SELECT * FROM posts';
            
            $result = mysqli_query($connection, $query);
        
            if (!$result) {
                die('Database query failed.');
            }

            while ($post = mysqli_fetch_assoc($result)) {
            
                echo '<tr>';
                echo '<td>'.$post['Title'].'</td>';
                echo '<td>';
                echo '<a href="editPost.php?id=';
                echo urlencode($post['ID']);
                echo '">Edit</a>';
                echo '<a href="deletePost.php?id=';
                echo urlencode($post['ID']);
                echo '">Delete</a>';
                echo '</tr>';
            }
        ?>
    </table>
</body>