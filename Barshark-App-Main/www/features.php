<?php
     require_once("include/membersite_config.php");
?>

<div class="pages">
  <div data-page="features" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left"><a href="#" data-panel="left" class="open-panel"><img src="images/icons/white/map.png" alt="" title="" /></a></div>
       <div class="navbar_center" style="color: white;"><!--<h2>barshark</h2>--><img src="images/icons/white/logo.svg" alt="" title="" /></div>
       <div class="navbar_right"><a href="#" data-panel="right" class="open-panel"><img src="images/icons/white/user.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">Nearby Locations | <?php echo $fgmembersite->UserCity();  echo $fgmembersite->UserDistrict(); echo $fgmembersite->UserStyle(); ?></h2>
      
      <div class="page_content">
      
      <ul class="features_list_detailed">

          <?php

               $fgmembersite->Locations();

          ?>
      
          <!--<li class="featured">
          <a href="focus.php">
          <div class="feat_small_icon"><img src="images/icons/indicators/busy.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4>Ethos Vegan Kitchen</h4>
          <a href="focus.php">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><img src="images/icons/black/plus.png" alt="" title="" /></span>
          </a>
          </li>
          
          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Cafe Caobana</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>
          
          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/moderate.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">310 South Grill</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/moderate.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Matilda's</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/busy.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Lizzy McCormick's Irish Pub</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/busy.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Finnhenry's</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">iBar</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/moderate.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Bubbalou's BBQ Joint</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">The Coop</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Spat's Pool hall</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Austin's Coffee House</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/busy.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Krungthep Tea Time</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/moderate.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">The Soda Fountain Ice Cream Parlor</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/moderate.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Rusteak</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/busy.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">Hotto Potto</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>

          <li>
          <div class="feat_small_icon"><img src="images/icons/indicators/slow.svg" alt="" title="" /></div>
          <div class="feat_small_details">
          <h4><a href="#">DeVine Bar and Grill</a></h4>
          <a href="#">Brief 70 character description of this specific location.</a>
          </div>
          <span class="plus_icon"><a href="#"><img src="images/icons/teal/plus.png" alt="" title="" /></a></span>
          </li>-->
          
          
      </ul>
      
      
      </div>
      
      </div>

      
    </div>
  </div>
</div>