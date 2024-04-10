<?php
  include "header.php";
  include "../script/jdf.php";

  $successadd = null;
  $num = 1;
  $titleErr = $contentErr = $imagetErr = "";
  $title= $content = $image = $tag = $slug =  $value = $level = "";


  // insert
  
  if(isset($_POST['sub'])) {
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $tag = $_POST['tag'];
    $slug = $_POST['slug'];
    $value = $_POST['value'];
    $level = $_POST['level'];
    
    if (empty($_POST['title'])) {
        $titleErr = "عنوان دوره الزامی است.";
    } elseif(empty($_POST['content'])) {
        $contentErr = "توضیحات دوره الزامی است.";
    }elseif(empty($_POST['image'])) {
        $imagetErr = "تصویر دوره الزامی است.";
    }else{
    
    $result = $conn->prepare('INSERT INTO course SET title=?, content=?, image=?, tag=?, slug=?, value=?, level=?, create_date=?, update_date=?');
    $result->bindValue(1, $title);
    $result->bindValue(2, $content);
    $result->bindValue(3, $image);
    $result->bindValue(4, $tag);
    $result->bindValue(5, $slug);
    $result->bindValue(6, $value);
    $result->bindValue(7, $level);
    $result->bindValue(8, time());
    $result->bindValue(9, time());
    //var_dump($result); die;
    $result->execute();
    $successadd = true;
  }
}


    // فچ کردن همه ردیف های جدول منو برای نمایش در سرگروه
    $result = $conn->prepare("SELECT * FROM menu");
    $result->execute();
    $menus = $result->fetchAll(PDO::FETCH_ASSOC);
  //   var_dump($menus);

  // فچ کردن همه ردیف های جدول کورس برای نمایش در جدول
  $result = $conn->prepare("SELECT * FROM course");
  $result->execute();
  $posts = $result->fetchAll(PDO::FETCH_ASSOC);
//   var_dump($menus);


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>


            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- end row -->
                        <div class="row">
                            <div class="card-box">
                            <?php
                                        if ($successadd) {
                                            echo '<p class="alert alert-success">پست موردنظر با موفقیت افزوده شد.</p>';
                                        }

                            ?>
                                <h3 class="mb-2">افزودن دوره آموزشی</h3>

                                <div class="row">
                                    <form  action="" method="POST" enctype="multipart/form-data" class="col-lg-9">
                                        <div class="form-group">
                                        <label for="" class="mt-3">عنوان دوره آموزشی</label>
                                            <input type="text" name="title" class="form-control mt-3" value="<?php  echo $title; ?>" >
                                            <span class="error"> <?php echo $titleErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">توضیحات</label>
                                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control mt-3" placeholder="توضیحات"><?php echo $content;?></textarea>
                                            <span class="error"> <?php echo $contentErr; ?></span>
                                       </div>

                                       <div class="form-group">
                                            <label for="" class="mt-3">  تصویر</label>
                                            <input type="text" name="image" class="form-control mt-3">
                                            <span class="error"> <?php echo $imagetErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">  برچسب ها</label>
                                            <input type="text" name="tag" class="form-control mt-3" value="<?php echo $tag;?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">آدرس اینترنتی</label>
                                            <input type="text" name="slug" class="form-control mt-3" value="<?php echo $slug;?>" >
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">قیمت</label>
                                            <input type="text" name="value" class="form-control mt-3" value="<?php echo $value;?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3"> سطح دوره:</label>
                                            <select name="level" id="">
                                                <option value="1">مقدماتی</option>
                                                <option value="2">متوسط</option>
                                                <option value="3">پیشرفته</option>
                                            </select>
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
                                                <th>تصویر </th>
                                                <th> آدرس </th>
                                                <th>قیمت  </th>
                                                <th>سطح  </th>
                                                <th>تاریخ ثبت  </th>
                                                <th>تاریخ بروزرسانی  </th>
                                                <th>عملیات  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($posts as $post) { ?>
                                                <tr>
                                                <th scope="row"><?= $num++;  ?></th>
                                                <td><?= $post['title'];  ?></td>
                                                <td><img src="<?= $post['image'];  ?>" width="" height="80" alt=""></td>
                                                <td><?= $post['slug'];  ?></td>
                                                <td><?= $post['value'];  ?></td>
                                                <td><?php if ($post['level'] == 1) {
                                                    echo "مقدماتی";
                                                }elseif ($post['level'] == 2) {
                                                    echo "متوسط";
                                                }else {
                                                    echo "پیشرفته";
                                                }?>
                                                </td>
                                                <td><?= jdate('Y-m-d', );  ?></td>
                                                <td><?= jdate('Y-m-d');  ?></td>

                                                <td>
                                                    <a href="editcourse.php?id=<?php echo $post['id'] ?>" class="btn btn-warning">ویرایش</a>
                                                    <a href="deletecourse.php?id=<?php echo $post['id'] ?>" class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr>
                                            <?php  } ?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                </div>
                                
                                </div>  

                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


<?php  include "footer.php";   ?>