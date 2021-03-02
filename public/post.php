<?php require_once '../include/initialize.php'; ?>

<?php
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        
        if (!$id) {
            redirect_to("index.php");
        } else {
            $query = 'SELECT * ';
            $query .= 'FROM posts ';
            $query .= "WHERE id = '{$id}' ";
            $query .= 'LIMIT 1';

            $result = mysqli_query($connection, $query);

            if (!$result) {
                die('Database query failed.');
            }
        }

?>

<?php require_once '../include/head.php'; ?>

<body class="single-post">
    <?php 
        include_once 'includes/_header.php'; 
        while($post = mysqli_fetch_assoc($result)){
    ?>

    <main>
        <h1>
            <?php echo $post['title']; ?>
        </h1>
        <div>
            <?php echo $post['content']; ?>
        </div>
    </main>

    <?php 
    }
    ?>

    <?php include_once "includes/_footer.php"; ?>
</body>