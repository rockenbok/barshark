<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/
require_once("class.phpmailer.php");
require_once("formvalidator.php");

class FGMembersite
{
    var $admin_email;
    var $from_address;

    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    
    var $error_message;
    
    //-----Initialization -------
    function FGMembersite()
    {
        $this->sitename = 'thebarshark.com';
        $this->rand_key = 'qSRcVS6DrTzrPvr';
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }
    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    function RegisterUser()
    {
        if(!isset($_POST['submittedRegister']))
        {
           return false;
        }
        
        $formvars = array();
        
        if(!$this->ValidateRegistrationSubmission())
        {
            return false;
        }
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
        
        if(!$this->SendUserConfirmationEmail($formvars))
        {
            return false;
        }

        $this->SendAdminIntimationEmail($formvars);
        
        return true;
    }

    function ConfirmUser()
    {
        if(empty($_GET['code'])||strlen($_GET['code'])<=10)
        {
            $this->HandleError("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec))
        {
            return false;
        }
        
        $this->SendUserWelcomeEmail($user_rec);
        
        $this->SendAdminIntimationOnRegComplete($user_rec);
        
        return true;
    }    
    
    function Login()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        
        if(empty($_POST['password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $loginCheck = $_POST['loginCheck'];
        
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($email,$password))
        {
            return false;
        }

        $sessionvar = $this->GetLoginSessionVar();

        if($loginCheck == "value1")
        {
            setcookie('barshark_session_cookie', $sessionvar, time() + 172800, '/'); // 172800 = 2 days
            setcookie('barshark_email_cookie', $email, time() + 172800, '/'); // 172800 = 2 days
        }
        else
        {
            setcookie('barshark_email_cookie', $email, time() + 172800, '/'); // 172800 = 2 days
            $_SESSION[$sessionvar] = $email;
        }

        return true;

    }
    
    function CheckLogin()
    {
        if(isset($_COOKIE['barshark_session_cookie'])&&isset($_COOKIE['barshark_email_cookie']))
        {
            if(!$this->DBLogin())
            {
                $this->HandleError("Database login failed!");
                return false;
            }          
            $email = $_COOKIE['barshark_email_cookie'];
            $qry = "Select * from $this->tablename where email='$email'";
            
            $result = mysql_query($qry,$this->connection);
            
            if(!$result || mysql_num_rows($result) <= 0)
            {
                $this->HandleError("Error logging in.");
                return false;
            }
            
            $row = mysql_fetch_assoc($result);
            
            
            $_SESSION['name_of_user']  = $row['firstName'];
            $_SESSION['last_name_of_user']  = $row['lastName'];
            $_SESSION['pass_of_user'] = $row['password'];
            $_SESSION['email_of_user'] = $row['email'];
            $_SESSION['gender_of_user'] = $row['gender'];
            $_SESSION['year_of_user'] = $row['birthYear'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['default_city'] = $row['defaultcity'];
            $_SESSION['default_district'] = $row['defaultdistrict'];

            return true; 
        }
        else
        {
            if(!isset($_SESSION)){ session_start(); }

            $sessionvar = $this->GetLoginSessionVar();

            if(empty($_SESSION[$sessionvar]))
            {
                return false;
            }

            return true;
        }
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }

    function UserLastName()
    {
        return isset($_SESSION['last_name_of_user'])?$_SESSION['last_name_of_user']:'';
    }

    function UserPassword()
    {
        return isset($_SESSION['pass_of_user'])?$_SESSION['pass_of_user']:'';
    }
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }

    function UserGender()
    {
        return isset($_SESSION['gender_of_user'])?$_SESSION['gender_of_user']:'';
    }

    function UserYear()
    {
        return isset($_SESSION['year_of_user'])?$_SESSION['year_of_user']:'';
    }

    function UserCity()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $_COOKIE['barshark_email_cookie'];
        $qry = "Select * from $this->tablename where email='$email'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in.");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);

        $_SESSION['default_city'] = $row['defaultcity'];
        $defaultcity = $_SESSION['default_city'];
        return $defaultcity;
    }

