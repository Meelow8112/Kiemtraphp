<?php
$username = "root"; 
$password = "root"; 
$database = "ql_nhansu"; 
$mysqli = new mysqli("localhost", $username, $password, $database); 

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ma_nv = $_POST["ma_nv"];
    $ten_nv = $_POST["ten_nv"];
    $phai = $_POST["phai"];
    $noi_sinh = $_POST["noi_sinh"];
    $luong = $_POST["luong"];
    $ma_phong = $_POST["ma_phong"];

    $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Luong, Ma_Phong) 
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$luong', '$ma_phong')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Thêm nhân viên thành công!";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
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
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        select {
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
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm nhân viên</h2>
        <form action="" method="POST">
            <label for="ma_nv">Mã nhân viên:</label>
            <input type="text" id="ma_nv" name="ma_nv" required>
            <label for="ten_nv">Tên nhân viên:</label>
            <input type="text" id="ten_nv" name="ten_nv" required>
            <label for="phai">Phái:</label>
            <select id="phai" name="phai">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
            <label for="noi_sinh">Nơi sinh:</label>
            <input type="text" id="noi_sinh" name="noi_sinh" required>
            <label for="luong">Lương:</label>
            <input type="text" id="luong" name="luong" required>
            <label for="ma_phong">Mã phòng:</label>
            <input type="text" id="ma_phong" name="ma_phong" required>
            <input type="submit" value="Thêm">
        </form>
    </div>
</body>
</html>
