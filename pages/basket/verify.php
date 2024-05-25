<?php
include "../../database/db.php";
if (!isset($_POST['transid'])) {
    header('location:../../');
}
$user = $_GET['user'];

// SELECT MENUs
$result = $conn->prepare("SELECT * FROM menu ORDER BY sort");
$result->execute();
$menus = $result->fetchall(PDO::FETCH_ASSOC);

// Select user
$result = $conn->prepare("SELECT * FROM user WHERE id=?");
$result->bindValue(1, $user);
$result->execute();
$user_data = $result->fetch(PDO::FETCH_ASSOC);
$email = $user_data['email'];
$password = $user_data['password'];

$result = $conn->prepare('SELECT * FROM user WHERE email=? AND password=?');
$result->bindValue(1, $email);
$result->bindValue(2, $password);
$result->execute();
if ($result->rowCount() >= 1) {
    $rows = $result->fetch(PDO::FETCH_ASSOC);
    $_SESSION['login'] = true;
    $_SESSION['id'] = $rows['id'];
    $_SESSION['email'] = $rows['email'];
    $_SESSION['password'] = $rows['password'];
    $_SESSION['role'] = $rows['role'];
    $_SESSION['status'] = $rows['status'];
} else {
    header('location:../../');
}
?>

<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تاپ لرن</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
<!-- top header -->
<div class="container top-header">
    <img src="../../image/logo.svg" alt="logo header" width="80px">
    <div class="search-box d-none d-lg-flex">
        <div class="input-group md-form form-sm form-1 pl-0">
            <input class="form-control my-0 py-1" type="text" style="font-size: 14px;"
                   placeholder="دنبال چه آموزشی میگردی؟" aria-label="Search">
            <div class="input-group-prepend">
                    <span style="background-color: #007bff;" class="input-group-text purple lighten-3"
                          id="basic-text1"><svg style="color: #fff;" width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-search" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                            <path fill-rule="evenodd"
                                  d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                        </svg></span>
            </div>
        </div>
    </div>
    <div class="instagram-icon">
        <nav class="navbar navbar-expand-lg" style="width: 100%; direction: ltr;">
            <div style="margin-left: -16px; margin-right: -22px;">
                <div class="container">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['login'])) { ?>
                            <li class="nav-item dropdown">
                                <a style="color:#333; padding-left: 35px; margin-top: -50px;" class="nav-link" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                   style="color: #fff">
                                    <svg width="0.8em" height="0.8em" viewBox="0 0 16 16" class="bi bi-caret-down-fill"
                                         fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                    </svg>
                                    <?php echo $_SESSION['email'] ?>
                                    <img src="../../image/avatar-2.jpg"
                                         style="margin-top: -13px; border-radius: 50%; border: 2px solid #ccc;"
                                         width="50px" alt="">
                                </a>
                                <div class="dropdown-menu myaccont-dropdown dropdown-menu-right text-right"
                                     aria-labelledby="navbarDropdown" style="margin-right: -40px;"><br>
                                    <span><?php echo $_SESSION['password'] ?></span>
                                    <hr>
                                    <a class="dropmenu" href="#" style="margin-top: -20px;">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        <?php if ($_SESSION['role'] == 1) {
                                            echo 'کاربر عادی';
                                        } else if ($_SESSION['role'] == 2) {
                                            echo 'مدرس';
                                        } else {
                                            echo 'مدیر';
                                        } ?></a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8"/>
                                        </svg>
                                        <?php if ($_SESSION['status'] == 0) { ?> <a href=""
                                                                                    class="btn btn-danger"
                                                                                    style="margin: 15px 15px 0 0;">غیرفعال</a> <?php } else { ?>
                                            <a href=""
                                               class="btn btn-success"
                                               style="margin: 15px 15px 0 0;">فعال</a> <?php } ?></a>
                                    <a class="dropmenu" href="shop.php">
                                        سبد خرید
                                    </a>
                                    <?php if ($_SESSION['role'] == 3) { ?>

                                        <a class="dropmenu" href="../admin">
                                            <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                                 viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="8" cy="8" r="8"/>
                                            </svg>
                                            پنل ادمین</a>
                                    <?php } ?>

                                </div>
                            </li>
                        <?php } else { ?>
                            <li style="margin-top: -40px">
                                <a href="login.php" class="btn btn-primary">ورود</a>
                                <a href="register.php" class="btn btn-primary">ثبت نام</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light" id="nav-menu" style="width: 100%;">
    <button style="margin-bottom: 10px;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent"
         style="background-color: #333; margin-left: -16px; margin-right: -22px;">
        <div class="container">
            <ul class="navbar-nav">
                <?php foreach ($menus as $menu) {
                    if ($menu['z'] == 0) { ?>
                        <li class="nav-item dropdown">
                            <a href="<?php echo $menu['src']; ?>" class="nav-link  <?php foreach ($menus as $z) {
                                if ($menu['id'] == $z['z']) { ?> dropdown-toggle <?php }
                            } ?>"  href="#" id="navbarDropdown" role="button"
                            <?php foreach ($menus as $z) {
                                if ($menu['id'] == $z['z']) { ?> data-toggle="dropdown" <?php }
                            } ?> aria-haspopup="true" aria-expanded="false" style="color: #fff">
                            <?php echo $menu['title']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
                                <?php foreach ($menus as $ul) {
                                    if ($menu['id'] == $ul['z']) { ?>
                                        <a class="dropmenu"
                                           href="<?php echo $ul['src']; ?>"><?php echo $ul['title']; ?></a>
                                    <?php }
                                } ?>
                            </div>
                        </li>
                    <?php }
                } ?>
                <?php if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php" style="color: #fff;">خروج<span
                                    class="sr-only">(current)</span></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="body-page container">
    <?php
    $data = [
        'pin' => 'aqayepardakht',
        'amount' => $_GET['amount'],
        'transid' => $_POST['transid']
    ];
    $data = json_encode($data);
    $ch = curl_init('https://panel.aqayepardakht.ir/api/verify');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result === "1") {
        echo '<div class="alert alert-success">پرداخت با موفقیت انجام شد</div><br><a href="../../" class="btn btn-primary d-block" style="margin: 0 auto; display: block; width: 300px;">بازگشت به صفحه اصلی</a>';
        $result = $conn->prepare("UPDATE store SET status = 1 WHERE user_id=?");
        $result->bindValue(1, $user);
        $result->execute();
    } elseif ($result === "0") {
        echo '<div class="alert alert-danger">پرداخت با موفقیت انجام نشد</div><br><a href="../../" class="btn btn-danger d-block" style="margin: 0 auto; display: block; width: 300px;">بازگشت به صفحه اصلی</a>';
    }
    ?>
