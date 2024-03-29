<?php
  include "header.php";

  // insert
  if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $z = $_POST['z'];
    $sort = $_POST['sort'];

    $result = $conn->prepare('INSERT INTO menu SET title=?, z=?, sort=?');
    $result->bindValue(1, $title);
    $result->bindValue(2, $z);
    $result->bindValue(3, $sort);
    $result->execute();
  }

  // فچ کردن همه ردیف های جدول منو برای نمایش در سرگروه
  $result = $conn->prepare("SELECT * FROM menu");
  $result->execute();
  $menus = $result->fetchAll(PDO::FETCH_ASSOC);
//   var_dump($menus);
?>


            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- end row -->
                        <div class="row">
                            <div class="card-box">
                                صفحه منو

                                <form action="" method="POST" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control mt-3" placeholder="عنوان منو">
                                    </div>

                                    <div class="form-group">
                                        <select name="z" id="" class="form-control mt-3">
                                            <option value="0">بدون سرگروه</option>
                                            <?php  
                                                foreach ($menus as $menu) { ?>

                                                <option value="<?php  echo $menu['id']  ?>"> <?php  echo $menu['title']  ?> </option>
                                                
                                            <?php }  ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" name="sort" class="form-control mt-3" placeholder="اولویت بندی ">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="sub" class="btn btn-success" value="افزودن">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


<?php  include "footer.php";   ?>