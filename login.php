<?php
include("serv/dbconfig.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // username and password sent from Form
    $myusername=addslashes($_POST['username']);
    $mypassword=addslashes($_POST['password']);

	// todo: do some sanitation here to prevent sql injection
	
    $sql="SELECT id FROM users WHERE username='$myusername' and password='$mypassword'";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $active=$row['active'];
    $count=mysql_num_rows($result);


    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count==1)
    {
        session_register("myusername");
        $_SESSION['login_user']=$myusername;

        header("location: index.php");
    }
    else
    {
        $error="Your Login Name or Password is invalid";
    }
}
$page='login';
include_once "header.php";
?>

    <div class="page-header">
      <h1>Welcome to Posty</h1>
    </div>

    <!--div class="login-box">
        <form action="" method="post">
        <input type="text" name="username" placeholder="Username"/>
        <input type="password" name="password" placeholder="Password"/>
        <input type="submit" value=" Submit " class="btn btn-primary" style="position:relative;top:-5px;" />
        </form>
    </div-->

<?php
include_once "footer.php";
?>