<?PHP
  require_once("include/membersite_config.php");

  if($fgmembersite->CheckLogin())
  {
      echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , '}'
           , '</script>'
        ;
  }

  if(isset($_POST['submittedLogin']))
  {
     if($fgmembersite->Login())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedLocation']))
  {
     if($fgmembersite->SaveLocation())
     {
        $fgmembersite->RedirectToURL("index.php");
     }
  }

  if(isset($_POST['submittedRegister']))
  {
     if($fgmembersite->RegisterUser())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("openconfirm").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  $emailsent = false;
  if(isset($_POST['submittedReset']))
  {
     if($fgmembersite->EmailResetPasswordLink())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("opensent").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedProfile']))
  {
     if($fgmembersite->UpdateProfile())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , 'document.getElementById("openprofile").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedAccount']))
  {
     if($fgmembersite->UpdateAccount())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , 'document.getElementById("openaccount").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedDelete']))
  {
     if($fgmembersite->DeleteAccount())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("logoutbtn").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedProfilePic']))
  {
     if($fgmembersite->UploadPic())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , 'document.getElementById("openprofile").click();'
           , '}'
           , '</script>'
        ;
     }
  }

  if(isset($_POST['submittedLocation']))
  {
     if($fgmembersite->ChangeLocation())
     {
        echo '<script>'
           , 'function myFunction(){'
           , 'document.getElementById("features").click();'
           , '}'
           , '</script>'
        ;
     }
  }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
<link href="images/logo/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120">
<title>Barshark</title>
<link rel="stylesheet" href="css/framework7.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/yellow.css">
<link rel="stylesheet" href="custom.css">
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<link type="text/css" rel="stylesheet" href="css/animations.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>
</head>
<body id="mobile_wrap" onload="myFunction()">

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>

    <!--<div class="panel panel-left panel-reveal">
         <div class="cartcontainer">
            <h2>CART <span>(3 ITEMS)</span></h2>
            <a href="#" class="closecart close-panel"><img src="images/icons/white/menu_close.png" alt="" title="" /></a>
            
            <div class="cart_item" id="cartitem1">
                <div class="item_title"><span>01.</span> Bicycle Pedal Driven</div>
                <div class="item_price">$100</div>
              <div class="item_thumb"><a href="shop-item.html" class="close-panel"><img src="images/shop_thumb1.jpg" alt="" title="" /></a></div>
                <div class="item_qnty">
                    <form id="myform" method="POST" action="#">
                        <label>QUANTITY</label>
                        <input type="button" value="-" class="qntyminus" field="quantity" />
                        <input type="text" name="quantity" value="1" class="qnty" />
                        <input type="button" value="+" class="qntyplus" field="quantity" />
                    </form>
                </div>
                <a href="#" class="item_delete" id="cartitem1"><img src="images/icons/yellow/trash.png" alt="" title="" /></a>           </div>
            
            <div class="cart_item" id="cartitem2">
                <div class="item_title"><span>02.</span> Yellow Car </div>
                <div class="item_price">$1200</div>
              <div class="item_thumb"><a href="shop-item.html" class="close-panel"><img src="images/shop_thumb2.jpg" alt="" title="" /></a></div>
                <div class="item_qnty">
                    <form id="myform" method="POST" action="#">
                        <label>QUANTITY</label>
                        <input type="button" value="-" class="qntyminus" field="quantity2" />
                        <input type="text" name="quantity2" value="1" class="qnty" />
                        <input type="button" value="+" class="qntyplus" field="quantity2" />
                    </form>
                </div>
                <a href="#" class="item_delete" id="cartitem2"><img src="images/icons/yellow/trash.png" alt="" title="" /></a>            </div>
            
            <div class="cart_item" id="cartitem3">
                <div class="item_title"><span>03.</span> Summer T-Shirt</div>
                <div class="item_price">$20</div>
              <div class="item_thumb"><a href="shop-item.html" class="close-panel"><img src="images/shop_thumb3.jpg" alt="" title="" /></a></div>
                <div class="item_qnty">
                    <form id="myform" method="POST" action="#">
                        <label>QUANTITY</label>
                        <input type="button" value="-" class="qntyminus" field="quantity3" />
                        <input type="text" name="quantity3" value="1" class="qnty" />
                        <input type="button" value="+" class="qntyplus" field="quantity3" />
                    </form>
                </div>
                <a href="#" class="item_delete" id="cartitem3"><img src="images/icons/yellow/trash.png" alt="" title="" /></a>             </div>
            
              <div class="carttotal">
                  <div class="carttotal_row">
                  <div class="carttotal_left">CART TOTAL</div>  <div class="carttotal_right">$ 1,320.00</div>
                  </div>
                  <div class="carttotal_row">
                  <div class="carttotal_left">VAT (15%)</div>  <div class="carttotal_right">$ 198.00</div>
                  </div>
                  <div class="carttotal_row_last">
                  <div class="carttotal_left">TOTAL</div> <div class="carttotal_right">$ 1,518.00</div>
                  </div>
              </div>
            
              <a href="checkout.html" class="checkout close-panel">PROCEED TO CHECKOUT</a>           </div>
    </div>-->

