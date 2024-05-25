<?php
    include "../database/db.php";
    include "../script/jdf.php";

    $alertAdd = null;
    $alertError = null;
    $hasRegister = false;
    $hasLogin = false;
    $user_id = 0;

    // SELECT POST
    $course = $_GET['course'];
    $result = $conn->prepare("SELECT * FROM course WHERE slug=?");
    $result->bindValue(1, $course);
    $result->execute();
    $post = $result->fetch(PDO::FETCH_ASSOC);
    //var_dump($post);

    // has Register in course
if(isset($_SESSION['login'])){
    $user_id = $_SESSION['id'];
    $hasLogin = true;

    $result = $conn->prepare("SELECT * FROM store WHERE user_id=? AND course_id=?");
    $result->bindValue(1, $user_id);
    $result->bindValue(2, $post['id']);
    $result->execute();
    if($result->rowCount() >= 1){
        $hasRegister = true;
    }
}


// add to course
if (isset($_POST['add'])) {

    $result = $conn->prepare("SELECT * FROM store WHERE user_id=? AND course_id=?");
    $result->bindValue(1, $_SESSION['id']);
    $result->bindValue(2, $post['id']);
    $result->execute();

    // اگر کاربر قبلا در دوره ثبت نام کرده پیغام خطای ثبت نام دریافت کند - کاربر یکبار در دوره ثبت نام کند
    if ($result->rowCount() >= 1) {
        $alertError = true;
    } else {
        $result = $conn->prepare("INSERT INTO store SET user_id=? , course_id=?");
        $result->bindValue(1, $_SESSION['id']);
        $result->bindValue(2, $post['id']);
        $result->execute();
        $alertAdd = true;
    }
}


    // فچ کردن همه ردیف های جدول منو برای نمایش در منوها
  $result = $conn->prepare("SELECT * FROM menu ORDER BY sort ASC");
  $result->execute();
  $menus = $result->fetchAll(PDO::FETCH_ASSOC);

  // جدا کردن کلمه های برچسب با کاما
  $tags = explode(',', $post['tag']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=  $post['title'] ?> </title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

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
                                    <a class="dropmenu" href="logout.php">
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
                        <a href="<?php  echo $menu['src']; ?>" class="nav-link <?php  foreach ($menus as $z) { if($menu['id'] == $z['z']) { ?> dropdown-toggle <?php } } // اگر زیر گروه نداشت کلاس dropdown-toggle نمایش داده نشود ?>"  aria-haspopup="true" id="navbarDropdown" style="color: #fff;"
                            role="button" 
                            <?php  foreach ($menus as $z) { if($menu['id'] == $z['z']) { ?> data-toggle="dropdown" <?php } } // اگر زیر گروه نداشت کلاس data-toggle نمایش داده نشود ?> aria-expanded="false">
                            <?php  echo $menu['title'];   ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <?php  foreach ($menus as $ul) { if ($menu['id'] == $ul['z']) { ?>
                                
                                
                                <a style="text-align: right; " class="dropmenu" href="<?php  echo $ul['src']; ?>"> <?php  echo $ul['title'];  ?></a>
                                
                            <?php }}  ?>
                        </div>
                    </li>
                    <?php  }} //if & foreach  ?>
                    <!-- نمایش منوهای سایت -->

                    <!-- اگر کاربر لاگین کرده بود -->
                    <?php  if(isset($_SESSION['login'])){ ?> 
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php" style="color: #fff;"> خروج   </a>
                    </li>
                    <?php  } ?> 
                    <!-- اگر کاربر لاگین کرده بود -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Menu -->

    <!-- content single page -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <img class="img-fluid img-thumbnail p-2" src="../image/takhfif-banner.gif" alt="">
            </div>

            <!-- Right Sidebar -->
            <div class="col-12 col-lg-4 mt-4">
                <!-- اطلاعات دوره -->
                <div class="information-cours shadow p-3 mb-5 bg-white rounded box-caption-dore">
                    <p class="px-3">قیمت این دوره: <span style="color:#6fc342;"><?=  $post['value'];  ?> تومان</span></p>
                    <hr>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        <span>
                            مدرس دوره : محمد معین باغ شیخی <a href="" style="color: #6fc341;">( رزومه )</a>
                        </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                        </svg>
                        <span>
                            تعداد دانشجویان این دوره : ۱۵۰ نفر
                        </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16"
                            class="bi bi-camera-video-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.667 3h6.666C10.253 3 11 3.746 11 4.667v6.666c0 .92-.746 1.667-1.667 1.667H2.667C1.747 13 1 12.254 1 11.333V4.667C1 3.747 1.746 3 2.667 3z" />
                            <path
                                d="M7.404 8.697l6.363 3.692c.54.313 1.233-.066 1.233-.697V4.308c0-.63-.693-1.01-1.233-.696L7.404 7.304a.802.802 0 0 0 0 1.393z" />
                        </svg>
                        <span>
                            تعداد ویدیوها : ۲۳ ویدیو
                        </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        </svg>
                        <span>
                            مدت زمان دوره : ۹:۲۴:۰۰
                        </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-award-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 0l1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z" />
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z" />
                        </svg>
                        <span>
                            سطح دوره : <?php if($post['level'] == 1) {echo "مقدماتی";} elseif($post['level'] == 2){echo "متوسط";}else{echo "پیشرفته";} ?>
                        </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16"
                            class="bi bi-exclamation-circle-fill" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                        <span>
                            وضعیت دوره
                        </span>
                        : <span style="color: #00b3e9;"> <?php  if($post['status'] == 0){echo "درحال برگزاری";}else{echo "تکمیل شده";}  ?> </span>
                    </p>

                    <p class="caption-ostad-more">
                        <svg class="opacity-50" width="1em" height="1em" viewBox="0 0 16 16"
                            class="bi bi-calendar-date-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM0 5h16v9a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5zm9.336 7.79c-1.11 0-1.656-.767-1.703-1.407h.683c.043.37.387.82 1.051.82.844 0 1.301-.848 1.305-2.164h-.027c-.153.414-.637.79-1.383.79-.852 0-1.676-.61-1.676-1.77 0-1.137.871-1.809 1.797-1.809 1.172 0 1.953.734 1.953 2.668 0 1.805-.742 2.871-2 2.871zm.066-2.544c.625 0 1.184-.484 1.184-1.18 0-.832-.527-1.23-1.16-1.23-.586 0-1.168.387-1.168 1.21 0 .817.543 1.2 1.144 1.2zm-2.957-2.89v5.332H5.77v-4.61h-.012c-.29.156-.883.52-1.258.777V8.16a12.6 12.6 0 0 1 1.313-.805h.632z" />
                        </svg>
                        <span>
                            تاریخ آخرین بروزرسانی : <?= jdate('d-m-Y', $post['update_date'])  ?>
                        </span>
                    </p>
                    <br>

                    <div class="btn btn-outline-success btn-lg login-in-dore">
                    <?php if (isset($_SESSION['login']) && $hasRegister == false) { ?>
                    <form method="post">
                        <input class="btn btn-success add-butt login-in-dore login-in-dore-hover" type="submit"
                            name="add" value="ثبتــــ نام در این دوره">
                    </form>
                    <?php }else if(isset($_SESSION['login']) && $hasRegister == true){ ?>
                    <form method="post">
                        <input class="btn btn-info add-butt login-in-dore" type="submit" name="add"
                            value="شما دانشجوی این دوره هستید">
                    </form>
                    <?php } else { ?>
                    <a href="login.php" class="btn btn-warning d-block" style="padding: 10px 14px;">ابتدا وارد
                        شـــوید</a>
                    <?php } ?>
                    </div>

                </div>
                <!-- اطلاعات دوره -->

                <!-- دسته بندی -->
                <div class="information-cours shadow p-3 mb-5 bg-white rounded box-caption-dore">
                    <p style="font-size: 17px;">
                        <svg style="opacity: 0.35; margin-bottom: 0px; margin-left: 6px; font-size: 17px;" width="1em"
                            height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
                        </svg>

                        دسته بندی
                    </p>
                    <hr>
                    <div class="p-2">
                        <div class="mt-0">
                            <a style="display:inline-block; margin:5px;" href="" class="category-tags">برنامه نویسی
                                وب</a>
                            <a style="display:inline-block; margin:5px;" href="" class="category-tags">برنامه نویسی
                                وب</a>
                        </div>
                    </div>
                </div>
                <!-- دسته بندی -->

                <!-- برچسب ها -->
                <div class="information-cours shadow p-3 mb-5 bg-white rounded box-caption-dore">
                    <p style="font-size: 17px;">
                        <svg class="ml-2" style="opacity: 0.35;"
                            style="opacity: 0.35; margin-bottom: 0px; margin-left: 6px; font-size: 17px;" width="1em"
                            height="1em" viewBox="0 0 16 16" class="bi bi-tags" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 2v4.586l7 7L14.586 9l-7-7H3zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2z" />
                            <path fill-rule="evenodd"
                                d="M5.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                            <path
                                d="M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1v5.086z" />
                        </svg>

                        برچسب ها:
                    </p>
                    <hr>
                        
                    <div class="p-2">
                        <!-- نمایش تگ ها به صورت داینامیک -->
                    <?php  foreach ($tags as $tag) : ?>
                        <a href="" class="category-tags-1">
                            <?=  $tag  ?>
                        </a>
                        <?php  endforeach;  ?>
                        <!-- نمایش تگ ها به صورت داینامیک -->
                    </div>
                    


                </div>
                <!-- برچسب ها -->

                <!-- تبلیغات -->
                <div class="image-tab-banner pt-1 m-4">
                    <img src="../image/bannertab.png" alt="">
                </div>
                <!-- تبلیغات -->

            </div>
            <!-- Right Sidebar -->

            <!-- Left Sidebar -->
            <div class="col-12 col-lg-8 mt-4" style="border: 1px solid #ecf0f4;">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="image-crouser p-4">
                        <img class="img-fluid " src="<?= $post['image'] ?>" alt="">
                    </div>
                    <!-- درباره دوره -->
                    <div class="content-course">
                        <div class="course-content-text js-collapse-container collapsed collapsed-custom"
                            style="height: 1107px; max-height: inherit;">
                            <h2><?=  $post['title'] ?></h2>
                            <p<?=  $post['content'] ?></p>
                            
                            <div><span class="course-info-btn-display-more js-collapse-btn" data-collapsed="نمایش بیشتر"
                                    data-expand="بستن"> <i
                                        class="zmdi zmdi-chevron-down course-info-icon-down-display-more"></i> </span>
                            </div>
                        </div>
                        
                        <div class="alert alert-success">
                            لطفا سوالات خود را در مورد این آموزش در بخش  <a style="color: #007bff;" href="#">پرسش و پاسخ</a> مطرح کنید. به سوالات در بخش نظرات پاسخ داده نخواهد شد.
                        </div>

                        <div>
                            <h5 class="p-4">فهرستـــ ویدیوها</h5>

                            <video class="video-item p-4" src="<?=  $post['intro'];  ?>" controls width="100%"></video>
                        </div>

                        <div class="alert alert-warning">
                            در صورتی که ویدئو مشاهده نشد آن را دانلود کنید و با kmPlayer اجرا کنید.
                        </div>

                        <div class="alert alert-info">
                            راهنما!جهت دریافت لینک دانلود ویدئوها بر روی این لینک ها کلیک کنید.
                        </div>

                        <!-- سرفصل دوره -->
                        <div class="downlod-box mt-5">
                            <div class="download-item">
                                <span class="number-item">۱</span>
                                <span class="title-download-item">معرفی دوره</span><br class="d-flex d-lg-none">
                                <span class="time-download-item">۰۰:۳۲:۰۰ </span>
                                <span class="status-download-item">رایگانــ</span>

                                <!-- آیکون های ذخیره و اجرا -->
                                <span class="green-logo"><svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="bi bi-cloud-arrow-down-fill" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                            </svg>
                        </span>

                            <span class="blue-logo">
                                <svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="bi bi-play-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.596 8.697l-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z" />
                            </svg>
                        </span>
                            
                            <span class="light-logo"><svg width="1em" height="1em" viewBox="0 0 16 16"
                                    class="bi bi-file-earmark-text-fill" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M2 3a2 2 0 0 1 2-2h5.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </span>
                            <!-- آیکون های ذخیره و اجرا -->
                            </div>
                        </div>
                        <!-- سرفصل دوره -->

                    </div>
                    <!-- درباره دوره -->

                </div>
            </div>


        </div>
    </div>
    <!-- content single page -->

    <!-- Footer -->
    <footer class="mt-5">
        <div class="back-footer">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <h6 class="mt-3">درباره AGHP</h6>
                        <hr class="header-caption-footer">
                        <p>این سایت یکی از پرتلاش تزین و بهروز ترین وب سایت های آموزشی در سطح ایران است که همیشه تلاش
                            کرده تا بتواند جدیدترین و به روزترین مقالات و دوره های آموزشی را در اختیار علاقه مندان قرار
                            دهد.تبدیل کردن برنامه نویسان ایران به بهترین برنامه نویسان جهان هدف ماست.</p>
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

                        <div>
                            <!-- SVG EMAIL -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
                            </svg>
                            <!-- SVG EMAIL -->

                            <span> ایمیل: aghp81@gmail.com</span>
                        </div>

                        <div class="mt-3">
                            <!-- SVG PHONE -->
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-forward-fill"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- sweetaler js library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- sweetaler js library -->

     
 <!-- پیغام ثبت نام یا عدم ثبت نام در دوره -->
<?php if ($alertAdd) { ?>
    <script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'دوره به سبد خرید شما اضافه شد'
    })
    </script>
    <?php } ?>

    <?php if ($alertError) { ?>
    <script>
    const ToastErr = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    ToastErr.fire({
        icon: 'error',
        title: 'دوره قبلا به سبد خرید اضافه شده'
    })
    </script>
    <?php } ?>

     <!-- پیغام ثبت نام یا عدم ثبت نام در دوره -->


</body>

</html>