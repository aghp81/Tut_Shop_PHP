<?php
  include "header.php";

  $successadd = null;
  $id = $_GET['id'];
  $titleErr = $contentErr = $imagetErr = "";
  $title= $content = $image = $tag = $slug =  $value = $level = $tagErr = $valueErr = $introtErr = "";


  // insert
  
  if(isset($_POST['sub'])) {
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $tag = $_POST['tag'];
    $slug = $_POST['slug'];
    $value = $_POST['value'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    $intro = $_POST['intro'];


    
    if (empty($_POST['title'])) {
        $titleErr = "عنوان دوره الزامی است.";
    } elseif(empty($_POST['content'])) {
        $contentErr = "توضیحات دوره الزامی است.";
    }elseif(empty($_POST['image'])) {
        $imagetErr = "تصویر دوره الزامی است.";
    }elseif(empty($_POST['tag'])) {
        $tagErr = "برچسب دوره الزامی است.";
    }elseif(empty($_POST['value'])) {
        $valueErr = "قیمت دوره الزامی است.";
    }
    elseif(empty($_POST['intro'])) {
        $introtErr = "ویدئوی معرفی دوره الزامی است.";
    }else{
    
    $result = $conn->prepare('UPDATE  course SET title=?, content=?, image=?, tag=?, slug=?, value=?, level=?, update_date=?, status=?, intro=? WHERE id=?');

    $result->bindValue(1, $title);
    $result->bindValue(2, $content);
    $result->bindValue(3, $image);
    $result->bindValue(4, $tag);
    $result->bindValue(5, $slug);
    $result->bindValue(6, $value);
    $result->bindValue(7, $level);
    $result->bindValue(8, time());
    $result->bindValue(9, $status);
    $result->bindValue(10, $intro);
    $result->bindValue(11, $id);
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

  // فچ کردن یک ردیف از جدول کورس برای نمایش در جدول
  $result = $conn->prepare("SELECT * FROM course WHERE id=?");
  $result->bindValue(1, $id);
  $result->execute();
  $post = $result->fetch(PDO::FETCH_ASSOC);
//   var_dump($post);


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
                                            echo '<p class="alert alert-success">دوره موردنظر با موفقیت ویرایش شد.</p>
                                            <script> window.location = "course.php";</script>';
                                           
                                        }

                            ?>
                                <h3 class="mb-2">افزودن دوره آموزشی</h3>

                                <div class="row">
                                    <form  action="" method="POST" enctype="multipart/form-data" class="col-lg-9">
                                        <div class="form-group">
                                        <label for="" class="mt-3">عنوان دوره آموزشی</label>
                                            <input type="text" name="title" class="form-control mt-3" value="<?= $post['title']; ?>" >
                                            <span class="error"> <?php echo $titleErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="">توضیحات</label>
                                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control mt-3" placeholder="توضیحات"><?= $post['content']; ?></textarea>
                                            <span class="error"> <?php echo $contentErr; ?></span>
                                       </div>

                                       <div class="form-group">
                                            <label for="" class="mt-3">  تصویر</label>
                                            <input type="text" name="image" class="form-control mt-3" value="<?= $post['image']; ?>">
                                            <span class="error"> <?php echo $imagetErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">  ویدئوی معرفی دوره</label>
                                            <input type="text" name="intro" class="form-control mt-3">
                                            <span class="error"> <?php echo $introtErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">  برچسب ها</label>
                                            <input type="text" name="tag" class="form-control mt-3" value="<?= $post['tag']; ?>">
                                            <span class="error"> <?php echo $tagErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">آدرس اینترنتی</label>
                                            <input type="text" name="slug" class="form-control mt-3" value="<?= $post['slug']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3">قیمت</label>
                                            <input type="text" name="value" class="form-control mt-3" value="<?= $post['value']; ?>">
                                            <span class="error"> <?php echo $valueErr; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="mt-3"> سطح دوره:</label>
                                            <select name="level" id="">
                                                <option value="1" <?php if($post['level'] == 1) : ?> selected <?php  endif; ?>>مقدماتی</option>
                                                <option value="2" <?php if($post['level'] == 2) : ?> selected <?php  endif; ?>>متوسط</option>
                                                <option value="3" <?php if($post['level'] == 3) : ?> selected <?php  endif; ?>>پیشرفته</option>
                                            </select>
                                        </div>

                                        <br>
                                        <div class="form-check mt-3">
                                            <label for="" class="mt-3">وضعیت دوره</label>
                                            <br>
                                            <input type="radio" name="status" class="form-check-input"  value="1" <?php if($post['status'] == 1) : ?> checked <?php  endif; ?>>
                                            <label for="" class="form-check-label">تکمیل شده </label>
                                                                                       
                                            <input type="radio" name="status" class="form-check-input"  value="0" <?php if($post['status'] == 0) : ?> checked <?php  endif; ?>>
                                            <label for="" class="form-check-label">در حال برگزاری  </label>
                                        </div>

                                        <br>


                                        <div class="form-group">
                                            <input type="submit" name="sub" class="btn btn-success" value="ویرایش دوره">
                                            <a href="course.php" class="btn btn-danger">بازگشت</a>
                                        </div>

                                    </form>


                                </div>

                                </div>
                                
                                </div>  

                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


<?php  include "footer.php";   ?>