<!--LOCATION FORM-->
<form id="LocationForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
  <input type='hidden' name='submittedLocation' id='submittedLocation' value='1'/>
  <!--CITY-->
  <div class="panel panel-left panel-reveal">
    <div class="cartcontainer">
      <h2>CHANGE LOCATION</h2>
      <a href="#" class="close-location close-panel"><img src="images/icons/white/menu_close.png" alt="" title="" /></a>

      <?php

        $fgmembersite->City();

      ?>
      
    </div>
  </div>

  <!--DISTRICT-->
  <div class="popup popup-district">
    <div class="content-block-login">
      <h4>CHOOSE DISTRICT</h4>

      <label>
        <input type="radio" data-popup=".popup-style" class="close-panel open-popup" id="ALL" name="district" value="NULL">
        <div class="location-district"><h3>All</h3></div>
      </label>

      <div id="districtList"></div>

      <script>
      function getDistrict(city) 
      {
        if(city == "Miami")
        {
          document.getElementById("districtList").innerHTML = 
          "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='SoHo' name='district' value='SoHo'><div class='location-district'><h3>SoHo</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='Downtown' name='district' value='Downtown'><div class='location-district'><h3>Downtown</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          ;
        }
        else if(city == "Orlando")
        { 
          document.getElementById("districtList").innerHTML = 
          "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='Downtown' name='district' value='Downtown'><div class='location-district'><h3>Downtown</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='Oviedo' name='district' value='Oviedo'><div class='location-district'><h3>Oviedo</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='UCF' name='district' value='UCF'><div class='location-district'><h3>UCF</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='Winter Park' name='district' value='Winter Park'><div class='location-district'><h3>Winter Park</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          
          ;
        }
        else if(city == "Tampa")
        { 
          document.getElementById("districtList").innerHTML = 
          "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='Downtown' name='district' value='Downtown'><div class='location-district'><h3>Downtown</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='South Beach' name='district' value='South Beach'><div class='location-district'><h3>South Beach</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"
          + "<label><input type='radio' data-popup='.popup-style' class='close-panel open-popup' id='TBD' name='district' value='TBD'><div class='location-district'><h3>TBD</h3></div></label>"

          ;
        }
        else
        { 
          document.getElementById("districtList").innerHTML = 
          "<?php echo '0 results found'; ?>";
        }
      }
      </script>

    </div>
    <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
  </div>

  <!--STYLE-->
  <div class="popup popup-style">
    <div class="content-block-login">
      <h4>CHOOSE STYLE</h4>

      <label>
        <input type="radio" class="close-popup" id="ALL" name="style" value="NULL">
        <div class="location-district"><h3>ALL</h3></div>
      </label>

      <?php

        $fgmembersite->Style();

      ?>

    </div>
    <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
  </div>
