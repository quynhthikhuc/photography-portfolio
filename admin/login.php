<?php require_once '../include/initialize.php'; ?>
<?php require_once '../include/head.php'; ?>

<?php session_start(); ?>

<?php
    if($_SESSION['loggedIn'] == true){
        header('Location: admin.php');
        exit;
    }
?>

<body>
    <?php require_once '../public/includes/_header.php'; ?>
    <h1>Login</h1>
    <form method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username"/>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password"/>
        </div>
        <div>  
            <input type="submit" name="submit" value="Login"  />
        </div>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = mysqli_real_escape_string($connection,$_POST['username']);
            $password = mysqli_real_escape_string($connection,$_POST['password']); 
            
            if ($username != "" && $password != ""){

                $sql_query = "select count(*) as count from admin where username='".$username."' and password='".$password."'";
                $result = mysqli_query($connection,$sql_query);
                $row = mysqli_fetch_array($result);
        
                $count = $row['count'];
        
                if($count > 0){
                    $_SESSION['username'] = $username;
                    $_SESSION['loggedIn'] = true;
                    header('Location: admin.php');
                }else{
                    echo "Invalid username and password";
                }
        
            }
         }
    ?>
</body>
</html>