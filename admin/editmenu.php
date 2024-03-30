<?php
  include "header.php";

  $num = 1;

  // insert
  if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $z = $_POST['z'];
    $sort = $_POST['sort'];
    $src = $_POST['src'];

    $result = $conn->prepare('UPDATE menu SET title=?, z=?, sort=?, src=? WHERE id=?');
    $result->bindValue(1, $title);
    $result->bindValue(2, $z);
    $result->bindValue(3, $sort);
    $result->bindValue(4, $src);
    $result->bindValue(5, $_GET['id']);
    $result->execute();

    header("Location: menu.php");
  

  ?>

<script>
    alert ("منو با موفقیت ویرایش شد");
    window.location = "menu.php";
</script>      

<?php } ?>


  <?php
  // فچ کردن همه ردیف های جدول منو برای نمایش در سرگروه
  $result = $conn->prepare("SELECT * FROM menu");
  $result->execute();
  $menus = $result->fetchAll(PDO::FETCH_ASSOC);
//   var_dump($menus);

// نمایش ولیوها در فیلد برای ویرایش
$result = $conn->prepare("SELECT * FROM menu WHERE id=?");
$result->bindValue(1, $_GET['id']);
$result->execute();
$itemmenu = $result->fetch(PDO::FETCH_ASSOC);
// var_dump($itemmenu);
?>


            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- end row -->
                        <div class="row">
                            <div class="card-box">
                                ویرایش منو
  
                                <form action="" method="POST" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control mt-3" value="<?= $itemmenu['title'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <select name="z" id="" class="form-control mt-3">
                                            <option value="0">بدون سرگروه</option>
                                            <?php  
                                                foreach ($menus as $menu) { ?>

                                                <option <?php  if($menu['id'] == $itemmenu['z']) { ?> selected  <?php  } ?> value="<?php  echo $menu['id']  ?>"> <?php  echo $menu['title']  ?> </option>
                                                
                                            <?php }  ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="number" name="sort" class="form-control mt-3" value="<?= $itemmenu['sort'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="src" class="form-control mt-3" value="<?= $itemmenu['src'] ?>">
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