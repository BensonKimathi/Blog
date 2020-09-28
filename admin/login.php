<?php include '../lib/Session.php'; 
Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

<?php
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<!-- form -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $fm->validation($_POST['username']);
            $password = $fm->validation(md5($_POST['password']));

            $username = mysqli_real_escape_string($db->link, $username);
            $password = mysqli_real_escape_string($db->link, $password);

            $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password' ";
            $result = $db->select($query);
            if ($result != false) {                    
               // $value = mysqli_fetch_array($result);
                    $value =$result->fetch_assoc();
                    Session::set("login", true);
                    Session::set("username", $value['username']);   
                    Session::set("userId", $value['id']);
                    Session::set("userRole", $value['role']);
                    header("Location:index.php");                     
            } else {
                echo "<span style='color: red; font-size: 18px'>Username and Password do not match</span>";
            }

        }
    ?>
        <form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
        <div class="button">
            <a href="forgotpass.php">Forgot Password</a>
        </div>
		<div class="button">
        <?php 
            $squery = "SELECT * FROM tbl_social WHERE id='1' ";
            $socialmedia = $db->select($squery);
            if ($socialmedia) {
                while ($sresult = $socialmedia->fetch_assoc()) {
        ?>
    
        <?php 
            $query = "SELECT * FROM tbl_title_slogan_logo WHERE id='1' ";
            $blog_title = $db->select($query);
            if ($blog_title) {
                while ($result = $blog_title->fetch_assoc()) {
        ?>
			<a href="<?php echo $sresult['website']; ?>"><?php echo $result['title']; ?></a>
        <?php } } ?>
        <?php } } ?>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>