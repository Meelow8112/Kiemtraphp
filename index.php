<?php 
$username = "root"; 
$password = "root"; 
$database = "ql_nhansu"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$employees_per_page = 5;
$start = ($page - 1) * $employees_per_page;
$query_list = "SELECT * FROM nhanvien LIMIT $start, $employees_per_page";
$result_list = $mysqli->query($query_list);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý nhân viên</title>
    <style>
        h2{
            text-align: center;
        }
        .employee-table {
            max-height: 400px; 
            overflow-y: auto; 
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
            </tr>
            <?php 
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
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- Phân trang -->
    <?php 
    // Truy vấn tổng số lượng nhân viên
    $total_employees_query = "SELECT COUNT(*) AS total FROM nhanvien";
    $total_result = $mysqli->query($total_employees_query);
    $total_employees = $total_result->fetch_assoc()['total'];

    // Tính số trang
    $total_pages = ceil($total_employees / $employees_per_page);

    // Hiển thị liên kết phân trang
    echo "<div>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i'>$i</a> ";
    }
    echo "</div>";
    ?>

</body>
</html>
