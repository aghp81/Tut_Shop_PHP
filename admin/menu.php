<?php
  include "header.php";

  $num = 1;

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
                                
                                <br>
                                <br>
                                <br>
                                <div class="p-3">
                                    <table class="table table-striped m-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان</th>
                                                <th>سرگروه </th>
                                                <th>اولویت بندی </th>
                                                <th>عملیات  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menus as $menu) { ?>
                                                <tr>
                                                <th scope="row"><?= $num++;  ?></th>
                                                <td><?= $menu['title'];  ?></td>
                                                <td><span class="label label-primary"><?php 
                                                            // نمایش عنوان سرگروه به جای آی دی
                                                            foreach ($menus as $item) {
                                                                if ($menu['z'] == $item['id']) {
                                                                    echo $item['title'];
                                                        }
                                                    }  ?></span>
                                                    
                                                </td>
                                                <td><?= $menu['sort'];  ?></td>
                                                <td>
                                                    <a href="editmenu.php?id=<?php echo $menu['id'] ?>" class="btn btn-warning">ویرایش</a>
                                                    <a href="deletemenu.php?id=<?php echo $menu['id'] ?>" class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr>
                                            <?php  } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                


                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


<?php  include "footer.php";   ?>