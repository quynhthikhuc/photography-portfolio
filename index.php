<?php require_once 'include/initialize.php'; ?>
<?php require_once 'include/head.php'; ?>

<body>
    <?php include_once 'include/_header.php'; ?>
    <main id="home-main">
        <h1>Hi, I'm <b id="fname">Quinn</b></h1>
        <p id="introduction">I'm an aspiring web developer who happened to find photography as a side hobby. If you want to view my Web Development and UI/UX portfolio, <a id="back-to-main" href="http://quynhthikhuc.com/" target="_blank">please visit this site.</a></p>
        <div id="work">
        <?php 
            $query = 'SELECT * FROM posts';
            
            $result = mysqli_query($connection, $query);
            
            if (!$result) {
              die('Database query failed.');
            }

            while ($post = mysqli_fetch_assoc($result)) {
                echo '<a href="post.php?id=';
                echo urlencode($post['id']);
                echo '">';
                echo '<div class="work" id="';
                echo $post['id'];
                echo '">';
                echo $post['metadata'];
                echo '</div>';
                echo '</a>';
              }
        ?>
        </div>
    </main>

    <?php require_once "include/_footer.php"; ?>
</body>
</html>