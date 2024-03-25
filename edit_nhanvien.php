<?php
// Kết nối đến cơ sở dữ liệu
$username = "root";
$password = "root";
$database = "ql_nhansu";
$mysqli = new mysqli("localhost", $username, $password, $database);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Kiểm tra xem có id nhân viên được truyền từ URL hay không
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Truy vấn để lấy thông tin của nhân viên cần chỉnh sửa
    $query_select = "SELECT * FROM nhanvien WHERE Ma_NV = '$id'";
    $result_select = $mysqli->query($query_select);
    
    // Kiểm tra xem có dữ liệu trả về hay không
    if($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        
        // Lấy thông tin của nhân viên
        $ma_nv = $row['Ma_NV'];
        $ten_nv = $row['Ten_NV'];
        $phai = $row['Phai'];
        $noi_sinh = $row['Noi_Sinh'];
        $luong = $row['Luong'];
        $ma_phong = $row['Ma_Phong'];
    } else {
        echo "Không tìm thấy nhân viên!";
        exit();
    }
} else {
    echo "Không có ID nhân viên!";
    exit();
}

// Xử lý khi người dùng gửi form chỉnh sửa
if(isset($_POST['submit_edit'])) {
    $ma_nv_edit = $_POST['ma_nv_edit'];
    $ten_nv_edit = $_POST['ten_nv_edit'];
    $phai_edit = $_POST['phai_edit'];
    $noi_sinh_edit = $_POST['noi_sinh_edit'];
    $luong_edit = $_POST['luong_edit'];
    $ma_phong_edit = $_POST['ma_phong_edit'];
    
    // Truy vấn để cập nhật thông tin nhân viên
    $query_edit = "UPDATE nhanvien SET Ten_NV = '$ten_nv_edit', Phai = '$phai_edit', Noi_Sinh = '$noi_sinh_edit', 
                   Luong = '$luong_edit', Ma_Phong = '$ma_phong_edit' WHERE Ma_NV = '$ma_nv_edit'";
    
    $result_edit = $mysqli->query($query_edit);
    if($result_edit) {
        echo "Cập nhật thông tin nhân viên thành công!";
    } else {
        echo "Cập nhật thông tin nhân viên thất bại: " . $mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thông tin nhân viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh sửa thông tin nhân viên</h2>
        <form action="" method="POST">
            <label for="ma_nv_edit">Mã nhân viên:</label>
            <input type="text" id="ma_nv_edit" name="ma_nv_edit" value="<?php echo $ma_nv; ?>" readonly><br>
            <label for="ten_nv_edit">Tên nhân viên:</label>
            <input type="text" id="ten_nv_edit" name="ten_nv_edit" value="<?php echo $ten_nv; ?>" required><br>
            <label for="phai_edit">Phái:</label>
            <select id="phai_edit" name="phai_edit">
                <option value="Nam" <?php if($phai == 'Nam') echo 'selected'; ?>>Nam</option>
                <option value="Nữ" <?php if($phai == 'Nữ') echo 'selected'; ?>>Nữ</option>
            </select><br>
            <label for="noi_sinh_edit">Nơi sinh:</label>
            <input type="text" id="noi_sinh_edit" name="noi_sinh_edit" value="<?php echo $noi_sinh; ?>" required><br>
            <label for="luong_edit">Lương:</label>
            <input type="text" id="luong_edit" name="luong_edit" value="<?php echo $luong; ?>" required><br>
            <label for="ma_phong_edit">Mã phòng:</label>
            <input type="text" id="ma_phong_edit" name="ma_phong_edit" value="<?php echo $ma_phong; ?>" required><br>
            <input type="submit" name="submit_edit" value="Cập nhật">
        </form>
    </div>
</body>
</html>
