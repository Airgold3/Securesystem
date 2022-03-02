<?php

/*
This file is part of SecureSystem.
Copyright (C) 2022 Santiago Fernández, Airgold3 
    SecureSystem is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    SecureSystem is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with SecureSystem.  If not, see <https://www.gnu.org/licenses/>.
*/

include_once("includes/process.php");
include_once("includes/functions.php");

if (!isset($_SESSION['email'])) {
    header('location: login.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--==Title==================================-->
<title>Secure System</title>
<!--Stylesheet===============================-->
<link rel="stylesheet" href="css/style2.css">
<!--==fav-icon===============================-->
<link rel="shortcut icon" href="images/fav-icon.png"/>
<!--==Import-poppins-font-family=============-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!--==Page-Scroll-progress-bar==============-->
    <div id="progress">
        <span id="progress-value"></span>
    </div>
    <!--==navigation=============================-->
    <nav class="navigation">
        <!--logo------------>
        <a href="#" class="logo"><?php echo "Hello " .  strstr($_SESSION['email'], '@', true); ?></a>
        <!--menu-btn-------->
        <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="nav-icon"></span>
        </label>
        <!--menu------------>
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="logout.php" class="nav-contact">Logout</a></li>
        </ul>
    </nav>
    <!--==page-container========================================-->
    <div class="page-container">
        <!--==top-bar=============================-->
        <!--div class="top-bar">
            <span>NB/<br/>Blog</span>
            <div class="article-number"><span>37</span><br/>Article</div>
        </div-->
        <!--==Blog-Section=========================-->
        <section id="blog">
            <!--heading------------->
            <div class="blog-heading">
                <!--h1>Musing, working, and everything in between.</h1-->
            </div>
            <!--filter-------------->
            <ul class="blog-filter">
                <li class="list blog-filter-active" data-filter="all">All</li>/
                <li class="list" data-filter="insights">insights</li>/
                <li class="list" data-filter="projects">projects</li>/
                <li class="list" data-filter="culture">nb culture</li>/
                <li class="list" data-filter="news">news</li>
            </ul>

    
            <!--blog-box-container------------------>
            <div class="blog-container">
                <!--box-1-------->
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-1.jpg" 
                                                " width='60' height='60'> 
                    </div>
                </a>
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-2.jpg" 
                                                " width='60' height='60'> 
                    </div>
                </a>
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-3.jpg" 
                                                " width='60' height='60'> 
                    </div>
                </a>
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-4.png" 
                                                " width='60' height='60'> 
                    </div>
                </a>
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-5.jpg" 
                                                " width='60' height='60'> 
                    </div>
                </a>
                <a href="#" class="blog-box insights">
                    <!--img--->
                    <div class="blog-img">
                    <img src="images/blog-6.jpg" 
                                                " width='60' height='60'> 
                    </div>
                </a>
    
                
            </div>
        </section>
    </div>
    <!--page-container-end--------------------->
    <!--footer=========================================-->
    <footer>
        <div class="footer-container">
          
                <div class="copyright">
                    <span>Made by Airgold3</span>
                    <span>&#169; 2022 GTN</span>
                </div>
        </div>
    </footer>
 <!--==JQuery=================================-->
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
     
/*--==Scroll-bar-script======================-*/
 
let scrollPercentage = () => {
        let scrollProgress = document.getElementById("progress");
        let progressValue = document.getElementById("progress-value");
        let pos = document.documentElement.scrollTop;
        let calcHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrollValue = Math.round( pos * 100 / calcHeight);
        scrollProgress.style.background = `conic-gradient(#e2d30c ${scrollValue}%, #2b2f38 ${scrollValue}%)`;
        progressValue.textcontent = `${scrollValue}%`;
 
    }
    window.onscroll = scrollPercentage;
    window.onload = scrollPercentage;
 
 
    /*--==Post-Filter-Script=================================--*/
    
        $(document).on('click','.blog-filter li', function(){
            $(this).addClass('blog-filter-active').siblings().removeClass('blog-filter-active')
        });
 
        /*--filter------------------------*/
        $(document).ready(function(){
            $('.list').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'all'){
                    $('.blog-box').show('1000');
                }
                else{
                    $('.blog-box').not('.'+value).hide('1000');
                    $('.blog-box').filter('.'+value).show('1000');
                }
            });
        });
    </script>
    <script>
        Swal.fire({
  position: 'top-end',
  icon: 'success',
  title: 'You have successfully logged in <?php echo strstr($_SESSION['email'], '@', true); ?>',
  showConfirmButton: false,
  timer: 1900
})
    </script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

  
<?php
}
?>

