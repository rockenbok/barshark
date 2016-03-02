<!DOCTYPE html>
<html>
  <head>
    <title>Barshark</title>
    <meta charset="utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/custom.css" />

    <!--== BOOTSTRAP ==-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <div class="background_overlay">
  	<div class="background_overlay_blur">
    <h1>&nbsp;</h1>
    <div class="header">
      <div class="logo">
        <div align="center"><img src="img/White-Logo.png" width="50%"></div>
      </div>
    </div>
    <div id="welcome">
      <h1 style="font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; text-align: center;">
        Welcome to Barshark!
      </h1>
      <h2 style="font-family:Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, sans-serif; text-align: center;">
        Before you start your night, please connect to facebook!
      </h2>
    </div>
    <div align="center">
      <input type="button" name="facebook" value="Connect Using facebook">
    </div>
    <h3 style="text-align: center">
      Not Using facebook? 
    </h3>
    <div align="center">
  <input type="button" name="login" value="Click here to sign in!">
            <br/>
            <br/>
            </div>
        </div>
    </div>
  <form action="../profile.php" method="post">
    </form>
      <p>
        <?php
      error_reporting(0);

      if( $_SESSION["logging"]&& $_SESSION["logged"])
      {
        header("Location: http://sulley.cah.ucf.edu/~ma927822/DIG3134/wallscroll/phasethree/profile.php");
      }
      else {
        if(!$_SESSION["logging"])
        {  
          $_SESSION["logging"]=true;
          loginform();
        }
       else if($_SESSION["logging"])
       {
         $number_of_rows=checkpass();
         if($number_of_rows==1)
            { 
              $_SESSION[user]=$_POST[userlogin];
              $_SESSION[logged]=true;
              header("Location: http://sulley.cah.ucf.edu/~ma927822/DIG3134/wallscroll/phasethree/profile.php");
            }
            elseif($_POST["userlogin"] || $_POST["password"] = ""){
                print "wrong username or password, please try again";   
                loginform();
            }
            else{
                print "wrong username or password, please try again"; 
                loginform();
            }
        }
     }
     
   
    function loginform() {
      echo '<table>
            <tr>
              <td>First Name</td>
              <td><input type='text' name='firstName' size'20'></td>
            </tr>
            <br/>
            <br/>
            <tr>
              <td>Password</td>
              <td><input type='password' name='password' size'20'>
            </td>
            </tr>
            </table>
            <br/>
            <input type='submit' value='Log In'>
            <br/>
            <h3><a href='registerform.php'>Register Now!</a></h3>';  
    }

    function checkpass() {

      $servername="mysql.thebarshark.com";
      $username="thebarsharkcom";
      $password="Salty2015!";
      $conn=  mysql_connect($servername,$username,$password)or die(mysql_error());
      mysql_select_db("",$conn);
      $sql="select * from barsharkusers where name='$_POST[firstName]' and password='$_POST[password]'";
      $result=mysql_query($sql,$conn) or die(mysql_error());
      return  mysql_num_rows($result);
    }

    ?></body>
</html>