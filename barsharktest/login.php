<?PHP
require_once("include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("login-home.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Login</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
  <h4>LOGIN</h4>
    <div class="loginform">
      <form id="LoginForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
      <input type='hidden' name='submitted' id='submitted' value='1'/>
      <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
      <div class="form_row">
      <div class="form_row_icon"><img src="images/icons/yellow/user.png" alt="" title="" /></div>
      <input type="text" name="email" value="" class="form_input required" placeholder="email" />
      </div>
      <div class="form_row">
      <div class="form_row_icon"><img src="images/icons/yellow/lock.png" alt="" title="" /></div>
      <input type="password" name="password" value="" class="form_input required" placeholder="password" />
      </div>
      <div class="forgot_pass"><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
      <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN IN" />
      </form>
    </div>


<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("LoginForm");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("email","req","Please provide your email");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>