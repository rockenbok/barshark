<?PHP
require_once("include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("thank-you.html");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Contact us</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
<h4>REGISTER</h4>
            <div class="loginform" id='fg_membersite'>
            <form id="RegisterForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/user.png" alt="" title="" /></div>
            <input type='text' name='firstName' class="form_input required" id='firstName' value="" placeholder="first name" /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon" style="visibility: hidden"><img src="images/icons/yellow/user.png" alt="" title="" /></div>
            <input type='text' name='lastName' class="form_input required" id='lastName' value="" placeholder="last name" /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/contact.png" alt="" title="" /></div>
            <input type="text" name="email" id="email" value="" class="form_input required" placeholder="email" />
            <span id='register_email_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/search.png" alt="" title="" /></div>
              <select class="form_input required" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            <span id='register_gender_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/blog.png" alt="" title="" /></div>
              <select class="form_input required" id="birthYear" name="birthYear">
                <option value="1995">1995</option>
                <option value="1994">1994</option>
                <option value="1993">1993</option>
                <option value="1992">1992</option>
                <option value="1991">1991</option>
                <option value="1990">1990</option>
                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>
                <option value="1979">1979</option>
                <option value="1978">1978</option>
                <option value="1977">1977</option>
                <option value="1976">1976</option>
                <option value="1975">1975</option>
                <option value="1974">1974</option>
                <option value="1973">1973</option>
                <option value="1972">1972</option>
                <option value="1971">1971</option>
                <option value="1970">1970</option>
                <option value="1969">1969</option>
                <option value="1968">1968</option>
                <option value="1967">1967</option>
                <option value="1966">1966</option>
                <option value="1965">1965</option>
                <option value="1964">1964</option>
                <option value="1963">1963</option>
                <option value="1962">1962</option>
                <option value="1961">1961</option>
                <option value="1960">1960</option>
                <option value="1959">1959</option>
                <option value="1958">1958</option>
                <option value="1957">1957</option>
                <option value="1956">1956</option>
                <option value="1955">1955</option>
                <option value="1954">1954</option>
                <option value="1953">1953</option>
                <option value="1952">1952</option>
                <option value="1951">1951</option>
              </select>
            <span id='register_birthYear_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/lock.png" alt="" title="" /></div>
            <input type="password" name="password" id="password" value="" class="form_input required" placeholder="password" />
            <div id='register_password_errorloc' class='error' style='clear:both'></div>
            </div>
            <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN UP" />
            </form>

            <!-- client-side Form Validation-->

            <script type='text/javascript'>
              var frmvalidator  = new Validator("RegisterForm");
              frmvalidator.EnableOnPageErrorDisplay();
              frmvalidator.EnableMsgsTogether();
              frmvalidator.addValidation("firstName","req","Please provide your first name");

              frmvalidator.addValidation("lastName","req","Please provide your last name");

              frmvalidator.addValidation("email","req","Please provide your email address");

              frmvalidator.addValidation("email","email","Please provide a valid email address");

              frmvalidator.addValidation("gender","req","Please provide your gender");

              frmvalidator.addValidation("birthYear","req","Please provide your birth year");
          
              frmvalidator.addValidation("password","req","Please provide a password");

            </script>
            </div>
</div>
</body>
</html>