<?php
include "../database/db.php";

$result = $conn->prepare('DELETE FROM menu WHERE id=?');
$result->bindValue(1, $_GET['id']);
$result->execute();

echo '<script>alert ("منو با موفقیت حذف شد");
    window.location = "menu.php";
</script>';


?>