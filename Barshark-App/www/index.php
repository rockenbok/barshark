<?PHP
  require_once("include/membersite_config.php");

  if(isset($_POST['submittedLogin']))
  {
     if($fgmembersite->Login())
     {
          $fgmembersite->RedirectToURL("login-home.php");
     }
  }

  if(isset($_POST['submittedRegister']))
  {
     if($fgmembersite->RegisterUser())
     {
          $fgmembersite->RedirectToURL("thank-you.html");
     }
  }

  $emailsent = false;
  if(isset($_POST['submittedReset']))
  {
     if($fgmembersite->EmailResetPasswordLink())
     {
          $fgmembersite->RedirectToURL("reset-pwd-link-sent.html");
          exit;
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
<title>Barshark</title>
<link rel="stylesheet" href="css/framework7.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/yellow.css">
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<link type="text/css" rel="stylesheet" href="css/animations.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>
</head>
<body id="mobile_wrap">

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>

    <div class="panel panel-left panel-reveal">
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
    </div>

    <div class="panel panel-right panel-reveal"> 
          <div class="user_login_info">
                <div class="user_thumb">
                <img src="images/profile.jpg" alt="" title="" />
                  <div class="user_details">
                   <p>Hi, <span>Samantha</span></p>
                  </div>  
                  <div class="user_avatar"><img src="images/avatar.jpg" alt="" title="" /></div>       
                </div>

                  <nav class="user-nav">
                    <ul>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/users.png" alt="" title="" /><span>EDIT PROFILE</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/briefcase.png" alt="" title="" /><span>MY ACCOUNT</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/orders.png" alt="" title="" /><span>SHOP ORDERS</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/favorites.png" alt="" title="" /><span>FAVORITES</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/twitter.png" alt="" title="" /><span>SOCIAL</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/users.png" alt="" title="" /><span>FOLLOWERS</span></a></li>
                      <li><a href="features.html" class="close-panel"><img src="images/icons/yellow/message.png" alt="" title="" /><span>MESSAGES</span></a></li>
                      <li><a href="index.php" class="close-panel"><img src="images/icons/yellow/logout.png" alt="" title="" /><span>LOGOUT</span></a></li>
                    </ul>
                  </nav>
          </div>
    </div>

    <div class="views">

      <div class="view view-main">

        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content">
					     <div class="logo"><h1>barshark</h1><span>Making every night, the best night.</span></div>
                  <nav class="main-nav">
                      <ul>
                          <li><a href="#" data-popup=".popup-login" class="open-popup"><img src="images/icons/yellow/user.png" alt="" title="" /><span>LOGIN</span></a></li>
                          <li><a href="features.html"><img src="images/icons/yellow/settings.png" alt="" title="" /><span>FEATURES</span></a></li>
                          <!--<li><a href="shop.html"><img src="images/icons/yellow/shop.png" alt="" title="" /><span>SHOP</span></a></li>-->
                          <!--<li><a href="#" data-panel="left" class="open-panel"><img src="images/icons/yellow/cart.png" alt="" title="" /><span>CART</span><div class="cartitems">3</div></a></li>-->
                          <!--<li><a href="blog.html"><img src="images/icons/yellow/blog.png" alt="" title="" /><span>NEWS</span></a></li>-->
                          <li><a href="photos.html"><img src="images/icons/yellow/photos.png" alt="" title="" /><span>PHOTOS</span></a></li>
                          <!--<li><a href="tel:1234 5678" class="external"><img src="images/icons/yellow/phone.png" alt="" title="" /><span>CALL US</span></a></li>-->
                          <li><a href="contact.html"><img src="images/icons/yellow/contact.png" alt="" title="" /><span>MESSAGE</span></a></li>
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
          <div class="form_row_icon"><img src="images/icons/yellow/contact.png" alt="" title="" /></div>
          <input type="text" name="email" value="" class="form_input required" placeholder="email" />
          </div>
          <div class="form_row">
          <div class="form_row_icon"><img src="images/icons/yellow/lock.png" alt="" title="" /></div>
          <input type="password" name="password" value="" class="form_input required" placeholder="password" />
          </div>
          <div class="forgot_pass"><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
          <input type="submit" name="submitLogin" class="form_submit" id="submitLogin" value="SIGN IN" />
          </form>
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
                  <div id="fb-root"></div>
                    <script>
                      (function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=702912713187427";
                      fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk'));
                    </script>

                    <script>
                      FB.getLoginStatus(function(response) {
                        if (response.status === 'connected') {
                          // the user is logged in and has authenticated your
                          // app, and response.authResponse supplies
                          // the user's ID, a valid access token, a signed
                          // request, and the time the access token 
                          // and signed request each expire
                          var uid = response.authResponse.userID;
                          var accessToken = response.authResponse.accessToken;
                        } else if (response.status === 'not_authorized') {
                          // the user is logged in to Facebook, 
                          // but has not authenticated your app
                        } else {
                          // the user isn't logged in to Facebook.
                        }
                      });

                      FB.init({
                        appId: '702912713187427', cookie: true,
                        status: true, xfbml: true
                      });

                      FB.Event.subscribe('auth.login', function () {
                        window.location = "http://thebarshark.com/Barshark-App/www/blog.html";
                      });
                    </script>

                <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true"></div>
                </div>





                <div class="signup_bottom">
                <p>Don't have an account?</p>
                <a href="#" data-popup=".popup-signup" class="open-popup">SIGN UP</a>                </div>
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
    
    <!-- Login Popup -->
    <div class="popup popup-forgot">
    <div class="content-block-login">
      <h4>FORGOT PASSWORD</h4>
            <div class="loginform">
            <form id="ForgotForm" action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
            <input type='hidden' name='submittedReset' id='submittedReset' value='1'/>
            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/yellow/contact.png" alt="" title="" /></div>
            <input type="text" name="email" value="" class="form_input required" placeholder="email" />
            </div>
            <input type="submit" name="submitReset" class="form_submit" id="submitReset" value="RESEND PASSWORD" />
            </form>
            <div class="signup_bottom">
            <p>Check your email and follow the instructions to reset your password.</p>
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
    
<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/framework7.js"></script>
<script type="text/javascript" src="js/my-app.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script type="text/javascript" src="js/email.js"></script>
<script type='text/javascript' src='js/gen_validatorv31.js'></script>
<script type="text/javascript" src="js/pwdwidget.js"></script> 
  </body>
</html>