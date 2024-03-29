<?php  
include "database/db.php";   

  // فچ کردن همه ردیف های جدول منو برای نمایش در منوها
  $result = $conn->prepare("SELECT * FROM menu");
  $result->execute();
  $menus = $result->fetchAll(PDO::FETCH_ASSOC);
 
?>

<!doctype html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>آموزش برنامه نویسی</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Top Header -->
    <div class="container top-header">
        <img src="image/logo.svg" alt="logo header" width="80px">

        <!-- Search Box -->
        <div class="search-box d-none d-lg-flex">
            <div class="input-group md-form form-sm form-1 pl-0">
                <input class="form-control my-0 py-1" type="text" placeholder="دنبال چه آموزشی می گردی؟" aria-label="Search">
                <div class="input-group-prepend" style="font-size:16px;">
                    <span style="background-color: #007bff;" class="input-group-text purple lighten-3" id="basic-text1">
                        <svg style="color:#fff;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </span>
                </div>
                
            </div>
        </div>
         <!-- Search Box -->
        
        <!-- ورود/ثبت نام -->
        <div class="instagram-icon">
            <nav class="navbar navbar-expand-lg" style="width: 100%; direction:ltr;">
                <div style="margin-left: -16px; margin-right: -22px;">
                    <div class="container">
                        <ul class="navbar-nav">

                        <!-- اگر کاربر لاگین کرده بود -->
                        <?php  if(isset($_SESSION['login'])){ ?> 
                                
                            <li class="nav-item dropdown">
                                <a style="color:#333; padding-left:35px; margin-top: -50px;" class="nav-link " href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="color: #fff">

                                    <svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-caret-down-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    
                                    <!-- نمایش آدرس ایمیل کاربر -->
                                    <?php echo $_SESSION['email']; ?>
                                

                                     <img src="image/profile.gif" style="margin-top:-10px;" class="rounded-circle" width="50" height="50" alt="">
                                </a>
                                <div class="dropdown-menu myaccount-dropdown dropdown-menu-right text-right"
                                    aria-labelledby="navbarDropdown" style="margin-right:-40px;">
                                    <span><?php echo $_SESSION['password']; ?></span>
                                    <hr>
                                    <a class="dropmenu" href="#">
                                        
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        
                                        <?php 
                                            //بررسی نقش کاربر
                                            if ($_SESSION['role'] == 1) {
                                                echo "کاربر عادی";    
                                            }else{ 
                                                echo "مدیر"; 
                                            }  
                                        ?>
                                    </a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        ویرایش اطلاعات حساب </a>
                                    
                                        
                                        <?php 
                                            //اگر کاربر  مدیر بود بتواند ببیند
                                            if ($_SESSION['role'] == 2) { ?>

                                                <a class="dropmenu" href="admin">
                                                <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg>
                                                پنل ادمین
                                            </a>

                                        <?php  }  ?>
                                    
                                    <a class="dropmenu" href="#"> 
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        <?php 
                                            //بررسی فعال بودن کاربر
                                            if ($_SESSION['status'] == 0){                                                
                                        ?>
                                        
                                        <a href="" class="btn btn-danger">غیرفعال</a>

                                        <?php  }else{ ?>
                                            <a href="" class="btn btn-success">فعال</a>
                                        <?php  } ?>
                                    </a>
                                    <a class="dropmenu" href="pages/logout.php">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em" viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        خروج از حساب کاربری</a>
                                </div>
                            </li>

                                <?php  }else{ ?>
                                <!-- اگر کاربر لاگین نکرده بود -->
                                 
                                <li><a href="pages/login.php">ورود/</a></li>
                                <li><a href="pages/register.php">ثبت نام</a></li>
                                <?php  } ?> 
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
        <!-- ورود/ثبت نام -->
    </div>


    <!-- Nav Menu -->
    <nav class="navbar navbar-expand-lg navbar-light" id="nav-menu" style="width:100%;">
        <button style="margin-bottom: 10px;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="background-color: #333;">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-lg-none">
                        <input type="search" class="searchbox-mobile" placeholder="دنبال چی میگردی؟">
                    </li>

                    <!-- نمایش منوهای سایت -->
                    <?php  foreach ($menus as $menu) { if($menu['z'] == 0){ //فقط آیتم هایی که سرگروه هستند نمایش داده شود. ?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" style="color: #fff;"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php  echo $menu['title'];   ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <?php  foreach ($menus as $ul) { if ($menu['id'] == $ul['z']) { ?>
                                
                                
                                <a style="text-align: right; " class="dropmenu" href="#"> <?php  echo $ul['title'];  ?></a>
                                
                            <?php }}  ?>
                        </div>
                    </li>
                    <?php  }} //if & foreach  ?>
                    <!-- نمایش منوهای سایت -->

                    <!-- اگر کاربر لاگین کرده بود -->
                    <?php  if(isset($_SESSION['login'])){ ?> 
                    <li class="nav-item active">
                        <a class="nav-link" href="pages/logout.php" style="color: #fff;"> خروج   </a>
                    </li>
                    <?php  } ?> 
                    <!-- اگر کاربر لاگین کرده بود -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Menu -->

    <!-- Image Content -->
    <div id="image-cont">
        <div class="container">
            <div class="row">
                <div class="caption-site">
                <h3 style="text-align: right;">آموزش برنامه نویسی با بامامو</h3>
                <p style="text-align: justify;">یادگیری برنامه‌نویسی آرزو نیست، فقط نیاز هست، تلاش و تمرین داشته باشید، بقیه‌اش با بامامو</p>
                <!-- <img src="image/backgrounds.jpg" class="caption-back d-none d-lg-flex" alt=""> --> 

                <!-- SVG  -->
                    <div class="caption-back-2 d-none d-lg-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500"><defs><clipPath id="freepik--clip-path--inject-3"><path d="M460.43,106.79v146a6.7,6.7,0,0,1-6.7,6.7H171a6.71,6.71,0,0,1-6.71-6.7v-146a6.71,6.71,0,0,1,6.71-6.7H453.73A6.7,6.7,0,0,1,460.43,106.79Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-2--inject-3"><path d="M261.12,192v-6.37l-4.78-.41a13.64,13.64,0,0,0-1.18-2.87l3.08-3.66-4.51-4.51-3.66,3.08a13.64,13.64,0,0,0-2.87-1.18l-.41-4.77h-6.37L240,176.1a13.78,13.78,0,0,0-2.86,1.18l-3.66-3.08L229,178.71l3.08,3.66a13.64,13.64,0,0,0-1.18,2.87l-4.78.41V192l4.78.42a13.78,13.78,0,0,0,1.18,2.86L229,199l4.51,4.51,3.66-3.08a13.26,13.26,0,0,0,2.86,1.18l.42,4.78h6.37l.41-4.78a13.13,13.13,0,0,0,2.87-1.18l3.66,3.08,4.51-4.51-3.08-3.66a13.78,13.78,0,0,0,1.18-2.86Zm-17.52,4.23a7.41,7.41,0,1,1,7.41-7.41A7.41,7.41,0,0,1,243.6,196.25Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-3--inject-3"><path d="M229.92,206.88v-4.54l-3.4-.29a9.13,9.13,0,0,0-.84-2l2.2-2.61-3.21-3.21-2.61,2.2a9.13,9.13,0,0,0-2-.84l-.29-3.4h-4.54l-.29,3.4a9.13,9.13,0,0,0-2,.84l-2.6-2.2-3.21,3.21,2.19,2.61a9.13,9.13,0,0,0-.84,2l-3.4.29v4.54l3.4.29a9.13,9.13,0,0,0,.84,2l-2.19,2.6,3.21,3.21,2.6-2.19a9.13,9.13,0,0,0,2,.84l.29,3.4h4.54l.29-3.4a9.13,9.13,0,0,0,2-.84l2.61,2.19,3.21-3.21-2.2-2.6a9.13,9.13,0,0,0,.84-2Zm-12.46,3a5.27,5.27,0,1,1,5.27-5.27A5.27,5.27,0,0,1,217.46,209.88Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-4--inject-3"><path d="M254,281.64c2.05-2.89,15.55,5.15,13.89,10.86s-7.06,5.09-10.22,2.06S251.81,284.73,254,281.64Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-5--inject-3"><path d="M255.61,274.57l-7.6,2.52c-.81.21-2.4-1.13-2.33-2l2.26-26.58a2.54,2.54,0,0,1,1.89-2.24l8.43-1.83c.8-.21,2.83.75,2.76,1.58l-3.51,26.27A2.55,2.55,0,0,1,255.61,274.57Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-6--inject-3"><path d="M202.55,272c10,.15,33,36,33,36L250,290l4-8.34s2,15,13.89,10.86c0,0-10.47,39.38-22.22,44.13S201.34,308,201.34,308Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-7--inject-3"><path d="M206.62,295c.4,7.28.57,14.84.86,20.48.72,13.63,9.84,53.47,9.84,53.47s10,6,10.5,17-60.61,42-77,33.16-14.19-34.52-14.19-34.52-24.26-98-14.33-105.88,13.28-6.9,38.7-10.42S202.55,272,202.55,272a10.44,10.44,0,0,1,2.91,5.13" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-8--inject-3"><path d="M230.21,437.09,210,453a231.08,231.08,0,0,1-29-4.33h0c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18,1.57,0,3.18.15,4.81.32,13.47,1.45,30.58-6,30.58-6Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-9--inject-3"><path d="M211.38,443.34c3.64.59-.36,8.05-5.3,5.78S207.73,442.75,211.38,443.34Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-10--inject-3"><path d="M181,448.61c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18C177.8,431,186,438.92,181,448.61Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath><clipPath id="freepik--clip-path-11--inject-3"><path d="M242.64,437.7l21.76,13.65A231.22,231.22,0,0,0,292.76,444h0c9.29-3.21,17.27-7.25,17.27-11.63,0-6.66-7.23-7.72-15.57-6.58-1.56.2-3.15.49-4.75.83-13.24,2.85-31-2.75-31-2.75Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></clipPath></defs><g id="freepik--background-simple--inject-3"><path d="M67.93,167.09s-27.88,72,11.3,144.5S199.11,422.39,263.7,455.14s131.66,16.8,163.53-36.84-11.84-91.93-11.9-168.42,11.45-96.74-30-161.36-143.06-78.93-219.9-31S67.93,167.09,67.93,167.09Z" style="fill:#fff;opacity:0.7000000000000001"/><path d="M112.6,91.45a97.3,97.3,0,0,1,13.23-7.7c33.32-15.94,74.22-10.69,106.25,7.72s56,48.5,73.43,81.06c8,14.88,15.09,30.86,27.9,41.86,16.5,14.18,38.79,17.39,58.46,25.11,71.52,28.09,72.34,131.06,9.65,169.51-24.71,15.16-55.23,19.73-83.62,21.85-39.34,2.93-79.39,1.43-117.38-9.19s-73.92-30.83-99.34-61C67.9,321.17,55.07,267.46,56.75,215.83,57.6,189.7,62,163.35,73,139.66,81.93,120.61,95.4,103.35,112.6,91.45Z" style="fill:#92E3A9"/><path d="M112.6,91.45a97.3,97.3,0,0,1,13.23-7.7c33.32-15.94,74.22-10.69,106.25,7.72s56,48.5,73.43,81.06c8,14.88,15.09,30.86,27.9,41.86,16.5,14.18,38.79,17.39,58.46,25.11,71.52,28.09,72.34,131.06,9.65,169.51-24.71,15.16-55.23,19.73-83.62,21.85-39.34,2.93-79.39,1.43-117.38-9.19s-73.92-30.83-99.34-61C67.9,321.17,55.07,267.46,56.75,215.83,57.6,189.7,62,163.35,73,139.66,81.93,120.61,95.4,103.35,112.6,91.45Z" style="fill:#fff;opacity:0.7000000000000001"/></g><g id="freepik--Clouds--inject-3"><path d="M135.36,134.92a20.14,20.14,0,0,0,.53-4.62,20.54,20.54,0,0,0-20.53-20.54,20.21,20.21,0,0,0-5.36.72,19.69,19.69,0,0,0-36.81,8.43,16.27,16.27,0,0,0-3-.29,16.09,16.09,0,0,0-16,14.29,9,9,0,0,0,.19,17.92H129.7a9,9,0,0,0,5.66-15.91Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="80.6" y1="166.06" x2="80.6" y2="186.81" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="80.6" y1="153.61" x2="80.6" y2="161.91" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="80.6" y1="145.86" x2="80.6" y2="150.3" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="76.68 184.38 80.59 189.23 84.51 184.38" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="93.97" y1="174.95" x2="93.97" y2="195.7" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="93.97" y1="162.5" x2="93.97" y2="170.8" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="93.97" y1="154.75" x2="93.97" y2="159.19" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="90.05 193.27 93.97 198.12 97.89 193.27" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="106.46" y1="157.51" x2="106.46" y2="178.26" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="106.46" y1="145.06" x2="106.46" y2="153.36" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="106.46" y1="137.31" x2="106.46" y2="141.75" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="102.54 175.83 106.46 180.68 110.38 175.83" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M305.12,275.09a20.54,20.54,0,0,1,25.37-24.44,19.69,19.69,0,0,1,36.81,8.44,16.27,16.27,0,0,1,3-.29,16.09,16.09,0,0,1,16,14.28,9,9,0,0,1-.19,17.92H310.79a9,9,0,0,1-5.67-15.91Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="356.69" y1="298.63" x2="356.69" y2="277.88" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="356.69" y1="311.08" x2="356.69" y2="302.78" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="356.69" y1="318.83" x2="356.69" y2="314.4" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="360.61 280.31 356.69 275.46 352.77 280.31" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="343.32" y1="289.74" x2="343.32" y2="269" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="343.32" y1="302.19" x2="343.32" y2="293.89" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="343.32" y1="309.95" x2="343.32" y2="305.51" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="347.24 271.42 343.32 266.57 339.4 271.42" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="330.82" y1="307.18" x2="330.82" y2="286.43" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="330.82" y1="319.63" x2="330.82" y2="311.33" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="330.82" y1="327.38" x2="330.82" y2="322.94" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="334.74 288.86 330.82 284.01 326.91 288.86" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/></g><g id="freepik--Floor--inject-3"><line x1="34.33" y1="445.48" x2="468.3" y2="445.48" style="fill:none;stroke:#263238;stroke-miterlimit:10"/></g><g id="freepik--Plant--inject-3"><path d="M362.79,384s17.24,1.36,18,14.07C380.75,398.07,363.29,406.11,362.79,384Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M396.89,387.15s9.63-13,25.19-6.34C422.08,380.81,412.58,396.55,396.89,387.15Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M420.76,346.05s2.77,25-20,18.15C400.73,364.2,408,345.78,420.76,346.05Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M392.77,332.1s18,9.73,4.77,24.48C397.54,356.58,384.89,346,392.77,332.1Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M370.58,354.49s19.61-2,19.61,16.17C390.19,370.66,370.58,371.43,370.58,354.49Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M389.07,424s-8.94-18.76-.36-37.86,11.48-35.2,7-46.54" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M377,359.36s11.75,4.67,15.75,16.78" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M414.56,356.07s-6.79,9.25-18.29,8.25" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M414.56,383.47s-18.81,5.42-26.28,3.65" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M368.41,389.72s8.41,9.23,16.86,9.09" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polygon points="367.46 409.12 406.93 409.12 402.8 445.19 371.6 445.19 367.46 409.12" style="fill:#263238"/><rect x="365.77" y="408.32" width="42.86" height="5.09" rx="0.99" style="fill:#263238"/><line x1="370.58" y1="413.41" x2="394.35" y2="413.41" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><line x1="398.84" y1="413.41" x2="402.41" y2="413.41" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/></g><g id="freepik--Interface--inject-3"><path d="M460.43,106.79v146a6.7,6.7,0,0,1-6.7,6.7H171a6.71,6.71,0,0,1-6.71-6.7v-146a6.71,6.71,0,0,1,6.71-6.7H453.73A6.7,6.7,0,0,1,460.43,106.79Z" style="fill:#fff"/><g style="clip-path:url(#freepik--clip-path--inject-3)"><path d="M460.43,114.55V252.82a6.7,6.7,0,0,1-6.7,6.7H275.84v-145Z" style="fill:#92E3A9;opacity:0.2"/></g><path d="M460.43,106.79v146a6.7,6.7,0,0,1-6.7,6.7H171a6.71,6.71,0,0,1-6.71-6.7v-146a6.71,6.71,0,0,1,6.71-6.7H453.73A6.7,6.7,0,0,1,460.43,106.79Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M435.66,173.63H398.87a7.43,7.43,0,0,0-7.43,7.43h0a7.43,7.43,0,0,0,7.43,7.42h36.79a7.42,7.42,0,0,0,7.43-7.42h0A7.42,7.42,0,0,0,435.66,173.63Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M460.43,106.79v13.68H164.27V106.79a6.71,6.71,0,0,1,6.71-6.7H453.73A6.7,6.7,0,0,1,460.43,106.79Z" style="fill:#999;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><circle cx="176.8" cy="109.93" r="4.62" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><circle cx="189.3" cy="109.93" r="4.62" style="fill:#757575;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><circle cx="201.8" cy="109.93" r="4.62" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><line x1="275.84" y1="120.47" x2="275.84" y2="259.65" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M450.35,114.55H385.6a4.62,4.62,0,0,1-4.61-4.62h0a4.62,4.62,0,0,1,4.61-4.61h64.75a4.62,4.62,0,0,1,4.62,4.61h0A4.62,4.62,0,0,1,450.35,114.55Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M438.54,163.34H298.42a4.55,4.55,0,0,1-4.55-4.55h0a4.55,4.55,0,0,1,4.55-4.55H438.54a4.55,4.55,0,0,1,4.55,4.55h0A4.55,4.55,0,0,1,438.54,163.34Z" style="fill:#bfbfbf;stroke:#263238;stroke-miterlimit:10"/><path d="M373.54,163.34H298.42a4.55,4.55,0,0,1-4.55-4.55h0a4.55,4.55,0,0,1,4.55-4.55h75.12a4.55,4.55,0,0,1,4.55,4.55h0A4.55,4.55,0,0,1,373.54,163.34Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><rect x="298.01" y="227.96" width="6.17" height="6.17" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="299.89 230.62 300.8 231.86 302.31 229.71" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><rect x="313.87" y="229.25" width="45.62" height="3.59" rx="1.8" style="opacity:0.30000000000000004"/><path d="M206.82,234.73h0l1-6.85h1.21l-1.3,8.39h-2l-1.3-8.39h1.33Z" style="fill:#263238"/><path d="M211,231.42h1.81v1.2H211v2.46h2.28v1.19h-3.6v-8.39h3.6v1.2H211Z" style="fill:#263238"/><path d="M216.84,236.27a2.57,2.57,0,0,1-.12-1v-1.32c0-.77-.27-1.06-.87-1.06h-.45v3.41h-1.32v-8.39h2c1.37,0,2,.64,2,1.93v.66a1.65,1.65,0,0,1-.87,1.69v0c.66.27.88.89.88,1.77v1.3a2.48,2.48,0,0,0,.14,1Zm-1.44-7.19v2.58h.51c.5,0,.8-.22.8-.89v-.83c0-.6-.21-.86-.68-.86Z" style="fill:#263238"/><path d="M220.18,235v1.27H218.9V235Z" style="fill:#263238"/><path d="M224.93,229c-.42,0-.69.23-.69.83v.9H223v-.82c0-1.34.67-2.11,2-2.11s2,.77,2,2.11a4.63,4.63,0,0,1-1.63,3.33c-.78.84-1,1.23-1,1.68a1.09,1.09,0,0,0,0,.18h2.5v1.19H223v-1a3.63,3.63,0,0,1,1.31-2.67,3.54,3.54,0,0,0,1.3-2.63C225.61,229.19,225.35,229,224.93,229Z" style="fill:#263238"/><path d="M229,235v1.27h-1.27V235Z" style="fill:#263238"/><path d="M229.87,229.89a2,2,0,1,1,4,0v4.37a2,2,0,1,1-4,0Zm1.32,4.45c0,.6.27.83.68.83s.69-.23.69-.83v-4.53c0-.6-.27-.83-.69-.83s-.68.23-.68.83Z" style="fill:#263238"/><path d="M235.92,233.56v.78c0,.6.26.82.68.82s.69-.22.69-.82V232.5c0-.6-.27-.83-.69-.83s-.68.23-.68.83v.25h-1.25l.24-4.87h3.48v1.2h-2.3l-.11,2h0a1.25,1.25,0,0,1,1.14-.61c1,0,1.47.68,1.47,1.92v1.87a1.84,1.84,0,0,1-2,2.11c-1.3,0-2-.77-2-2.11v-.7Z" style="fill:#263238"/><path d="M200,202.8a31.52,31.52,0,0,1-7.31-10.56" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M228.81,149.36A31.51,31.51,0,0,1,251,168.63" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M231.47,172v-9l-6.72-.58a18.2,18.2,0,0,0-1.66-4l4.34-5.15L221.09,147l-5.15,4.33a18.91,18.91,0,0,0-4-1.66l-.58-6.71h-9l-.58,6.71a18.49,18.49,0,0,0-4,1.66L192.62,147l-6.33,6.34,4.33,5.15a18.7,18.7,0,0,0-1.66,4l-6.71.58v9l6.71.58a18.7,18.7,0,0,0,1.66,4l-4.33,5.15,6.33,6.34,5.16-4.33a18.49,18.49,0,0,0,4,1.66l.58,6.71h9l.58-6.71a18.91,18.91,0,0,0,4-1.66l5.15,4.33,6.34-6.34-4.34-5.15a18.2,18.2,0,0,0,1.66-4ZM206.86,178a10.41,10.41,0,1,1,10.41-10.41A10.42,10.42,0,0,1,206.86,178Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M261.12,192v-6.37l-4.78-.41a13.64,13.64,0,0,0-1.18-2.87l3.08-3.66-4.51-4.51-3.66,3.08a13.64,13.64,0,0,0-2.87-1.18l-.41-4.77h-6.37L240,176.1a13.78,13.78,0,0,0-2.86,1.18l-3.66-3.08L229,178.71l3.08,3.66a13.64,13.64,0,0,0-1.18,2.87l-4.78.41V192l4.78.42a13.78,13.78,0,0,0,1.18,2.86L229,199l4.51,4.51,3.66-3.08a13.26,13.26,0,0,0,2.86,1.18l.42,4.78h6.37l.41-4.78a13.13,13.13,0,0,0,2.87-1.18l3.66,3.08,4.51-4.51-3.08-3.66a13.78,13.78,0,0,0,1.18-2.86Zm-17.52,4.23a7.41,7.41,0,1,1,7.41-7.41A7.41,7.41,0,0,1,243.6,196.25Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-2--inject-3)"><path d="M261.12,192v-6.37l-4.78-.41a13.64,13.64,0,0,0-1.18-2.87l3.08-3.66-4.51-4.51-3.66,3.08a13.64,13.64,0,0,0-2.87-1.18l-.41-4.77h-6.37L240,176.1a13.78,13.78,0,0,0-2.86,1.18l-3.66-3.08L229,178.71l3.08,3.66a13.64,13.64,0,0,0-1.18,2.87l-4.78.41V192l4.78.42a13.78,13.78,0,0,0,1.18,2.86L229,199l4.51,4.51,3.66-3.08a13.26,13.26,0,0,0,2.86,1.18l.42,4.78h6.37l.41-4.78a13.13,13.13,0,0,0,2.87-1.18l3.66,3.08,4.51-4.51-3.08-3.66a13.78,13.78,0,0,0,1.18-2.86Zm-17.52,4.23a7.41,7.41,0,1,1,7.41-7.41A7.41,7.41,0,0,1,243.6,196.25Z" style="fill:#fff;opacity:0.30000000000000004"/></g><path d="M261.12,192v-6.37l-4.78-.41a13.64,13.64,0,0,0-1.18-2.87l3.08-3.66-4.51-4.51-3.66,3.08a13.64,13.64,0,0,0-2.87-1.18l-.41-4.77h-6.37L240,176.1a13.78,13.78,0,0,0-2.86,1.18l-3.66-3.08L229,178.71l3.08,3.66a13.64,13.64,0,0,0-1.18,2.87l-4.78.41V192l4.78.42a13.78,13.78,0,0,0,1.18,2.86L229,199l4.51,4.51,3.66-3.08a13.26,13.26,0,0,0,2.86,1.18l.42,4.78h6.37l.41-4.78a13.13,13.13,0,0,0,2.87-1.18l3.66,3.08,4.51-4.51-3.08-3.66a13.78,13.78,0,0,0,1.18-2.86Zm-17.52,4.23a7.41,7.41,0,1,1,7.41-7.41A7.41,7.41,0,0,1,243.6,196.25Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M229.92,206.88v-4.54l-3.4-.29a9.13,9.13,0,0,0-.84-2l2.2-2.61-3.21-3.21-2.61,2.2a9.13,9.13,0,0,0-2-.84l-.29-3.4h-4.54l-.29,3.4a9.13,9.13,0,0,0-2,.84l-2.6-2.2-3.21,3.21,2.19,2.61a9.13,9.13,0,0,0-.84,2l-3.4.29v4.54l3.4.29a9.13,9.13,0,0,0,.84,2l-2.19,2.6,3.21,3.21,2.6-2.19a9.13,9.13,0,0,0,2,.84l.29,3.4h4.54l.29-3.4a9.13,9.13,0,0,0,2-.84l2.61,2.19,3.21-3.21-2.2-2.6a9.13,9.13,0,0,0,.84-2Zm-12.46,3a5.27,5.27,0,1,1,5.27-5.27A5.27,5.27,0,0,1,217.46,209.88Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-3--inject-3)"><path d="M229.92,206.88v-4.54l-3.4-.29a9.13,9.13,0,0,0-.84-2l2.2-2.61-3.21-3.21-2.61,2.2a9.13,9.13,0,0,0-2-.84l-.29-3.4h-4.54l-.29,3.4a9.13,9.13,0,0,0-2,.84l-2.6-2.2-3.21,3.21,2.19,2.61a9.13,9.13,0,0,0-.84,2l-3.4.29v4.54l3.4.29a9.13,9.13,0,0,0,.84,2l-2.19,2.6,3.21,3.21,2.6-2.19a9.13,9.13,0,0,0,2,.84l.29,3.4h4.54l.29-3.4a9.13,9.13,0,0,0,2-.84l2.61,2.19,3.21-3.21-2.2-2.6a9.13,9.13,0,0,0,.84-2Zm-12.46,3a5.27,5.27,0,1,1,5.27-5.27A5.27,5.27,0,0,1,217.46,209.88Z" style="fill:#fff;opacity:0.5"/></g><path d="M229.92,206.88v-4.54l-3.4-.29a9.13,9.13,0,0,0-.84-2l2.2-2.61-3.21-3.21-2.61,2.2a9.13,9.13,0,0,0-2-.84l-.29-3.4h-4.54l-.29,3.4a9.13,9.13,0,0,0-2,.84l-2.6-2.2-3.21,3.21,2.19,2.61a9.13,9.13,0,0,0-.84,2l-3.4.29v4.54l3.4.29a9.13,9.13,0,0,0,.84,2l-2.19,2.6,3.21,3.21,2.6-2.19a9.13,9.13,0,0,0,2,.84l.29,3.4h4.54l.29-3.4a9.13,9.13,0,0,0,2-.84l2.61,2.19,3.21-3.21-2.2-2.6a9.13,9.13,0,0,0,.84-2Zm-12.46,3a5.27,5.27,0,1,1,5.27-5.27A5.27,5.27,0,0,1,217.46,209.88Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="248.61 167.54 251.02 168.63 251.97 166.46" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><polyline points="195.06 193.24 192.64 192.15 191.69 194.33" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M295.19,143v4.91c0,.46.2.62.52.62s.52-.16.52-.62V143h.95v4.85a1.4,1.4,0,0,1-1.5,1.6c-1,0-1.49-.58-1.49-1.6V143Z" style="fill:#263238"/><path d="M300.82,144.56v.83c0,1-.49,1.58-1.49,1.58h-.47v2.39h-1V143h1.47C300.33,143,300.82,143.55,300.82,144.56Zm-2-.66v2.16h.47c.32,0,.49-.15.49-.6v-1c0-.45-.17-.6-.49-.6Z" style="fill:#263238"/><path d="M304.4,149.36h-1l-.17-1.16H302l-.17,1.16h-.92l1-6.37h1.46Zm-2.28-2h1l-.47-3.22h0Z" style="fill:#263238"/><path d="M304.86,143h1.59c1,0,1.49.56,1.49,1.57v3.22c0,1-.49,1.58-1.49,1.58h-1.59Zm1,.91v4.55h.57c.32,0,.51-.17.51-.62v-3.31c0-.46-.19-.62-.51-.62Z" style="fill:#263238"/><path d="M311.8,149.36h-1l-.17-1.16h-1.23l-.17,1.16h-.92l1-6.37h1.46Zm-2.28-2h1l-.47-3.22h0Z" style="fill:#263238"/><path d="M311.63,143h3.09v.91h-1.05v5.46h-1V143.9h-1Z" style="fill:#263238"/><path d="M315.15,143h1v6.37h-1Z" style="fill:#263238"/><path d="M317.79,144.75h0v4.61h-.9V143h1.26l1,3.81h0V143H320v6.37h-1Z" style="fill:#263238"/><path d="M322.26,145.81h1.4v2c0,1-.51,1.6-1.49,1.6s-1.49-.58-1.49-1.6v-3.31c0-1,.51-1.6,1.49-1.6s1.49.58,1.49,1.6v.62h-1v-.68c0-.46-.2-.63-.51-.63s-.52.17-.52.63v3.43c0,.46.2.62.52.62s.51-.16.51-.62v-1.17h-.45Z" style="fill:#263238"/><polygon points="452.09 192.57 435.47 180.72 440.2 200.57 443.61 195.51 446.75 200.18 449.26 198.49 446.12 193.82 452.09 192.57" style="fill:#263238"/></g><g id="freepik--Character--inject-3"><path d="M254,281.64c2.05-2.89,15.55,5.15,13.89,10.86s-7.06,5.09-10.22,2.06S251.81,284.73,254,281.64Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-4--inject-3)"><path d="M254,281.64c2.05-2.89,15.55,5.15,13.89,10.86s-7.06,5.09-10.22,2.06S251.81,284.73,254,281.64Z" style="fill-opacity:0.7000000000000001;opacity:0.30000000000000004"/></g><path d="M254,281.64c2.05-2.89,15.55,5.15,13.89,10.86s-7.06,5.09-10.22,2.06S251.81,284.73,254,281.64Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M260.41,259.47s2,0,5.32,7.71a18.32,18.32,0,0,1,1,10.64l-4.87,23.47L250,294.16l6.89-17.22S253.28,265.81,260.41,259.47Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M255.61,274.57l-7.6,2.52c-.81.21-2.4-1.13-2.33-2l2.26-26.58a2.54,2.54,0,0,1,1.89-2.24l8.43-1.83c.8-.21,2.83.75,2.76,1.58l-3.51,26.27A2.55,2.55,0,0,1,255.61,274.57Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-5--inject-3)"><path d="M255.61,274.57l-7.6,2.52c-.81.21-2.4-1.13-2.33-2l2.26-26.58a2.54,2.54,0,0,1,1.89-2.24l8.43-1.83c.8-.21,2.83.75,2.76,1.58l-3.51,26.27A2.55,2.55,0,0,1,255.61,274.57Z" style="fill-opacity:0.7000000000000001;opacity:0.30000000000000004"/></g><path d="M255.61,274.57l-7.6,2.52c-.81.21-2.4-1.13-2.33-2l2.26-26.58a2.54,2.54,0,0,1,1.89-2.24l8.43-1.83c.8-.21,2.83.75,2.76,1.58l-3.51,26.27A2.55,2.55,0,0,1,255.61,274.57Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M256.86,275.23l-8.42,1.83a1.21,1.21,0,0,1-1.5-1.27l2.25-26.59a2.54,2.54,0,0,1,1.9-2.24l8.42-1.83a1.21,1.21,0,0,1,1.5,1.27L258.76,273A2.54,2.54,0,0,1,256.86,275.23Z" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M252.19,254.12l-1.36.3a.2.2,0,0,1-.24-.21l.37-4.28a.41.41,0,0,1,.3-.37l1.36-.29a.19.19,0,0,1,.24.2l-.36,4.29A.42.42,0,0,1,252.19,254.12Z" style="fill-opacity:0.7000000000000001;opacity:0.30000000000000004"/><path d="M264,267.45c.33-3.73-3.06-9.32-5.32-9.32s-9.13,5.29-9.13,5.29c-2.65,1.93-1.34,3.76-1.34,3.76-1.56,1-2,2.43-1.28,3.08s3,0,3,0-2.28,1.67-1.71,2.48c1.34,1.94,5.76-.61,5.76-.61s-2.56,1.69-2.42,2c1,2.11,5.16-.35,5.16-.35l2.94,1.51a2.51,2.51,0,0,0,2.68,2.52" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M248.25,267.18s6.43-4.16,7.25-4.27,3.79-.76,3.79-.76" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M250,270.26s5.23-2.7,6.19-2.7a35.82,35.82,0,0,0,4.26-.73" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M254,272.13a12.64,12.64,0,0,1,1.93-1.14,25.76,25.76,0,0,1,3.75,0" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M202.55,272c10,.15,33,36,33,36L250,290l4-8.34s2,15,13.89,10.86c0,0-10.47,39.38-22.22,44.13S201.34,308,201.34,308Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-6--inject-3)"><path d="M203.37,310c4.13,4.05,13.91,13.31,23.44,19.88-2.8-9.37-10.47-19.35-10.47-19.35-2.38-.79-5.74-7.92-5.74-7.92-1.58.6-3.82-4.35-3.82-4.35C204.94,299.82,203.91,304.43,203.37,310Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/><path d="M234.86,317.15a22.72,22.72,0,0,1,.83-9.4l-.17.22s-1.56-2.43-4-6C230.83,306.61,230.5,314.39,234.86,317.15Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M202.55,272c10,.15,33,36,33,36L250,290l4-8.34s2,15,13.89,10.86c0,0-10.47,39.38-22.22,44.13S201.34,308,201.34,308Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M98.91,426.25S92.58,439,92.58,442s-1.06,4.35-6.6,4.35-19.25.12-21.36-.86H51.8c-3,0-4.22-2.88-2.38-2.49s15.45-3.37,19.15-4.89,9.78-3.32,13.06-6.49,7.25-15,7.25-15Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M64.62,445.48c0-3.72,4-1.94,10-3.49,3.87-1,4.28-2.35,4.28-2.35" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M206.62,295c.4,7.28.57,14.84.86,20.48.72,13.63,9.84,53.47,9.84,53.47s10,6,10.5,17-60.61,42-77,33.16-14.19-34.52-14.19-34.52-24.26-98-14.33-105.88,13.28-6.9,38.7-10.42S202.55,272,202.55,272a10.44,10.44,0,0,1,2.91,5.13" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-7--inject-3)"><path d="M136.62,384.53s-2.21,25.68,14.19,34.52,77.54-22.17,77-33.16-10.49-17-10.49-17-.9-3.95-2.17-9.78c-8.67,5.62-28.43,17.28-41.29,16,0,0,21.41,7.59,35.1,1.07s-5.69,8.58-9.64,8.34-33.43-5.57-38.77-2.8-17.21,23.14-17.21,23.14-7.2-16.18-5.6-26.11c0,0,.21-30.92-3.23-49,0,0,8.23-14.2-.87-25.23-3.36-4.07-7,4.31-10.32,16.5C128.22,350.58,136.62,384.53,136.62,384.53Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M206.62,295c.4,7.28.57,14.84.86,20.48.72,13.63,9.84,53.47,9.84,53.47s10,6,10.5,17-60.61,42-77,33.16-14.19-34.52-14.19-34.52-24.26-98-14.33-105.88,13.28-6.9,38.7-10.42S202.55,272,202.55,272a10.44,10.44,0,0,1,2.91,5.13" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M218.91,378.3c1.54-.2,5.71,2.44,5.71,2.44s67.44-17.32,77.58-11.82c20.35,11,9.5,32.77,5.28,39S241,443.64,219.39,444.2s-61.25-5.41-69-18.14.18-26.85,11-37.21c11-10.55,32.58-1.32,40-3.43C210.87,382.7,214.2,378.89,218.91,378.3Z" style="fill:#263238"/><path d="M162.5,437.55l-1,4.35s2.65,7.53,14.32,8.75,18.57,3.82,24.17,4.15a47.6,47.6,0,0,0,8.87-.14L210,453Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M230.21,437.09,210,453a231.08,231.08,0,0,1-29-4.33h0c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18,1.57,0,3.18.15,4.81.32,13.47,1.45,30.58-6,30.58-6Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-8--inject-3)"><path d="M162.63,438.71a62.12,62.12,0,0,1,11.24,5.53s18.77,9.66,47.61-.29l8.74-6.86L212.82,425s-17.11,7.44-30.58,6c-1.63-.17-3.24-.29-4.81-.32C169.08,430.42,162.05,432.2,162.63,438.71Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M230.21,437.09,210,453a231.08,231.08,0,0,1-29-4.33h0c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18,1.57,0,3.18.15,4.81.32,13.47,1.45,30.58-6,30.58-6Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M211.38,443.34c3.64.59-.36,8.05-5.3,5.78S207.73,442.75,211.38,443.34Z" style="fill:#fff"/><g style="clip-path:url(#freepik--clip-path-9--inject-3)"><path d="M204.54,447.92a77.73,77.73,0,0,0,7.85-1.37c.7-1.46.54-3-1-3.21C208.32,442.84,203.18,445.66,204.54,447.92Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M211.38,443.34c3.64.59-.36,8.05-5.3,5.78S207.73,442.75,211.38,443.34Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M181,448.61c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18C177.8,431,186,438.92,181,448.61Z" style="fill:#fff"/><g style="clip-path:url(#freepik--clip-path-10--inject-3)"><path d="M162.63,438.71a62.12,62.12,0,0,1,11.24,5.53,37.82,37.82,0,0,0,7.9,2.64c3.23-8.88-4-15.87-4.34-16.2C169.08,430.42,162.05,432.2,162.63,438.71Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M181,448.61c-9.57-2.22-17.93-5.4-18.39-9.75-.7-6.63,6.37-8.44,14.79-8.18C177.8,431,186,438.92,181,448.61Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M187.86,440.38h-.06a1,1,0,0,1-1-.95c-.2-4.18-3.42-7.57-3.45-7.61a1,1,0,0,1,1.44-1.38c.16.16,3.77,3.95,4,8.89A1,1,0,0,1,187.86,440.38Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M191.86,440.62h-.08a1,1,0,0,1-1-1c-.09-4.22-3-7.87-3.06-7.91a1,1,0,0,1,1.54-1.27,16.64,16.64,0,0,1,3.52,9.14A1,1,0,0,1,191.86,440.62Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M196.65,440.12h0a1,1,0,0,1-1.08-.91c-.31-3.5-3.29-8-3.32-8a1,1,0,1,1,1.66-1.11c.14.2,3.3,4.94,3.65,9A1,1,0,0,1,196.65,440.12Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M201.17,439.64a.83.83,0,0,1-.27,0,1,1,0,0,1-.82-1.15c.71-4.25-3.23-7.89-3.27-7.92a1,1,0,0,1,1.34-1.49c.19.18,4.8,4.4,3.91,9.74A1,1,0,0,1,201.17,439.64Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M206.09,438.46a1.22,1.22,0,0,1-.33,0,1,1,0,0,1-.75-1.2c.87-3.79-2.86-8.07-2.9-8.11a1,1,0,1,1,1.49-1.33c.19.21,4.46,5.09,3.36,9.89A1,1,0,0,1,206.09,438.46Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M310,431l1.45,4.22s-1.85,7.77-13.32,10.22-18.07,5.74-23.61,6.66a47,47,0,0,1-8.83.79l-1.32-1.58Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M242.64,437.7l21.76,13.65A231.22,231.22,0,0,0,292.76,444h0c9.29-3.21,17.27-7.25,17.27-11.63,0-6.66-7.23-7.72-15.57-6.58-1.56.2-3.15.49-4.75.83-13.24,2.85-31-2.75-31-2.75Z" style="fill:#92E3A9"/><g style="clip-path:url(#freepik--clip-path-11--inject-3)"><path d="M242.64,437.7l12.8,8a51.6,51.6,0,0,0,26-18.31,86.41,86.41,0,0,1-22.76-3.56Z" style="fill-opacity:0.7000000000000001;opacity:0.2"/></g><path d="M242.64,437.7l21.76,13.65A231.22,231.22,0,0,0,292.76,444h0c9.29-3.21,17.27-7.25,17.27-11.63,0-6.66-7.23-7.72-15.57-6.58-1.56.2-3.15.49-4.75.83-13.24,2.85-31-2.75-31-2.75Z" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M292.76,444c9.29-3.21,17.27-7.25,17.27-11.63,0-6.66-7.23-7.72-15.57-6.58C294.13,426.17,286.85,434.87,292.76,444Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M285.1,436.53h.06a1,1,0,0,0,.94-1.06c-.24-4.17,2.6-7.89,2.63-7.92a1,1,0,1,0-1.58-1.23c-.14.17-3.33,4.33-3,9.26A1,1,0,0,0,285.1,436.53Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M281.15,437.19h.08a1,1,0,0,0,.91-1.08,14.73,14.73,0,0,1,2.22-8.18,1,1,0,0,0-.29-1.39,1,1,0,0,0-1.38.29,16.59,16.59,0,0,0-2.54,9.45A1,1,0,0,0,281.15,437.19Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M276.33,437.19h0a1,1,0,0,0,1-1c-.06-3.52,2.43-8.29,2.46-8.34a1,1,0,1,0-1.77-.93c-.11.21-2.76,5.27-2.69,9.3A1,1,0,0,0,276.33,437.19Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M271.78,437.19a1.26,1.26,0,0,0,.27,0,1,1,0,0,0,.7-1.23c-1.15-4.15,2.39-8.18,2.42-8.22a1,1,0,0,0-.07-1.41,1,1,0,0,0-1.42.07c-.17.2-4.31,4.88-2.86,10.09A1,1,0,0,0,271.78,437.19Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M266.77,436.53a1,1,0,0,0,.33-.06,1,1,0,0,0,.62-1.27c-1.26-3.67,2-8.32,2-8.37a1,1,0,0,0-1.62-1.16c-.16.23-3.9,5.53-2.3,10.18A1,1,0,0,0,266.77,436.53Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M262,441.94c-3.56,1,1.2,8,5.87,5.19S265.59,441,262,441.94Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M167,383.57c13.18-2.31,48.19,16.11,69.64,28.38a44.16,44.16,0,0,0,6-4c4.94-4.4,23.79-28.63,36.79-34.17l23.74,31.06c-5.35,7.49-21.18,15.76-37,22.58a74.63,74.63,0,0,1-9.9,12.93c-9.71,10-13.67,4.39-13.67,4.39s-6.14-.69-15.2-1.93a4.29,4.29,0,0,1-4.58,2.58c-1.18-.19-3.45-1.87-6-4.1-22.88-3.44-53.92-9.18-62.31-15.94C140.84,414.33,155.31,385.61,167,383.57Z" style="fill:#263238"/><path d="M131.62,295c2.48,8,2.68,19.46.65,28.4,0,0-8.88,39.28-10,47.83S106.16,413,105.37,423.86l-6.91,9.94s-10.1-.76-16.83-8.42l4.75-10.53s4.35-16.19,5.93-18.44,6.78-32.79,8.53-37.78,12.27-71.5,21.45-80c0,0,2.45-.2,3.45,1.73" style="fill:#92E3A9;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M265.12,421.45c-4.68-1.94-11.4,0-11.4,0s-22.07-9.61-37.19-18.76-36.79-16-36.79-16c-8.31-.59-12.26-.4-16.22,4" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M153.43,416.61s-.11,6.7,9.39,11.35" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M258.27,388.65s-15,10.85-18,18a61.48,61.48,0,0,0-8.52,4.39" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M239.18,397.67a17.15,17.15,0,0,0-.53,9.7" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M242.64,390.63a26.75,26.75,0,0,0-2.15,3.75" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M221.28,389.64s-5,6.7-6.27,12.15" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M193.33,430.19a43.44,43.44,0,0,1-5.57-.68" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M240.4,425.38a267.68,267.68,0,0,1-43.13,5" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round"/><path d="M235.52,308a11.56,11.56,0,0,0,0,10.66" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M156.26,278c6.9,4.28,16.58,7.9,23.82,2.34" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M150.81,274.12c.94.8,1.92,1.54,2.92,2.25" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M210.16,300.8c-.41,3.81-.76,8.35-2.81,11.69" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M210.6,295.29c0,1-.13,2.07-.21,3.11" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M214.32,312.49s-2.39,2.53-6.91,1.37" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M137.41,302.6s-.3,16.42-5.79,23.64" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M168.66,374l-3.9-.93" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M217.32,368.92c-5.61.08-10.61,4.08-15.61,8.08-10,6-20-2-30.4-2.45" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M139.78,365.76c-.87,6.29-1.83,12.57-3.16,18.77" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M140.77,358c-.17,1.52-.36,3-.56,4.55" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M195.62,336.11c-6.31,10.72-15.37,22.95-28.14,26" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M202.49,322.38a101.28,101.28,0,0,1-5.35,11.05" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M120.68,316.28C115.89,328,111,342,102.4,351.58" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M124,308c-.66,1.75-1.35,3.5-2,5.25" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M108.53,386.43s-11.47,9.43-16.22,10" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M89.23,426.47c-2.17-1.19-4.73-2.69-5.83-5" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M97.13,429.94c-1.72-.6-3.41-1.29-5.07-2.05" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M255.09,297.46a8.8,8.8,0,0,0,4.6,2.51" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M250,290a28.52,28.52,0,0,0,2.83,4.83" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M152.29,269.81s7,10.09,19,8.71c6.62-.77,5.94-5.87,5.94-5.87a4.88,4.88,0,0,1-2-2.56c-.71-1.81-1-4.76.67-9.37,0-.13.09-.27.14-.4,1.88-5-20.77-12.07-20.77-12.07S158,261.31,152.29,269.81Z" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M163.26,257.24s4.2,10.47,12,12.85c-.71-1.81-1-4.76.67-9.37Z" style="fill:#263238"/><path d="M161.19,254.78c-.53,4.49,10.91,11.28,17.61,11.26,3.06,0,7.3-5.91,9.1-14.62.9-4.4-1.79-8.71.39-14.84,1.86-5.24-1.78-20.87-17.21-22.15-22.05-1.83-24.62,21.81-14.85,37.76" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M188.74,235.4a5.18,5.18,0,0,0-5.39-2" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M176,233.28s-4.55-.46-7.32,2.12" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M182.16,236.38c-.4,4.55,4.75,12.17,3.46,13.26s-4.35-.4-5.54-1" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><ellipse cx="174.15" cy="240.39" rx="0.89" ry="1.24" style="fill:#263238"/><ellipse cx="184.94" cy="240.39" rx="0.89" ry="1.24" style="fill:#263238"/><path d="M182.06,254.48s-5.24.7-7.91-2.07" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M175,253.15a4,4,0,0,0,3.06,3.21c2.77.69,2.67-1.8,2.67-1.8" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M167.22,224.52s24.53,6.72,27.1-3.66c0,0-4.46.53-9.38-4.85-6-6.6-15.74-8.31-23.95-5.34s-7.71,7.27-7.71,7.27-4.85.64-7,6.48,1.26,26.47,9.49,30.85l2.28-2.86s-.91-5.89,3-10.29l2.18.56s-2.37-5.1.1-7.88A14.6,14.6,0,0,0,167.22,224.52Z" style="fill:#263238"/><path d="M161,241.63s-2.47-7.12-5.63-5.25.29,15.53,5.63,12.47" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"/><path d="M161,218.74s15.25,2.57,19.78-3.56" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;opacity:0.30000000000000004"/><path d="M170.88,222.3s10.6,3.56,17.86,0" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;opacity:0.30000000000000004"/><path d="M157.57,223.88s-.15,8.79-8.26,11.52" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;opacity:0.30000000000000004"/></g></svg>
                    </div>
                <!-- SVG  -->
            </div>
            </div>
            
        </div>
    </div>
    <!-- Image Content -->

    <!-- website posts -->
    <div class="container">
        <div class="row mt-3 top-post-website">
            <div>
                <p class="hero-header">جدیدترین دوره‌ها</p>
                <hr style="border-top: 3px solid rgba(0, 0, 0, .1); margin-top: -17px;">
                <a href="" class="btn btn-dark moredore"
                style="float: left; margin-top: -34px; color: #fff; font-size: 12px;">مشاهده همه دوره ها</a>
            </div>
            <hr style="border-top: 3px solid rgba(0, 0, 0, 0.1); margin-top: -17px; margin-bottom: -0;">
        </div>
        
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span>آموزش انگولار</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="time-item">۰۴:۳۴:۴۲
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                            </svg>
                            </span>

                            <span class="shop-item">
                                ۱۲۵۰۰۰ تومان
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- website posts -->

    <!-- slider and info -->
    <div style="background-image: url(image/810.png);">
        <div class="container">
            <div class="bor-bot" style="padding-top: 5px;">
                <p class="hero-header" style="border-bottom: 5px solid #fd7e14; color:#fff;">اطلاعیه ها</p>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-4" id="info-section">
                    <div class="info-box">
                        <br><br><br>
                        <div class="info-text" style="margin-top: -69px;">
                            <span> ثبت نام دوره ی آموزش برنامه نویسی ربات تلگرام با زبان php آغاز شد</span>
                            <span class="info-date">۹۹/۰۳/۲۰
                                <svg class="bi bi-calendar2-date-fill" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm-2 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-1zm7.336 9.04c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77C7.586 7.672 8.457 7 9.383 7c1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V7.91a12.6 12.6 0 0 1 1.313-.805h.632z" />
                                </svg>
                            </span>
                        </div>
                        <div class="info-text">
                            <span>آموزشگاه برنامه نویسان تاپ لرن در شهر اصفهان افتتاح شد. 30درصد تخفیف ویژه شرکت در دوره
                                های
                                حضوری </span>
                            <span class="info-date">۹۹/۰۳/۲۰
                                <svg class="bi bi-calendar2-date-fill" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm-2 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-1zm7.336 9.04c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77C7.586 7.672 8.457 7 9.383 7c1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V7.91a12.6 12.6 0 0 1 1.313-.805h.632z" />
                                </svg>
                            </span>
                        </div>
                        <div class="info-text">
                            <span>افتتاح صفحه اینستاگرام تاپ لرن ، با دنبال کردن ما در اینستاگرام از 40 درصد تخفیف
                                بهرمند
                                شوید</span>
                            <span class="info-date">۹۹/۰۳/۲۰
                                <svg class="bi bi-calendar2-date-fill" width="1em" height="1em" viewBox="0 0 16 16"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zm-2 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-1zm7.336 9.04c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77C7.586 7.672 8.457 7 9.383 7c1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V7.91a12.6 12.6 0 0 1 1.313-.805h.632z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="col-sm-8 col-md-8 col-lg-8">
                    <div id="myslide" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators" style="margin-bottom: -20px;">
                            <li data-target="#myslide" data-slide-to="0" class="active" style=" margin-right: -50px;">
                            </li>
                            <li data-target="#myslide" data-slide-to="1"></li>
                            <li data-target="#myslide" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="image/slid1.jpg" alt="">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="image/slid2.jpg" alt="">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="image/slider3.jpg" alt="">
                            </div>
                        </div>

                        <a href="#myslide" class="carousel-control-prev" data-slide="prev">
                            <span class="carousel-control-prev-icon" style="margin-top: 75px;"></span>
                        </a>


                        <a href="#myslide" class="carousel-control-next" data-slide="next">
                            <span class="carousel-control-next-icon" style="margin-top: 75px;"></span>
                        </a>

                    </div><br><br>
                </div>
            </div>
        </div>
    </div>
    <!-- slider and info -->

    <!-- website papers -->
    <div class="container">
        <div class="row mt-3 top-post-website">
            <div>
                <p class="hero-header">جدیدترین مقالات</p>
                <hr style="border-top: 3px solid rgba(0, 0, 0, .1); margin-top: -17px;">
                <a href="" class="btn btn-dark moredore"
                style="float: left; margin-top: -34px; color: #fff; font-size: 12px;">مشاهده   وبلاگ</a>
            </div>
            <hr style="border-top: 3px solid rgba(0, 0, 0, 0.1); margin-top: -17px; margin-bottom: -0;">
        </div>
        
        <div class="row mt-4">
            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span> چگونه از گیت هاب استفاده کنیم؟</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="view-item">۱۲۵۰
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </span>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span> چگونه از گیت هاب استفاده کنیم؟</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="view-item">۱۲۵۰
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </span>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span> چگونه از گیت هاب استفاده کنیم؟</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="view-item">۱۲۵۰
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </span>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <a href="">
                    <div class="image-item">
                        <img src="./image/angular-1.png" width="100%" alt="">
                    </div>
                    <div class="caption-item">
                        <div class="title-item">
                            <a href=""><span> چگونه از گیت هاب استفاده کنیم؟</span></a>
                        </div>

                        <div class="cap-item">
                            <p>آموزش انگولاردوره ای است که ما قصد داریم شما ره به شکل دقیق با جزئیات فریم ورک جاوااسکریپتی انگولار آشنا کنیم.</p>
                        </div>

                        <div class="like-item">
                            <span class="like-item2">۱۲
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                </svg>
                            </span>

                            <span class="view-item">۱۲۵۰
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </span>

                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <!-- website papers -->
    <br><br><br>
    <!-- Footer -->
    <footer>
        <div class="back-footer">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <h6 class="mt-3">درباره AGHP</h6>
                        <hr class="header-caption-footer">
                        <p>این سایت یکی از پرتلاش تزین و بهروز ترین وب سایت های آموزشی در سطح ایران است که همیشه تلاش کرده تا بتواند جدیدترین و به روزترین مقالات و دوره های آموزشی را در اختیار علاقه مندان قرار دهد.تبدیل کردن برنامه نویسان ایران به بهترین برنامه نویسان جهان هدف ماست.</p>
                    </div>
                    <div class="col-12 col-lg-1"></div>
                    <div class="col-12 col-lg-2">
                        <h6 class="mt-3">بخش های سایت</h6>
                        <hr class="header-caption-footer">
                        <a href="">قوانین و مقررات</a>
                        <a href="">تبلیغات</a>
                        <a href="">درباره ما</a>
                        <a href="">تماس با ما</a>
                    </div>
                    <div class="col-12 col-lg-1"></div>
                    <div class="col-12 col-lg-3">
                        <h6 class="mt-3">تماس با ما</h6>
                        <hr class="header-caption-footer">
                        <p>شما می توانید با یکی از راه های زیر با ما در تماس باشید</p>
                        
                        <div >
                            <!-- SVG EMAIL -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
                            </svg>
                        <!-- SVG EMAIL -->
                            
                            <span>  ایمیل: aghp81@gmail.com</span>
                        </div>

                        <div class="mt-3">
                            <!-- SVG PHONE -->
                        <svg width="1em" height="1em" viewBox="0 0 16 16"
                            class="bi bi-telephone-forward-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.471 17.471 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969zM12.646.646a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z" />
                            </svg>
                        <!-- SVG PHONE -->

                            <span> تماس: 09307515783</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Footer 2 -->
    <footer class="footer2">
        <div class="container">
            <p class="p-4 text-center">
                کلیه حقوق این سایت متعلق به AGHP است.
            </p>
        </div>
    </footer>
    <!-- Footer 2 -->

    <!-- Telegram fixed -->
    <img src="image/telegram.png" alt="" class="fixed-bottom d-none d-lg-block">
    <!-- Telegram fixed -->

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>