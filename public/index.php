<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>

<body>
    <?php require_once 'includes/_header.php'; ?>

    <main>
        <h1>Hi, I'm Quinn</h1>
        <p>I'm an aspiring web developer who happened to find photography as a side hobby. If you want to view my Web Development and UI/UX portfolio, <a href="#">please visit this site</a></p>

        <?php 
            $query = 'SELECT * FROM posts';
            
            $result = mysqli_query($connection, $query);
            
            if (!$result) {
              die('Database query failed.');
            }

            while ($post = mysqli_fetch_assoc($result)) {
                echo '<a href="post.php?id=';
                echo urlencode($post['ID']);
                echo '">';
                echo '<figure>';
                echo '<img src="';
                echo $post['CoverImagePath'];
                echo '" alt="Cover Image">';
                echo '<figcaption>';
                echo $post['Title'];
                echo '</figcaption>';
                echo '</figure>';
                echo '</a>';
              }
        ?>

    </main>

    <?php require_once "includes/_footer.php"; ?>
</body>
</html>