</form>







    <div class="panel panel-right panel-reveal"> 
          <div class="user_login_info">
                <div class="user_thumb">
                <!--<img src="images/profile.jpg" alt="" title="" />-->
                  <div class="user_avatar"><img src="images/avatar.jpg" alt="" title=""/></div>
                  <div class="user_details">
                   <p>Hi, <span><?php echo $fgmembersite->UserFullName(); ?></span>!</p>
                  </div>    
                </div>

                  <nav class="user-nav">
                    <ul>
                      <li><a href="features.php" class="close-panel"><img src="images/icons/teal/favorites.png" alt="" title="" /><span>FAVORITES</span></a></li>
                      <li><a href="https://m.uber.com/ul/" class="external"><img src="images/icons/black/uber.svg" alt="" title="" /><span>GET A RIDE</span></a></li>
                      <li><a href="myfriends.php" class="close-panel"><img src="images/icons/teal/users.png" alt="" title="" /><span>MY FRIENDS</span></a></li>
                      <li><a href="#" data-popup=".popup-profile" class="open-popup"><img src="images/icons/teal/user.png" alt="" title="" /><span>EDIT PROFILE</span></a></li>
                      <li><a href="#" data-popup=".popup-account" class="open-popup"><img src="images/icons/teal/briefcase.png" alt="" title="" /><span>MY ACCOUNT</span></a></li>
                      <li><a href="logout.php" id="logoutbtn" class="close-panel"><img src="images/icons/teal/logout.png" alt="" title="" /><span>LOGOUT</span></a></li>
                    </ul>
                  </nav>
          </div>
    </div>

    <div class="views">

      <div class="view view-main">

        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content">
               <div class="logo"><img src="images/icons/white/logo.svg" alt=""><span>Making every night, the best night.</span></div>
                  <nav class="main-nav">
                      <ul>
                          <li><a href="#" id="loginbtn" data-popup=".popup-login" class="open-popup"><img src="images/icons/login/login.svg" alt="" title="" /><!--<span>LOGIN</span>--></a></li>
                          
                          <li style="visibility: hidden;"><a href="features.php" id="features"><img src="images/icons/yellow/settings.png" alt="" title="" /><span>FEATURES</span></a></li>
                          <!--<li><a href="shop.html"><img src="images/icons/yellow/shop.png" alt="" title="" /><span>SHOP</span></a></li>-->
                          <!--<li><a href="#" data-panel="left" class="open-panel"><img src="images/icons/yellow/cart.png" alt="" title="" /><span>CART</span><div class="cartitems">3</div></a></li>-->
                          <!--<li><a href="blog.html"><img src="images/icons/yellow/blog.png" alt="" title="" /><span>NEWS</span></a></li>-->
                          <!--<li><a href="photos.html"><img src="images/icons/yellow/photos.png" alt="" title="" /><span>PHOTOS</span></a></li>-->
                          <!--<li><a href="tel:1234 5678" class="external"><img src="images/icons/yellow/phone.png" alt="" title="" /><span>CALL US</span></a></li>-->
                          <!--<li><a href="contact.html"><img src="images/icons/yellow/contact.png" alt="" title="" /><span>MESSAGE</span></a></li>-->

                      </ul>
                  </nav> 
              </div>
            </div>
          </div>
        </div>
      </div>
    
    <!-- Login Popup -->
    <div class="popup popup-login">
    <div class="content-block-login">
      <h4>LOGIN</h4>
        <div class="loginform">
          <form id="LoginForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
          <input type='hidden' name='submittedLogin' id='submittedLogin' value='1'/>
          <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
          <div class="form_row">
          <div class="form_row_icon"><img src="images/icons/white/contact.png" alt="" title="" /></div>
          <input type="text" name="email" value="" class="form_input required" placeholder="email" />
          </div>
          <div class="form_row">
          <div class="form_row_icon"><img src="images/icons/white/lock.png" alt="" title="" /></div>
          <input type="password" name="password" value="" class="form_input required" placeholder="password" />
          </div>
          <div class="remember_me" style="width: 50%; float: left; font-size: 12px;">
          <!--<div class="form_row_icon">-->Stay Logged In<!--</div>-->
          <input type="checkbox" name="loginCheck" value="value1" checked/> 
          </div>
          <div class="forgot_pass"><a href="#" id="forgotbtn" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
          <input type="submit" name="submitLogin" class="form_submit" id="submitLogin" value="SIGN IN" />
          </form>

          <div class="signup_social">
          <a href="http://www.facebook.com/" class="signup_facebook external">FACEBOOK</a>
          <a href="contact.html" class="login_contact close-popup"><span>CONTACT US</span></a>

        </div>

        <script type='text/javascript'>
        // <![CDATA[

            var frmvalidator  = new Validator("LoginForm");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();

            frmvalidator.addValidation("email","req","Please provide your email");
            
            frmvalidator.addValidation("password","req","Please provide the password");

        // ]]>
        </script>





              <div class="signup_social">
                <!-- Load the Facebook JavaScript SDK -->





                <div class="signup_bottom">
                  <p>Don't have an account?</p>
                  <a href="#" id="signupbtn" data-popup=".popup-signup" class="open-popup">SIGN UP</a>  
                </div>
              </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Register Popup -->
    <div class="popup popup-signup">
    <div class="content-block-login">
      <h4>REGISTER</h4>
            <div class="loginform" id='fg_membersite'>
            <form id="RegisterForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
            <input type='hidden' name='submittedRegister' id='submittedRegister' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/user.png" alt="" title="" /></div>
            <input type='text' name='firstName' class="form_input required" id='firstName' value="" placeholder="first name" /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon" style="visibility: hidden"><img src="images/icons/white/user.png" alt="" title="" /></div>
            <input type='text' name='lastName' class="form_input required" id='lastName' value="" placeholder="last name" /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/contact.png" alt="" title="" /></div>
            <input type="text" name="email" id="email" value="" class="form_input required" placeholder="email" />
            <span id='register_email_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/gender.png" alt="" title="" /></div>
              <!--<select class="form_input required" id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>-->

        <div id="gender" class="gender form_input required" name="gender">
            <ul>
            <li>
              <input type="radio" id="male-option" name="gender" value="m">
              <label for="male-option">Male</label>
              <div class="check"></div>
            </li>
            
            <li>
              <input type="radio" id="female-option" name="gender" value="f">
              <label for="female-option">Female</label>
              <div class="check"><div class="inside"></div></div>
            </li>
          </ul>
        </div>

            <span id='register_gender_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/blog.png" alt="" title="" /><br/></div>
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
            <div class="form_row_icon"><img src="images/icons/white/lock.png" alt="" title="" /></div>
            <input type="password" name="password" id="password" value="" class="form_input required" placeholder="password" />
            <div id='register_password_errorloc' class='error' style='clear:both'></div>
            </div>
            <input type="submit" name="submitRegister" class="form_submit" id="submitRegister" value="SIGN UP" />
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
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
      
    </div>
    </div>
    
    <!-- Forgot Popup -->
    <div class="popup popup-forgot">
    <div class="content-block-login">
      <h4>FORGOT PASSWORD</h4>
            <div class="loginform">
            <form id="ForgotForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
            <input type='hidden' name='submittedReset' id='submittedReset' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/contact.png" alt="" title="" /></div>
            <input type="text" name="email" value="" class="form_input required" placeholder="email" />
            </div>
            <input type="submit" name="submitReset" class="form_submit" id="submitReset" value="RESEND PASSWORD" />
            </form>
            <div class="signup_bottom" style="visibility: hidden;">
            <a href="#" id="opensent" data-popup=".popup-sent" class="open-popup"></a>
            <a href="#" id="openconfirm" data-popup=".popup-confirm" class="open-popup"></a>
            <a href="#" id="openprofile" data-popup=".popup-profile-updated" class="open-popup"></a>
            <a href="#" id="openaccount" data-popup=".popup-account-updated" class="open-popup"></a>
            </div>
            </div>

            <script type='text/javascript'>
            // <![CDATA[

                var frmvalidator  = new Validator("ForgotForm");
                frmvalidator.EnableOnPageErrorDisplay();
                frmvalidator.EnableMsgsTogether();

                frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
                frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");

            // ]]>
            </script>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Sent Password Popup -->
    <div class="popup popup-sent">
    <div class="content-block-login">
      <h4>WE'VE EMAILED YOU!</h4>
            <div class="sentform">
            <p>Check your email and follow the instructions to reset your password.</p>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Sent Register Popup -->
    <div class="popup popup-confirm">
    <div class="content-block-login">
      <h4>WE'VE EMAILED YOU!</h4>
            <div class="confirmform">
            <p>Check your email and follow the instructions to complete your registration.</p>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Social Popup -->
    <div class="popup popup-social">
    <div class="content-block">
      <h4>FOLLOW US</h4>
      <p>Social icons solution that allows you share and increase your social popularity.</p>
      <ul class="popup_categories">
      <li><a href="http://twitter.com/" class="external"><img src="images/icons/yellow/twitter.png" alt="" title="" /><span>TWITTER</span></a></li>
      <li><a href="http://www.facebook.com/" class="external"><img src="images/icons/yellow/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
      <li><a href="http://plus.google.com" class="external"><img src="images/icons/yellow/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
      <li><a href="http://www.dribbble.com/" class="external"><img src="images/icons/yellow/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
      <li><a href="http://www.linkedin.com/" class="external"><img src="images/icons/yellow/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
      <li><a href="http://www.pinterest.com/" class="external"><img src="images/icons/yellow/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
      </ul>
      <div class="close_popup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Shop Categories Popup -->
    <div class="popup popup-shopcategories">
    <div class="content-block">
      <h4>SHOP CATEGORIES</h4>
      <ul class="popup_categories">
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/bike.png" alt="" title="" /><span>BIKES</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/car.png" alt="" title="" /><span>CARS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/rocket.png" alt="" title="" /><span>ROCKETS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/orders.png" alt="" title="" /><span>T-SHIRTS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/food.png" alt="" title="" /><span>FOOD</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/drink.png" alt="" title="" /><span>DRINKS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/photos.png" alt="" title="" /><span>PHOTOS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/bus.png" alt="" title="" /><span>BUSES</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/yellow/electronics.png" alt="" title="" /><span>ELECTRONICS</span></a></li>
      </ul>
      <div class="close_popup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Profile Popup -->
    <div class="popup popup-profile">
    <div class="content-block-login">
      <h4>EDIT PROFILE</h4>
            <div class="profileform loginform" id='fg_membersite'>
            <form id="profileForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
            <input type='hidden' name='submittedProfile' id='submittedProfile' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/user.png" alt="" title="" /></div>
            <input type='text' name='newfirstName' class="form_input required" id='newfirstName' value='<?php echo $fgmembersite->UserFullName(); ?>' /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon" style="visibility: hidden"><img src="images/icons/white/user.png" alt="" title="" /></div>
            <input type='text' name='newlastName' class="form_input required" id='newlastName' value='<?php echo $fgmembersite->UserLastName(); ?>' /><br/>
            <span id='register_name_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/gender.png" alt="" title="" /></div>

                <div id="newgender" style="margin-left: 18px" class="gender form_input required" name="newgender">
                   <?php
                        if ($fgmembersite->UserGender() == "m")
                        {
                            echo '<ul>'
                            ,      '<li>'
                            ,       '<input type="radio" id="male-option2" name="newgender" value="m" checked="checked">'
                            ,       '<label for="male-option2">Male</label>'
                            ,       '<div class="check"></div>'
                            ,      '</li>'
                            ,      '<li>'
                            ,       '<input type="radio" id="female-option2" name="newgender" value="f">'
                            ,       '<label for="female-option2">Female</label>'
                            ,       '<div class="check"><div class="inside"></div></div>'
                            ,      '</li>'
                            ,     '</ul>'
                            ;
                        }
                        else
                        {
                            echo '<ul>'
                            ,      '<li>'
                            ,       '<input type="radio" id="male-option2" name="newgender" value="m">'
                            ,       '<label for="male-option2">Male</label>'
                            ,       '<div class="check"></div>'
                            ,      '</li>'
                            ,      '<li>'
                            ,       '<input type="radio" id="female-option2" name="newgender" value="f" checked="checked">'
                            ,       '<label for="female-option2">Female</label>'
                            ,       '<div class="check"><div class="inside"></div></div>'
                            ,      '</li>'
                            ,     '</ul>'
                            ;
                        }
                  ?>
                </div>

            <span id='register_gender_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/blog.png" alt="" title="" /></div>
              <select class="form_input required" id="newbirthYear" style="margin: 0px 25px 25px 18px;" name="newbirthYear">
                <option value='<?php echo $fgmembersite->UserYear(); ?>'><?php echo $fgmembersite->UserYear(); ?></option>
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
              <div class="form_row_icon"><img src="images/icons/white/photos.png" alt="" title="" /></div>
              <a href="#" data-popup=".popup-profilepic" id="edit-picture" class="open-popup" style="margin-left: 18px">Edit Profile Picture</a>
            </div>

            <input type="submit" name="submitProfile" class="form_submit" id="submitProfile" value="SAVE CHANGES" />
            </form>

            <!-- client-side Form Validation-->

            <script type='text/javascript'>
              var frmvalidator  = new Validator("profileForm");
              frmvalidator.EnableOnPageErrorDisplay();
              frmvalidator.EnableMsgsTogether();
              frmvalidator.addValidation("newfirstName","req","Please provide your first name");

              frmvalidator.addValidation("newlastName","req","Please provide your last name");

              frmvalidator.addValidation("newgender","req","Please provide your gender");

              frmvalidator.addValidation("newbirthYear","req","Please provide your birth year");
            </script>
            </div>
    </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>

    <!-- Profile Updated Popup -->
    <div class="popup popup-profile-updated">
    <div class="content-block-login">
      <h4>PROFILE UPDATED!</h4>
            <div class="profileupdatedform" id='fg_membersite'>
            <p>You're profile has been updated! We've sent you an email with your new account information. You may have to restart the app to notice these changes.</p>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Profile Pic Popup -->
    <div class="popup popup-profilepic">
    <div class="content-block-login">
      <h4>UPLOAD NEW PHOTO</h4>
            <div class="loginform" id='fg_membersite'>
            <form id="profilePicForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
              <input type='hidden' name='submittedProfilePic' id='submittedProfilePic' value='1'/>
              <div class="form_row_icon"><img src="images/icons/white/photos.png" alt="" title="" /></div>
              <input type="file" class="photo-upload" name="profilepic" id="profilepic"><br>
              <input type="submit" class="form_submit" name="submitProfilePic" value="UPLOAD">
            </form>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Account Popup -->
    <div class="popup popup-account">
    <div class="content-block-login">
      <h4>UPDATE ACCOUNT</h4>
            <div class="accountform loginform" id='fg_membersite'>
            <form id="accountForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
            <input type='hidden' name='submittedAccount' id='submittedAccount' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/contact.png" alt="" title="" /></div>
            <input type="text" name="newEmail" id="newEmail" class="form_input required" value='<?php echo $fgmembersite->UserEmail(); ?>' />
            <span id='register_email_errorloc' class='error'></span>
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/white/lock.png" alt="" title="" /></div>
            <input type="password" name="newPassword" id="newPassword" value='<?php echo $fgmembersite->UserPassword(); ?>' class="form_input required" />
            <div id='register_password_errorloc' class='error' style='clear:both'></div>
            </div>
            <input type="submit" name="submitAccount" class="form_submit" id="submitAccount" value="SAVE CHANGES" />
            </form>

            <div class="delete-account">
              <a href="#" id="deleteaccount" data-popup=".popup-delete" class="open-popup">DELETE ACCOUNT</a>
            </div>

            <!-- client-side Form Validation-->

            <script type='text/javascript'>
              var frmvalidator  = new Validator("accountForm");
              frmvalidator.EnableOnPageErrorDisplay();
              frmvalidator.EnableMsgsTogether();
              frmvalidator.addValidation("newEmail","req","Please provide your email address");

              frmvalidator.addValidation("newEmail","email","Please provide a valid email address");
          
              frmvalidator.addValidation("newPassword","req","Please provide a password");

            </script>
            </div>
    </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>

    <!-- Account Updated Popup -->
    <div class="popup popup-account-updated">
    <div class="content-block-login">
      <h4>ACCOUNT UPDATED!</h4>
            <div class="profileupdatedform" id='fg_membersite'>
            <p>You're account has been updated! We've sent you an email with your new account information. You may have to restart the app to notice these changes.</p>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>

    <!-- Delete Popup -->
    <div class="popup popup-delete">
    <div class="content-block-login">
      <h4>DELETE ACCOUNT</h4>
            <div class="deleteform" id='fg_membersite'>
            <form id="deleteForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method="post" accept-charset='UTF-8'>
            <input type='hidden' name='submittedDelete' id='submittedDelete' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div id="gender" class="gender form_input required" name="gender">
              <!--<ul>
                <li>
                  <input type="radio" id="no-option" name="deleteYN" value="no">
                  <label for="no-option">No</label>
                  <div class="check"></div>
                </li>
            
                <li>
                  <input type="radio" id="yes-option" name="deleteYN" value="yes">
                  <label for="yes-option">Yes</label>
                  <div class="check"><div class="inside"></div>
                </li>
              </ul>
              <script>
                document.getElementById("yes-option").addEventListener("click", yesFunction);
                document.getElementById("no-option").addEventListener("click", noFunction);

                function yesFunction() {
                    document.getElementById("deletepwd").style.visibility = "visible";
                }

                function noFunction() {
                    document.getElementById("deletepwd").style.visibility = "hidden";
                }
              </script>-->
            </div>
            <div class="form_row" id="deletepwd" style="visibility: visible;">
            <div class="form_row_icon"><img src="images/icons/white/lock.png" alt="" title="" /></div>
            <input type="password" name="delPassword" id="delPassword" value="" class="form_input required" />
            <div id='register_password_errorloc' class='error' style='clear:both'></div>

            <input type="submit" name="submitDelete" class="form_submit" id="submitDelete" value="DELETE ACCOUNT" />
            </div>
            </form>

            <!-- client-side Form Validation-->

            <script type='text/javascript'>
              var frmvalidator  = new Validator("deleteForm");
              frmvalidator.EnableOnPageErrorDisplay();
              frmvalidator.EnableMsgsTogether();
          
              frmvalidator.addValidation("delPassword","req","Please provide a password");

            </script>
            </div>
    </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/framework7.js"></script>
<script type="text/javascript" src="js/my-app.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script type="text/javascript" src="js/email.js"></script>
<script type='text/javascript' src='js/gen_validatorv31.js'></script>
<script type="text/javascript" src="js/pwdwidget.js"></script>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXre7xZaF3rVGNwzRS8pddl5JsPItKokg&libraries=places"></script>-->
  </body>
</html>