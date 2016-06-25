<?php
     require_once("include/membersite_config.php");
?>

<div class="pages">
  <div data-page="contact" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left"><a href="features.php"><img src="images/icons/white/back.png" alt="" title="" /></a></div>
       <div class="navbar_center" style="color: white;"><!--<h2>barshark</h2>--><img src="images/icons/white/logo.svg" alt="" title="" /></div>
       <div class="navbar_right" style="visibility: hidden;"><a href="#" data-panel="right" class="open-panel"><img src="images/icons/white/user.png" alt="" title="" /></a></div>
     </div>

     <div id="pages_maincontent">

    <?php

      //check if the set variable exists
      if (isset($_GET['search']))
      {
          $fgmembersite->focus($_GET['search']);
      }

    ?>
    
      <!--<h2 class="page_title">Ethos Vegan Kitchen</h2>
      <div class="page_content"> 
      <div class="contact_info">
      Hours: <span>Sunday</span> 11AM—12AM <br />
      Phone: 555-555-5555 <br />
      Menu: <a href="http://www.ethosvegankitchen.com/menu" target="_blank">OPEN</a>
      </div>    
      <h3>Our Location</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3596.6251316836215!2d-80.34114568504981!3d25.65056428368738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9c6ecbeb5721f%3A0x669152096eaa540e!2s8926+SW+129th+St%2C+Miami%2C+FL+33176!5e0!3m2!1sen!2sus!4v1452033011970" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
      <div class="clear"></div>
      </div>-->
      
      </div>
      
    </div>
  </div>
</div>