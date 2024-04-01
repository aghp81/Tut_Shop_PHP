<?php
  include "header.php";

  $num = 1;

  // insert
  if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $z = $_POST['z'];
    $sort = $_POST['sort'];
    $src = $_POST['src'];

    $result = $conn->prepare('INSERT INTO menu SET title=?, z=?, sort=?, src?');
    $result->bindValue(1, $title);
    $result->bindValue(2, $z);
    $result->bindValue(3, $sort);
    $result->bindValue(4, $src);
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
                                <h3 class="mb-2">افزودن دوره آموزشی</h3>

                                <div class="row">
                                    <form action="" method="POST" class="col-lg-9">
                                        <div class="form-group">
                                        <label for="" class="mt-3">عنوان دوره آموزشی</label>
                                            <input type="text" name="title" class="form-control mt-3">
                                        </div>

                                        <div class="form-group">
                                            <label for="">توضیحات</label>
                                            <textarea name="my" id="editor" cols="30" rows="10" class="form-control mt-3" placeholder="توضیحات"></textarea>
                                            
                                        </div>

                                        

                                        

                                        <div class="form-group">
                                            <input type="submit" name="sub" class="btn btn-success" value="افزودن">
                                        </div>

                                    </form>
                                </div>
                                
                                
                                </div>
                                


                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


<?php  include "footer.php";   ?>