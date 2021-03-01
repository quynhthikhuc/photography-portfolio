<?php require_once '../include/initialize.php'; ?>

<?php
        $id = isset($_GET["id"]) ? $_GET["id"] : null;
        
        if (!$id) {
            redirect_to("index.php");
        } else {
            $query = 'SELECT * ';
            $query .= 'FROM posts ';
            $query .= "WHERE ID = '{$id}' ";
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
        require_once 'includes/_header.php'; 
        while($post = mysqli_fetch_assoc($result)){
    ?>

    <main>
        <h1>
            <?php echo $post['Title']; ?>
        </h1>
        <div>
            <?php echo $post['PostContent']; ?>
        </div>
    </main>

    <?php 
    }
    ?>

    <?php require_once "includes/_footer.php"; ?>
</body>