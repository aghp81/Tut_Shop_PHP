<?php  
    //اگر کاربر ادمین نبود هدایت شود به صفحه اصلی سایت
    include "../database/db.php";
    if($_SESSION['role'] == 2 ){
        header('Location: ');
    } else{
        echo "<script>
          window.alert('شما دسترسی ورود به این بخش را ندارید');
          window.location.href='../index.php';
        </script>";
    }

    // هر صفحه ای که در آن بودیم کلاس اکتیو فعال شود
    function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
        echo 'active'; //class name in css 
    } 
    }
?>


<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <title>آقای ادمین | قالب واکنشگرا مدیریتی</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- App css -->
        <link href="assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- ckeditor5 -->
        <link rel="stylesheet" href="../script/ckeditor5/ckeditor5.css">

        
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>



    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.php" class="logo"><span><?php echo $_SESSION['email']; ?><span>ادمین</span></span><i class="zmdi zmdi-layers"></i></a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title">داشبورد</h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Notification bar -->
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="به دنبال چه می گردی ؟؟؟"
                                           class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!-- User -->
                    <div class="user-box">
                        <div class="user-img">
                            <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                            <div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>
                        </div>
                        <h5><a href="#">علی یدالهی</a> </h5>
                        <ul class="list-inline">
                            <li>
                                <a href="#" >
                                    <i class="zmdi zmdi-settings"></i>
                                </a>
                            </li>

                            <li>
                                <a href="../pages/logout.php" class="text-custom">
                                    <i class="zmdi zmdi-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End User -->

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="text-muted menu-title">دسته بندی ها</li>

                            <li>
                                <a href="index.php" class="<?php active('index.php');?> waves-effect "><i class="zmdi zmdi-view-dashboard"></i> <span> داشبورد </span> </a>
                            </li>

                            <li>
                                <a href="menu.php" class="waves-effect <?php active('menu.php');?>"><i class="zmdi zmdi-menu"></i> <span> منوها </span> </a>
                            </li>

                            <li>
                                <a href="course.php" class="waves-effect <?php active('course.php');?>"><i class="zmdi zmdi-collection-video"></i> <span>مدیریت دوره ها </span> </a>
                            </li>

                            <li>
                                <a href="typography.html" class="waves-effect"><i class="zmdi zmdi-format-underlined"></i> <span> نوشته ها </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-invert-colors"></i> <span> رابط کاربی </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="ui-buttons.html">دکمه ها</a></li>
                                    <li><a href="ui-cards.html">کارد</a></li>
                                    <li><a href="ui-draggable-cards.html">کارت های جابه جا شونده</a></li>
                                    <li><a href="ui-checkbox-radio.html">چک باکس ها</a></li>
                                    <li><a href="ui-material-icons.html">آیکون های طراحی متریال</a></li>
                                    <li><a href="ui-font-awesome-icons.html">فونت آسوم</a></li>
                                    <li><a href="ui-themify-icons.html">تم فی آیکون</a></li>
                                    <li><a href="ui-modals.html">مدل ها</a></li>
                                    <li><a href="ui-notification.html">اطلاعات</a></li>
                                    <li><a href="ui-range-slider.html">نوار تغیرات</a></li>
                                    <li><a href="ui-components.html">اجزا</a>
                                    <li><a href="ui-sweetalert.html">هشدار ها</a>
                                    <li><a href="ui-treeview.html">نمایش درختی</a>
                                    <li><a href="ui-widgets.html">ویجت ها</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-collection-text"></i><span class="label label-warning pull-right">7</span><span> فرم ها </span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="form-elements.html">فرم های عمومی</a></li>
                                    <li><a href="form-advanced.html">فرم های پیشرفته</a></li>
                                    <li><a href="form-validation.html">فرم ولیدشن</a></li>
                                    <li><a href="form-wizard.html">فرم پیشفرض</a></li>
                                    <li><a href="form-fileupload.html">فرم آپلود</a></li>
                                    <li><a href="form-wysiwig.html">ادیتور 1</a></li>
                                    <li><a href="form-xeditable.html">ادیتور 2</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-view-list"></i> <span> جدول ها </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="tables-basic.html">جدول پیشفرض</a></li>
                                    <li><a href="tables-datatable.html">جدول داده ها</a></li>
                                    <li><a href="tables-responsive.html">جدول واکنش گرا</a></li>
                                    <li><a href="tables-editable.html">جدول تغیرات</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect "><i class="zmdi zmdi-chart"></i><span> چارت ها </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="chart-flot.html">چارت شماره 1</a></li>
                                    <li><a href="chart-morris.html">چارت شماره 2</a></li>
                                    <li><a href="chart-chartist.html">چارت شماره 3</a></li>
                                    <li><a href="chart-chartjs.html">چارت شماره 4</a></li>
                                    <li><a href="chart-other.html">چارت شماره 5</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="calendar.html" ><i class="zmdi zmdi-calendar"></i><span> تقویم </span></a>
                            </li>

                            <li>
                                <a href="inbox.html" class="waves-effect"><i class="zmdi zmdi-email"></i><span class="label label-purple pull-right">جدید</span><span> ایمیل </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-collection-item"></i><span> برگه ها </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="page-starter.html">برگه خالی</a></li>
                                    <li><a href="page-login.html">ورود</a></li>
                                    <li><a href="page-register.html">ثبت نام</a></li>
                                    <li><a href="page-recoverpw.html">فراموشی رمز</a></li>
                                    <li><a href="page-lock-screen.html">قفل صفحه</a></li>
                                    <li><a href="page-confirm-mail.html">تنظیمات ایمیل</a></li>
                                    <li><a href="page-404.html">خطای 404</a></li>
                                    <li><a href="page-500.html">خطای 500</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect "><i class="zmdi zmdi-layers"></i><span>دیگر صفحات </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="extras-projects.html">پروژ ه ها</a></li>
                                    <li ><a href="extras-tour.html">تور آزمایشی</a></li>
                                    <li><a href="extras-taskboard.html">مدیرها</a></li>
                                    <li><a href="extras-taskdetail.html">جزئیات</a></li>
                                    <li><a href="extras-profile.html">پروفایل </a></li>
                                    <li><a href="extras-maps.html">نقشه</a></li>
                                    <li><a href="extras-contact.html">لیست تماس</a></li>
                                    <li><a href="extras-pricing.html">فروش</a></li>
                                    <li><a href="extras-timeline.html">خط زمان</a></li>
                                    <li><a href="extras-invoice.html">صورت حساب</a></li>
                                    <li><a href="extras-faq.html">سوال و جواب</a></li>
                                    <li><a href="extras-gallery.html">گالری</a></li>
                                    <li><a href="extras-email-template.html">تم های ایمیل</a></li>
                                    <li><a href="extras-maintenance.html">تعمیرات</a></li>
                                    <li><a href="extras-comingsoon.html">به زودی</a></li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->