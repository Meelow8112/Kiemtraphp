<?php 
$username = "root"; 
$password = "root"; 
$database = "ql_nhansu"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 

// Chức năng Xóa nhân viên
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM nhanvien WHERE Ma_NV = '$delete_id'";
    $result_delete = $mysqli->query($query_delete);
    if($result_delete) {
        echo "Xóa nhân viên thành công!";
    } else {
        echo "Xóa nhân viên thất bại: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý nhân viên</title>
    <style>
        .employee-table {
            max-height: 400px; /* Điều chỉnh chiều cao tối đa của bảng */
            overflow-y: auto; /* Cho phép cuộn nếu bảng quá cao */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Quản lý nhân viên</h2>
    <a href='./add_nhanvien.php'>Thêm nhân viên</a>
    <!-- Danh sách nhân viên -->
    <div class="employee-table">
        <table>
            <tr>
                <th>Mã NV</th>
                <th>Tên NV</th>
                <th>Phái</th>
                <th>Nơi sinh</th>
                <th>Lương</th>
                <th>Mã phòng</th>
                <th>Thao tác</th>
            </tr>
            <?php 
            $query_list = "SELECT * FROM nhanvien";
            $result_list = $mysqli->query($query_list);
            while ($row = $result_list->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['Ma_NV']."</td>";
                echo "<td>".$row['Ten_NV']."</td>";
                echo "<td>";
                if ($row["Phai"] == "NAM") {
                    echo "<img src='assets/man.jpg' alt='Man' width='50px'>";
                } else {
                    echo "<img src='assets/woman.png' alt='Woman' width='50px'>";
                }
                echo "</td>";
                echo "<td>".$row['Noi_Sinh']."</td>";
                echo "<td>".$row['Luong']."</td>";
                echo "<td>".$row['Ma_Phong']."</td>";
                echo "<td><a href='?delete_id=".$row['Ma_NV']."'>Xóa</a> | <a href='./edit_nhanvien.php?id=".$row['Ma_NV']."'>Sửa</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
