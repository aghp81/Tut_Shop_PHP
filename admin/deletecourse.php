<?php
include "../database/db.php";

$result = $conn->prepare('DELETE FROM course WHERE id=?');
$result->bindValue(1, $_GET['id']);
$result->execute();

echo '<script>alert ("دوره با موفقیت حذف شد");
    window.location = "course.php";
</script>';


?>