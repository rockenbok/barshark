// Initialize the Facebook JavaScript SDK
FB.init({
  appId: '702912713187427',
  xfbml: true,
  status: true,
  cookie: true,
});

// Check if the current user is logged in and has authorized the app
FB.getLoginStatus(checkLoginStatus);

// Login in the current user via Facebook and ask for email permission
function authUser() {
  FB.login(checkLoginStatus, {scope:'email'});
}

// Check the result of the user status and display login button if necessary
function checkLoginStatus(response) {
  if(response && response.status == 'connected') {
    alert('User is authorized');
    
    // Now Personalize the User Experience
    console.log('Access Token: ' + response.authResponse.accessToken);

    window.location = "http://thebarshark.com/Barshark-App/www/features.php";
  } else {
    window.location = "http://thebarshark.com/Barshark-App/www/index.php";
  }
}

<!-- Load the Facebook JavaScript SDK -->
                <div id="fb-root"></div>
                <script src="//connect.facebook.net/en_US/all.js"></script>
    
                <script type="text/javascript">
                // Initialize the Facebook JavaScript SDK
                FB.init({
                  appId: '702912713187427',
                  xfbml: true,
                  status: true,
                  cookie: true,
                });

                // Check if the current user is logged in and has authorized the app
                FB.getLoginStatus(checkLoginStatus);

                // Login in the current user via Facebook and ask for email permission
                function authUser() {
                  FB.login(checkLoginStatus, {scope:'email'});
                }

                // Check the result of the user status and display login button if necessary
                function checkLoginStatus(response) {
                  if(response && response.status == 'connected') {
                    alert('User is authorized');
                    
                    // Now Personalize the User Experience
                    console.log('Access Token: ' + response.authResponse.accessToken);

                    window.location = "http://thebarshark.com/Barshark-App/www/features.php";
                  } else {
                    alert('User is not authorized');
          
                    // Display the login button
                    document.getElementById('loginButton').style.display = 'block';
                  }
                }
                </script>
                
                <input id="loginButton" type="button" value="Login!" onclick="authUser();" />










                

                <div id="fb-root"></div>
                  <script src="//connect.facebook.net/en_US/all.js"></script>
      
                  <script type="text/javascript">
                  // Initialize the Facebook JavaScript SDK
                  FB.init({
                    appId: '702912713187427',
                    xfbml: true,
                    status: true,
                    cookie: true,
                  });

                  // Check if the current user is logged in and has authorized the app
                  FB.getLoginStatus(checkLoginStatus);

                  // Login in the current user via Facebook and ask for email permission
                  function authUser() {
                    FB.login(checkLoginStatus, {scope:'email'});
                  }

                  // Check the result of the user status and display login button if necessary
                  function checkLoginStatus(response) {
                    if(response && response.status == 'connected') {
                      alert('User is authorized');
                      
                      // Now Personalize the User Experience
                      console.log('Access Token: ' + response.authResponse.accessToken);

                      window.location = "http://thebarshark.com/Barshark-App/www/features.php";
                    } else {
                      alert('User is not authorized');
            
                      // Display the login button
                      document.getElementById('loginButton').style.display = 'block';
                    }
                  }
                  </script>
                  
                  <input id="loginButton" type="button" value="Login!" onclick="authUser();" />