    function UserDistrict()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $_COOKIE['barshark_email_cookie'];
        $qry = "Select * from $this->tablename where email='$email'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in.");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);

        $_SESSION['default_district'] = $row['defaultdistrict'];

        if($_SESSION['default_district']==NULL)
        {
            $defaultdistrict = '';
        }
        else
        {
            $defaultdistrict = ' - ' . $_SESSION['default_district'];
        }
        
        return $defaultdistrict;
    }

    function UserStyle()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $_COOKIE['barshark_email_cookie'];
        $qry = "Select * from $this->tablename where email='$email'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in.");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);

        $_SESSION['default_style'] = $row['defaultstyle'];

        if($_SESSION['default_style']==NULL)
        {
            $defaultstyle = '';
        }
        else
        {
            $defaultstyle = ' - ' . $_SESSION['default_style'];
        }
        
        return $defaultstyle;
    }

    function UserPic()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }

        $email = $_COOKIE['barshark_email_cookie'];

        $select_image="select * from barsharkusers where email='$email'";

        $var=mysql_query($select_image);

        if($row=mysql_fetch_array($var))
        {
            $image_name=$row["imagename"];
            $image_content=$row["imagecontent"];
        }

        return $image_content;
    }
    
    function LogOut()
    {
        if(isset($_COOKIE['barshark_session_cookie'])&&isset($_COOKIE['barshark_email_cookie']))
        {
            setcookie('barshark_session_cookie', '', time() - 172800, '/');
            setcookie('barshark_email_cookie', '', time() - 172800, '/');
        }
        else
        {
            session_start();
            
            $sessionvar = $this->GetLoginSessionVar();
        
            $_SESSION[$sessionvar]=NULL;
        
            unset($_SESSION[$sessionvar]);
        }
    }
    
    function EmailResetPasswordLink()
    {
        if(empty($_POST['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        $user_rec = array();
        if(false === $this->GetUserFromEmail($_POST['email'], $user_rec))
        {
            return false;
        }
        if(false === $this->SendResetPasswordLink($user_rec))
        {
            return false;
        }
        return true;
    }
    
    function ResetPassword()
    {
        if(empty($_GET['email']))
        {
            $this->HandleError("Email is empty!");
            return false;
        }
        if(empty($_GET['code']))
        {
            $this->HandleError("reset code is empty!");
            return false;
        }
        $email = trim($_GET['email']);
        $code = trim($_GET['code']);
        
        if($this->GetResetPasswordCode($email) != $code)
        {
            $this->HandleError("Bad reset code!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($email,$user_rec))
        {
            return false;
        }
        
        $new_password = $this->ResetUserPasswordInDB($user_rec);
        if(false === $new_password || empty($new_password))
        {
            $this->HandleError("Error updating new password");
            return false;
        }
        
        if(false == $this->SendNewPassword($user_rec,$new_password))
        {
            $this->HandleError("Error sending new password");
            return false;
        }
        return true;
    }
    
    function UpdateAccount()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['newEmail']))
        {
            $this->HandleError("Email field is empty!");
            return false;
        }

        if(empty($_POST['newPassword']))
        {
            $this->HandleError("Password field is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $newemail = trim($_POST['newEmail']);
        $newpwd = trim($_POST['newPassword']);
        
        if(!$this->ChangeAccountInDB($user_rec, $newemail, $newpwd))
        {
            return false;
        }

        if(false == $this->SendUpdatedAccount($user_rec, $newemail, $newpwd))
        {
            return false;
        }

        return true;
    }

    function UpdateProfile()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }
        
        if(empty($_POST['newfirstName']))
        {
            $this->HandleError("First Name field is empty!");
            return false;
        }

        if(empty($_POST['newlastName']))
        {
            $this->HandleError("Last Name field is empty!");
            return false;
        }

        if(empty($_POST['newgender']))
        {
            $this->HandleError("Gender field is empty!");
            return false;
        }

        if(empty($_POST['newbirthYear']))
        {
            $this->HandleError("Birth Year field is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $newfirst = trim($_POST['newfirstName']);
        $newlast = trim($_POST['newlastName']);
        $newgender = trim($_POST['newgender']);
        $newyear = trim($_POST['newbirthYear']);
        
        if(!$this->ChangeProfileInDB($user_rec, $newfirst, $newlast, $newgender, $newyear))
        {
            return false;
        }

        if(false == $this->SendUpdatedProfile($user_rec, $newfirst, $newlast, $newgender, $newyear))
        {
            return false;
        }
        
        return true;
    }

    function UploadPic()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }

        $file = $_FILES['profilepic']['tmp_name'];
        if(!isset($file))
        {   
            echo "no image";
            return false;
        }
        else
        {   

            //Get the content of the image and then add slashes to it 
            $imagetmp=addslashes (file_get_contents($_FILES['profilepic']['tmp_name']));    
            $image_name = addslashes($_FILES['profilepic']['name']);
            $image_size = getimagesize($_FILES['profilepic']['tmp_name']);

            if($image_size==FALSE)
            {
                echo "not an image";
                return false;
            }

            $email = $_COOKIE['barshark_email_cookie'];

            $imagename=$_FILES["profilepic"]["name"]; 

            //Insert the image name and image content in image_table
            $insert_image="Update $this->tablename Set imagename='$imagename' and imagecontent='$imagetmp' Where email='$email'";

            mysql_query($insert_image, $this->connection);

            return true;
        }
    }

    function DeleteAccount()
    {
        if(!$this->CheckLogin())
        {
            $this->HandleError("Not logged in!");
            return false;
        }

        if(empty($_POST['delPassword']))
        {
            $this->HandleError("Password field is empty!");
            return false;
        }
        
        $user_rec = array();
        if(!$this->GetUserFromEmail($this->UserEmail(),$user_rec))
        {
            return false;
        }
        
        $delpwd = trim($_POST['delPassword']);
        
        if(!$this->DeleteAccountInDB($user_rec, $delpwd))
        {
            return false;
        }

        if(false == $this->SendDeletedAccount($user_rec))
        {
            return false;
        }

        return true;
    }

    function Locations()
    {   
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $_COOKIE['barshark_email_cookie'];
        $qry = "Select * from $this->tablename where email='$email'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in.");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);

        $_SESSION['default_city'] = $row['defaultcity'];
        $_SESSION['default_district'] = $row['defaultdistrict'];
        $_SESSION['default_stlye'] = $row['defaultstyle'];

        if($_SESSION['default_city']==NULL)
        {
            echo "0 Results";
        }
        else
        {
            $defaultcity = $_SESSION['default_city'];

            if($_SESSION['default_district']==NULL)
            {
                if($_SESSION['default_style']==NULL)
                {
                    //query for city only;
                    $qry = "Select * From locations where city='$defaultcity' and featured='y'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li class="featured">'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/black/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }

                    $qry = "Select * From locations where city='$defaultcity' and featured='n'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/teal/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }
                }
                else
                {
                    $defaultstyle = $_SESSION['default_style'];

                    //query for city and style;
                    $qry = "Select * From locations where city='$defaultcity' and style='$defaultstyle' and featured='y'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li class="featured">'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/black/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }

                    $qry = "Select * From locations where city='$defaultcity' and style='$defaultstyle' and featured='n'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/teal/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }
                }
            }
            else
            {
                if($_SESSION['default_style']==NULL)
                {
                    $defaultdistrict = $_SESSION['default_district'];

                    //query for city and district;
                    $qry = "Select * From locations where city='$defaultcity' and district='$defaultdistrict' and featured='y'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li class="featured">'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/black/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }

                    $qry = "Select * From locations where city='$defaultcity' and district='$defaultdistrict' and featured='n'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/teal/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }
                }
                else
                {
                    $defaultdistrict = $_SESSION['default_district'];
                    $defaultstyle = $_SESSION['default_style'];

                    //query for city district and style;
                    $qry = "Select * From locations where city='$defaultcity' and district='$defaultdistrict' and style='$defaultstyle' and featured='y'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li class="featured">'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/black/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }

                    $qry = "Select * From locations where city='$defaultcity' and district='$defaultdistrict' and style='$defaultstyle' and featured='n'";
                    $result = mysql_query($qry,$this->connection);

                    if (!$result || mysql_num_rows($result) <= 0) {
                        echo " ";
                    } 
                    else 
                    {
                        // output data of each row
                        while($row = mysql_fetch_assoc($result)) {
                            echo '<li>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">'
                            ,    '<div class="feat_small_icon"><img src="images/icons/indicators/' . $row["volume"] . '.svg" alt="" title="" /></div>'
                            ,    '<div class="feat_small_details">'
                            ,    '<h4>' . $row["name"] . '</h4>'
                            ,    '<a href="focus.php?search=' . $row["id"] . '">' . $row["pitch"] . '</a>'
                            ,    '</div>'
                            ,    '<span class="plus_icon"><img src="images/icons/teal/plus.png" alt="" title="" /></span>'
                            ,    '</a>'
                            ,    '</li>'
                            ;
                        }
                    }
                }
            }
        }
    }

    function focus($res)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   

        $id = $res;
        $qry = "Select * from locations where id='$id'";

        $result = mysql_query($qry,$this->connection);

        if (!$result || mysql_num_rows($result) <= 0) {
            echo "Could not retrieve information. Please try again.";
        } 
        else 
        {
            $row = mysql_fetch_assoc($result);

            echo '<h2 class="page_title">' . $row["name"] . '</h2>'
            ,    '<div class="page_content">'
            ,    '<div class="contact_info">'
            ,    'Hours: <span>' . $row["hours"] . '</span> <br />'
            ,    'Phone: ' . $row["phone"] . ' <br />'
            ,    'Menu: <a href="' . $row["menu"] . '" class="external" target="_blank">OPEN</a>'
            ,    '</div>'
            ,    '<h3>Our Location</h3>'
            ,    '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3596.6251316836215!2d-80.34114568504981!3d25.65056428368738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9c6ecbeb5721f%3A0x669152096eaa540e!2s8926+SW+129th+St%2C+Miami%2C+FL+33176!5e0!3m2!1sen!2sus!4v1452033011970" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>'
            ,    '<div class="clear"></div>'
            ,    '</div>'
            ;
        }    
    }

    function City()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }  

        $qry = "Select distinct city from locations";
        $result = mysql_query($qry,$this->connection);

        if (!$result || mysql_num_rows($result) <= 0) {
          echo "0 Results";
        } 
        else 
        {
          // output data of each row
          while($row = mysql_fetch_assoc($result)) {
              echo '<label>'
              ,    '<input type="radio" data-popup=".popup-district" class="close-panel open-popup" id="' . $row["city"] . '" name="city" value="' . $row["city"] . '" onclick="getDistrict(this.value);">'
              ,    '<div id="' . $row["city"] . '" class="location-image"></div>'
              ,    '<div class="location-name"><h3>' . $row["city"] . '</h3></div>'
              ,    '</label>'
              ;
          }
        }
    }

    /*
    function DistrictMiami()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }  

        $city = "Miami";
        $qry = "Select distinct district from locations where city='$city'";
        $result = mysql_query($qry,$this->connection);

        if (!$result || mysql_num_rows($result) <= 0) {
          echo "0 Results";
        } 
        else 
        {
          // output data of each row
          while($row = mysql_fetch_assoc($result)) {
              echo '<label>'
              ,    '<input type="radio" data-popup=".popup-style" class="close-panel open-popup" id="' . $row["district"] . '" name="district" value="' . $row["district"] . '">'
              ,    '<div class="location-district"><h3>' . $row["district"] . '</h3></div>'
              ,    '</label>'
              ;
          }
        }
    }
    */

    function Style()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }  

        $qry = "Select distinct style from locations";
        $result = mysql_query($qry,$this->connection);

        if (!$result || mysql_num_rows($result) <= 0) {
          echo "0 Results";
        } 
        else 
        {
          // output data of each row
          while($row = mysql_fetch_assoc($result)) {
              echo '<label>'
              ,    '<input type="radio" id="' . $row["style"] . '" name="style" value="' . $row["style"] . '">'
              ,    '<div class="location-district"><h3>' . $row["style"] . '</h3></div>'
              ,    '</label>'
              ;
          }
        }
    }

    function SaveLocation()
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $_COOKIE['barshark_email_cookie'];
        $city = trim($_POST['city']);
        $district = trim($_POST['district']);
        $style = trim($_POST['style']);
        
        $qry = "Update $this->tablename Set defaultcity='$city', defaultdistrict='$district', defaultstyle='$style' where email='$email'";
        
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error finding locations");
            return false;
        }     
        return true;    
    }

    //-------Public Helper functions -------------
    function GetSelfScript()
    {
        return htmlentities($_SERVER['PHP_SELF']);
    }    
    
    function SafeDisplay($value_name)
    {
        if(empty($_POST[$value_name]))
        {
            return'';
        }
        return htmlentities($_POST[$value_name]);
    }
    
    function RedirectToURL($url)
    {
        header("Location: $url");
        exit;
    }
    
    function GetSpamTrapInputName()
    {
        return 'sp'.md5('KHGdnbvsgst'.$this->rand_key);
    }
    
    function GetErrorMessage()
    {
        if(empty($this->error_message))
        {
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    function GetFromAddress()
    {
        if(!empty($this->from_address))
        {
            return $this->from_address;
        }

        $host = $_SERVER['mysql.thebarshark.com'];

        $from ="thebarsharkcom@$host";
        return $from;
    } 
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($email,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $email = $this->SanitizeForSQL($email);
        $password = $this->SanitizeForSQL($password);
        $qry = "Select * from $this->tablename where email='$email' and password='$password' and confirmcode='y'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The email or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['firstName'];
        $_SESSION['last_name_of_user']  = $row['lastName'];
        $_SESSION['pass_of_user'] = $row['password'];
        $_SESSION['email_of_user'] = $row['email'];
        $_SESSION['gender_of_user'] = $row['gender'];
        $_SESSION['year_of_user'] = $row['birthYear'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['default_city'] = $row['defaultcity'];
        $_SESSION['default_district'] = $row['defaultdistrict'];
        

        return true;
    }
    
    function UpdateDBRecForConfirmation(&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $result = mysql_query("Select * from $this->tablename where confirmcode='$confirmcode'",$this->connection);   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Wrong confirm code.");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $user_rec['firstName'] = $row['firstName'];
        $user_rec['lastName'] = $row['lastName'];
        $user_rec['email']= $row['email'];
        
        $qry = "Update $this->tablename Set confirmcode='y' Where  confirmcode='$confirmcode'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }
    
    function ResetUserPasswordInDB($user_rec)
    {
        $new_password = substr(md5(uniqid()),0,10);
        
        if(false == $this->ChangePasswordInDB($user_rec,$new_password))
        {
            return false;
        }
        return $new_password;
    }

    function ChangePasswordInDB($user_rec, $new_password)
    {
        $newpwd = $this->SanitizeForSQL($new_password);
        $email = $user_rec['email'];
        
        $qry = "Update $this->tablename Set password='$newpwd' Where  email='$email'";
        
        if(!mysql_query( $qry ,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function ChangeAccountInDB($user_rec, $newemail, $newpwd)
    {
        $new_password = $this->SanitizeForSQL($newpwd);
        $new_email = $this->SanitizeForSQL($newemail);
        $email = $user_rec['email'];
        
        $qry = "Update $this->tablename Set password='$new_password', email='$new_email' where email='$email'";
        
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }

    function DeleteAccountInDB($user_rec, $delpwd)
    {
        $email = $user_rec['email'];

        if($delpwd != $user_rec['password'])
        {
            $this->HandleDBError("Password does not match!");
            return false;
        }
        
        $qry = "Delete From $this->tablename where email='$email'";
        
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }

    function ChangeProfileInDB($user_rec, $newfirst, $newlast, $newgender, $newyear)
    {
        $new_first = $this->SanitizeForSQL($newfirst);
        $new_last = $this->SanitizeForSQL($newlast);
        $new_gen = $this->SanitizeForSQL($newgender);
        $new_year = $this->SanitizeForSQL($newyear);
        $email = $user_rec['email'];
        
        $qry = "Update $this->tablename Set firstName='$new_first', lastName='$new_last', gender='$new_gen', birthYear='$new_year' where email='$email'";
        
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error updating the password \nquery:$qry");
            return false;
        }     
        return true;
    }
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }
    
    function SendUserWelcomeEmail(&$user_rec)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($user_rec['email'],$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Welcome to Barshark!";

        $mailer->From = "Barshark";        
        
        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "Welcome! Your registration with Barshark is completed.\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending user welcome email.");
            return false;
        }
        return true;
    }
    
    function SendAdminIntimationOnRegComplete(&$user_rec)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "Registration Completed: ".$user_rec['firstName']." ".$user_rec['lastName'];

        $mailer->From = "Barshark";         
        
        $mailer->Body ="A new user completed with Barshark"."\r\n".
        "Name: ".$user_rec['firstName']." ".$user_rec['lastName']."\r\n".
        "Email address: ".$user_rec['email']."\r\n";
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function GetResetPasswordCode($email)
    {
       return substr(md5($email.$this->sitename.$this->rand_key),0,10);
    }
    
    function SendResetPasswordLink($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Your reset password request with Barshark";

        $mailer->From = "Barshark";
        
        $link = $this->GetAbsoluteURLFolder().
                '/resetpwd.php?email='.
                urlencode($email).'&code='.
                urlencode($this->GetResetPasswordCode($email));

        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "There was a request to reset your password at Barshark \r\n".
        "Please click the link below to complete the request: \r\n".$link."\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SendNewPassword($user_rec, $new_password)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Your new password for Barshark";

        $mailer->From = "Barshark";
        
        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "Your password is reset successfully. ".
        "Here is your updated login:\r\n".
        "email: ".$user_rec['email']."\r\n".
        "password: $new_password\r\n".
        "\r\n".
        "Login here: http://thebarshark.com/Barshark-App/www/\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

    function SendUpdatedAccount($user_rec, $newemail, $newpwd)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['firstName'],$user_rec['lastName']);

        $mailer->AddAddress($newemail,$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Your Updated Account for Barshark";

        $mailer->From = "Barshark";
        
        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "Your profile with Barshark has recently been updated. ".
        "Here is your updated account information:\r\n".
        "Name: ".$user_rec['firstName']." ".$user_rec['lastName']."\r\n".
        "eMail: ".$newemail."\r\n".
        "Password: ".$newpwd."\r\n".
        "Gender: ".$user_rec['gender']."\r\n".
        "Birth Year: ".$user_rec['birthYear']."\r\n".
        "\r\n".
        "Login here: http://thebarshark.com/Barshark-App/www/\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }

    function SendDeletedAccount($user_rec)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Your Account for Barshark has been Deleted";

        $mailer->From = "Barshark";
        
        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "Your profile with Barshark has been deleted. \r\n".
        "We hope you consider joining us again soon. \r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }    

    function SendUpdatedProfile($user_rec, $newfirst, $newlast, $newgender, $newyear)
    {
        $email = $user_rec['email'];
        
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($email,$user_rec['firstName'],$user_rec['lastName']);
        
        $mailer->Subject = "Your Updated Account for Barshark";

        $mailer->From = "Barshark";
        
        $mailer->Body ="Hello ".$user_rec['firstName']."\r\n\r\n".
        "Your profile with Barshark has recently been updated. ".
        "Here is your updated account information:\r\n".
        "Name: ".$newfirst." ".$newlast."\r\n".
        "eMail: ".$user_rec['email']."\r\n".
        "Password: ".$user_rec['password']."\r\n".
        "Gender: ".$newgender."\r\n".
        "Birth Year: ".$newyear."\r\n".
        "\r\n".
        "Login here: http://thebarshark.com/Barshark-App/www/\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }   
    
    function ValidateRegistrationSubmission()
    {
        $validator = new FormValidator();
        $validator->addValidation("firstName","req","Please fill in your first name");
        $validator->addValidation("lastName","req","Please fill in your last name");
        $validator->addValidation("email","email","The input for Email should be a valid email value");
        $validator->addValidation("email","req","Please fill in Email");
        $validator->addValidation("gender","req","Please fill in gender");
        $validator->addValidation("birthYear","req","Please fill in birth year");
        $validator->addValidation("password","req","Please fill in Password");

        
        if(!$validator->ValidateForm())
        {
            $error='';
            $error_hash = $validator->GetErrors();
            foreach($error_hash as $inpname => $inp_err)
            {
                $error .= $inpname.':'.$inp_err."\n";
            }
            $this->HandleError($error);
            return false;
        }        
        return true;
    }
    
    function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['firstName'] = $this->Sanitize($_POST['firstName']);
        $formvars['lastName'] = $this->Sanitize($_POST['lastName']);
        $formvars['email'] = $this->Sanitize($_POST['email']);
        $formvars['gender'] = $this->Sanitize($_POST['gender']);
        $formvars['birthYear'] = $this->Sanitize($_POST['birthYear']);
        $formvars['password'] = $this->Sanitize($_POST['password']);
    }
    
    function SendUserConfirmationEmail(&$formvars)
    {
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['firstName'],$formvars['lastName']);
        
        $mailer->Subject = "Your registration with Barshark";

        $mailer->From = "Barshark";        
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->GetAbsoluteURLFolder().'/confirmreg.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['firstName']."\r\n\r\n".
        "Thanks for your registration with Barshark \r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "The Barshark Team\r\n".
        $this->sitename;

        if(!$mailer->Send())
        {
            $this->HandleError("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }

    function GetAbsoluteURLFolder()
    {
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $scriptFolder .= $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);
        return $scriptFolder;
    }
    
    function SendAdminIntimationEmail(&$formvars)
    {
        if(empty($this->admin_email))
        {
            return false;
        }
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($this->admin_email);
        
        $mailer->Subject = "New registration: ".$formvars['firstName']." ".$formvars['lastName'];

        $mailer->From = "Barshark";         
        
        $mailer->Body ="A new user registered with Barshark \r\n".
        "Name: ".$formvars['firstName']." ".$formvars['lastName']."\r\n".
        "Email address: ".$formvars['email'];
        
        if(!$mailer->Send())
        {
            return false;
        }
        return true;
    }
    
    function SaveToDatabase(&$formvars)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }
        if(!$this->Ensuretable())
        {
            return false;
        }
        if(!$this->IsFieldUnique($formvars,'email'))
        {
            $this->HandleError("This email is already registered");
            return false;
        }
        
        if(!$this->IsFieldUnique($formvars,'username'))
        {
            $this->HandleError("This UserName is already used. Please try another username");
            return false;
        }        
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
    
    function IsFieldUnique($formvars,$fieldname)
    {
        $field_val = $this->SanitizeForSQL($formvars[$fieldname]);
        $qry = "select email from $this->tablename where $fieldname='".$field_val."'";
        $result = mysql_query($qry,$this->connection);   
        if($result && mysql_num_rows($result) > 0)
        {
            return false;
        }
        return true;
    }
    
    function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    function Ensuretable()
    {
        $result = mysql_query("SHOW COLUMNS FROM $this->tablename");   
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return $this->CreateTable();
        }
        return true;
    }
    
    function CreateTable()
    {
        $qry = "Create Table $this->tablename (".
                "id_user INT NOT NULL AUTO_INCREMENT ,".
                "name VARCHAR( 128 ) NOT NULL ,".
                "email VARCHAR( 64 ) NOT NULL ,".
                "phone_number VARCHAR( 16 ) NOT NULL ,".
                "username VARCHAR( 16 ) NOT NULL ,".
                "password VARCHAR( 32 ) NOT NULL ,".
                "confirmcode VARCHAR(32) ,".
                "PRIMARY KEY ( id_user )".
                ")";
                
        if(!mysql_query($qry,$this->connection))
        {
            $this->HandleDBError("Error creating the table \nquery was\n $qry");
            return false;
        }
        return true;
    }
    
    function InsertIntoDB(&$formvars)
    {
    
        $confirmcode = $this->MakeConfirmationMd5($formvars['email']);
        
        $formvars['confirmcode'] = $confirmcode;
        
        $insert_query = 'insert into '.$this->tablename.'(
                firstName,
                lastName,
                email,
                password,
                gender,
                birthYear,
                confirmcode
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['firstName']) . '",
                "' . $this->SanitizeForSQL($formvars['lastName']) . '",
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['password']) . '",
                "' . $this->SanitizeForSQL($formvars['gender']) . '",
                "' . $this->SanitizeForSQL($formvars['birthYear']) . '",
                "' . $confirmcode . '"
                )';      
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        return true;
    }
    function MakeConfirmationMd5($email)
    {
        $randno1 = rand();
        $randno2 = rand();
        return md5($email.$this->rand_key.$randno1.''.$randno2);
    }
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
}
?>