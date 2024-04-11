<?php
include "../database/db.php";

$id = $_GET['id'];

$result = $conn->prepare('DELETE FROM course WHERE id=?');
$result->bindValue(1, $id);
$result->execute();

echo '<script>alert ("دوره با موفقیت حذف شد");
    window.location = "course.php";
</script>';


?>