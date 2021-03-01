<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>

<?php
    if (isset($_POST['submit'])) {
        $ID = $_POST['ID'];
        $Title = $_POST['Title'];
        $CoverImage = $_POST['CoverImage'];
        $PostContent = $_POST['PostContent'];

        $query = "UPDATE posts SET Title = '$Title' WHERE ID = '$ID'";

        $result = mysqli_query($connection, $query);

        header('Location: admin.php');
    }
?>

<body>
    <?php require_once '../public/includes/_header.php'; ?>
    <?php 
        $id = isset($_GET["id"]) ? $_GET["id"] : null;

        $record = mysqli_query($connection, "SELECT * FROM posts WHERE ID=$id");

        if (count($record) == 1 ) {
            $post = mysqli_fetch_array($record);
            $title = $post['Title'];
            $coverImage = $post['CoverImage'];
            $postContent = $post['PostContent'];
        }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="ID" value="<?php echo $id; ?>">
        <div>
          <label for="Title">Post Title</label>
          <input type="text" name="Title" value="<?php echo $title; ?>">
        </div>
        <div>
          <label for="CoverImage">Post Cover Image</label>
          <input type="text" name="CoverImage" value="<?php echo $coverImage; ?>">
        </div>
        <div>
          <label for="PostContent">Post Content</label>
          <input type="text" name="PostContent" value="<?php echo $postContent; ?>">
        </div>
        <button type="submit" name="submit">Update post</button>
      </form>

</body>