</div>
<br><br><br><br><br><br><br><br>
<footer>
    <div class="footer-back">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4"><br>
                    <h6>درباره راکت</h6>
                    <hr class="header-caption-footer">
                    <p class="caption-footer">راکت یکی از پرتلاش‌ترین و بروزترین وبسایت های آموزشی در سطح ایران است
                        که همیشه تلاش کرده تا
                        بتواند جدیدترین و بروزترین مقالات و دوره‌های آموزشی را در اختیار علاقه‌مندان ایرانی قرار
                        دهد. تبدیل کردن برنامه نویسان ایرانی به بهترین برنامه نویسان جهان هدف ماست</p>
                </div>
                <div class="col-12 col-lg-1"></div>
                <div class="col-12 col-lg-2"><br>
                    <h6>بخش های سایت</h6>
                    <hr class="header-caption-footer">
                    <a style="color: #fff; display:block;margin-top: 10px;" href="">قوانین و مقررات</a>
                    <a style="color: #fff; display:block;margin-top: 10px;"" href="">تبلیغات</a>
                    <a style=" color: #fff; display:block;margin-top: 10px;"" href="">درباره راکت</a>
                    <a style="color: #fff; display:block;margin-top: 10px;"" href="">ارتباط با ما</a>
                </div>
                <div class=" col-12 col-lg-1">
                </div>
                <div class="col-12 col-lg-3"><br>
                    <h6>ارتباط با ما</h6>
                    <hr class="header-caption-footer">
                    <p class="caption-footer">شما میتوانید با استفاده از یکی از راه‌های زیر با ما ارتباط برقرار کنید
                    </p>
                    <div>
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                            <span>
                                    ایمیل :‌ info@roocket.ir
                                </span>
                    </div>

                    <div style="margin-top: 10px;">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-forward-fill"
                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.471 17.471 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969zM12.646.646a.5.5 0 0 1 .708 0l2.5 2.5a.5.5 0 0 1 0 .708l-2.5 2.5a.5.5 0 0 1-.708-.708L14.293 4H9.5a.5.5 0 0 1 0-1h4.793l-1.647-1.646a.5.5 0 0 1 0-.708z"/>
                            <span> تماس: 09135882813</span>
                    </div>
                    <br>
                </div>
            </div>
            <br class="d-none d-lg-flex">
        </div>
    </div>
</footer>
<footer class="footer2">
    <div class="container">
        <p>کليه حقوق محصولات و محتوای اين سایت متعلق به راکت می باشد و هر گونه کپی برداری از محتوا و محصولات سایت
            غیر
            مجاز و بدون رضایت ماست</p>
    </div>
</footer>

<img src="image/teleg2.png" alt="" class="fixed-bottom d-none d-lg-block">
</body>
<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/javascript.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>
