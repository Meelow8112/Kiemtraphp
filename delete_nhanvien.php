<?php
// Chức năng Xóa nhân viên
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM nhanvien WHERE Ma_NV = ?";
    $stmt = $mysqli->prepare($query_delete);
    $stmt->bind_param("s", $delete_id);
    if($stmt->execute()) {
        echo "Xóa nhân viên thành công!";
    } else {
        echo "Xóa nhân viên thất bại: " . $mysqli->error;
    }
    $stmt->close();
}
?>
