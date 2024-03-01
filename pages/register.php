<?php
include "../database/db.php";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


$ErrReqEmailPass = "";
$ErrMsgRePass = "";
$SuccessSubmit = "";
$hasemail = "";

if (isset($_POST['submit'])) {

    global $conn;

    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $active = rand(1000, 9999);

    if (!empty($mail) & !empty($pass)) {
        if ($pass == $repass) {

            // بررسی وجود ایمیل در دیتابیس 
            $result = $conn->prepare("SELECT * FROM user WHERE email = ?");
            $result->bindValue(1, $mail);
            $result->execute();

            // اگر ایمیل تکراری باشد
            if ($result->rowCount()>=1) {
                $hasemail = true;
            // اگر ایمیل تکراری نباشد
            }elseif ($result->rowCount()<=0) {
                
                $gt = $conn->prepare("INSERT INTO user SET username=?, phone=?, email=?, password=?, active=?");
            $gt->bindValue(1, $username);
            $gt->bindValue(2, $phone);
            $gt->bindValue(3, $mail);
            $gt->bindValue(4, $pass);
            $gt->bindValue(5, $active);
            $gt->execute();

            // ارسال ایمیل کد فعالسازی
    $email = $_POST['mail'];
    $mail = new PHPMailer(true);
    $mail->IsSMTP();

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'aghp81@gmail.com';                     //SMTP username
        $mail->Password = 'ivlqoescwfgfnibi';                               //SMTP password
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;           //Enable implicit TLS encryption
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->SetFrom("laraveldevphp@gmail.com");
        $mail->addAddress($email);     //Add a recipient
        $mail->addAddress($email);               //Name is optional
        $mail->addReplyTo('laraveldevphp@gmail.com', 'Information');
        $mail->addCC('laraveldevphp@gmail.com');
        $mail->addBCC('laraveldevphp@gmail.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->CharSet = "UTF-8";
        $mail->ContentType = "text/htm";
        $mail->Subject = 'کد فعالسازی';
        $mail->MsgHTML("<h2>فعالسازی</h2>");
        $mail->Body = $active;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        //echo 'پیام ارسال شد';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

            // ارسال ایمیل کد فعالسازی


            $SuccessSubmit = true;

            //  قبل از فرستادن کاربر به صفحه چک، ست کرن سشنها
            $_SESSION['login'] = true; //  - چک کردن لاگین بودن کاربر -  
            $_SESSION['username'] = $username; 
            $_SESSION['phone'] = $phone; 
            $_SESSION['email'] = $mail; 
            $_SESSION['password'] = $pass; 
            
            header('Location:check.php?success=true');
        }
    
            }

             else {
            $ErrMsgRePass = true;
        }

    } else {
        $ErrReqEmailPass = true;

    }

    
}
?>


<!doctype html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>آموزش برنامه نویسی</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- toaster js library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- toaster js library -->

</head>

<body>

    <!-- Top Header -->
    <div class="container top-header">
        <img src="../image/logo.svg" alt="logo header" width="80px">

        <!-- Search Box -->
        <div class="search-box d-none d-lg-flex">
            <div class="input-group md-form form-sm form-1 pl-0">
                <input class="form-control my-0 py-1" type="text" placeholder="دنبال چه آموزشی می گردی؟"
                    aria-label="Search">
                <div class="input-group-prepend" style="font-size:16px;">
                    <span style="background-color: #007bff;" class="input-group-text purple lighten-3" id="basic-text1">
                        <svg style="color:#fff;" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
                            <li class="nav-item dropdown">
                                <a style="color:#333; padding-left:35px; margin-top: -50px;" class="nav-link " href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="color: #fff">

                                    <svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-caret-down-fill"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                    </svg>

                                    احمد رضایی
                                    <img src="../image/profile.gif" style="margin-top:-10px;" class="rounded-circle"
                                        width="50" height="50" alt="">
                                </a>
                                <div class="dropdown-menu myaccount-dropdown dropdown-menu-right text-right"
                                    aria-labelledby="navbarDropdown" style="margin-right:-40px;">
                                    <span style="font-size:12px; font-weight:bold;"> موجودی شما: <span
                                            style="color: #6fc341; font-size:12px; font-weight:bold;"> ۶۰۷,۴۰۰
                                            تومان</span></span>
                                    <hr>
                                    <a class="dropmenu" href="#">

                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        مشاهده حساب کاربری
                                    </a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        ویرایش اطلاعات حساب </a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        مشاهده سفارشات</a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        فراموشی رمز عبور </a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        کیف پول من </a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        تراکنش ها</a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left:2px;" width="0.4em" height="0.4em"
                                            viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        خروج از حساب کاربری</a>
                                </div>
                            </li>
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
                        <input type="search" class="searchbox-mobile" style="" placeholder="دنبال چی میگردی؟">
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #fff;"> برنامه نویسی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: #fff;"> طراحی سایت</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #fff;"> گرافیک</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #fff;"> انیمیشن</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="color: #fff;"> برنامه نویسی موبایل </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" style="color: #fff;"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            بازی سازی
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a style="text-align: right; " class="dropmenu" href="#"> یونیتی</a>
                            <a style="text-align: right;" class="dropmenu" href="#">آنریل انجین</a>
                            <a style="text-align: right; " class="dropmenu" href="#">جاوا</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Nav Menu -->

    <!-- فرم ثبت نام -->
    <div class="container">
        <div class="row">
            <div class="register-item mb-5">
                <div class="header-register">
                    <h4>ثبت نام در سایت</h4>
                    <p>با ثبت نام در سایت ، از مزایای کاربران سایت بهره مند شوید</p>
                    <img src="https://toplearn.com/Site/images/register.svg" width="320px" style="margin-right: 98px;"
                        alt="">
                </div>

                <div class="input-register">

                    <!-- پیغام های خطا و موفقیت -->
                    <p style="color:red;">
                        <?php if ($ErrReqEmailPass) {
                            echo "لطفا ایمیل و رمز عبور را وارد کنید.";
                        } ?>
                    </p>
                    <p style="color:red;">
                        <?php if ($ErrMsgRePass) {
                            echo "پسورد با تکرار پسور مطابقت ندارد.";
                        } ?>
                    </p>
                    <p style="color:red;">
                        <?php if ($hasemail) {
                            echo "کاربری با این آدرس ایمیل قبلا ثبت شده است.";
                        } ?>
                    </p>
                    <p style="color:green;">
                        <?php if ($SuccessSubmit) {
                            echo "ثبت اطلاعات با موفقیت انجام شد. رمز یکبار مصرف به ایمیل شما ارسال شد.";
                        } ?>
                    </p>
                    
                    <!-- پیغام های خطا و موفقیت -->

                    <form method="POST" action="">
                        <input type="text" name="username" placeholder="نام کاربری را وارد کنید">
                        <input type="number" name="phone" placeholder="شماره موبایل را وارد کنید">
                        <input type="email" name="mail" style="display: block; width: 385px;"
                            placeholder="ایمیل را وارد کنید">
                        <input type="password" name="pass" placeholder="رمز عبو خود را وارد کنید">
                        <input type="password" name="repass" placeholder="رمز عبور را تکرار کنید">

                        <input name="submit" type="submit" class="btn btn-info submit-reg" value="ثبت نام در سایت">
                    </form>
                </div>

                <div class="footer-register">
                    <a href="login.php" class="btn-reg">ورود به سایت</a>
                    <a href="" class="btn-reg">فراموشی رمز عبور</a>
                </div>

            </div>
        </div>
    </div>
    <!-- فرم ثبت نام -->



    <br><br>
    <br><br>
    <br><br>
    <!-- Footer -->
    <footer>
        <div class="back-footer mt-5">
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

    <!-- Telegram fixed -->
    <img src="image/telegram.png" alt="" class="fixed-bottom d-none d-lg-block">
    <!-- Telegram fixed -->

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/javascript.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <!-- jquery -->

    <!-- toaster js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- toaster js library -->

    <img src="image/teleg2.png" alt="" class="fixed-bottom d-none d-lg-block">


</body>

<!-- پیغام خطای خالی بودن آدرس ایمیل و رمز عبور  -->
<?php if ($ErrReqEmailPass) { ?>

    <script>
        toastr.error('لطفا ایمیل و رمز عبور را وارد کنید.', 'پیغام خطا')
    </script>


<?php } ?>

<!-- پیغام خطای تکرار پسورد -->
<?php  if($ErrMsgRePass){  ?>
     
     <script>
             toastr.error('تکرار پسورد با پسورد مطابقت ندارد.', 'پیغام خطا')
     </script>
 
 
 <?php  } ?>

 <!-- پیغام موفقیت آمیز بودن ثبت اطلاعات -->
<?php  if($SuccessSubmit){  ?>
     
     <script>
             toastr.success('ثبت اطلاعات با موفقیت انجام شد. رمز یکبار مصرف به ایمیل شما ارسال شد.', 'پیغام موفقیت')
     </script>
 
 
 <?php  } ?>

<!-- پیغام خطای تکراری بودن ایمیل -->
 <?php  if($hasemail){  ?>
     
     <script>
             toastr.error('کاربری با این مشخصات قبلا ثبت شده است.', 'پیغام خطا')
     </script>
 
 
 <?php  } ?>

</html>
