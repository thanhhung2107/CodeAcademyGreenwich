<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
session_start();

// NHÁNH 1: KHI BẠN BẤM NÚT "SAVE CHANGES" (CÓ DỮ LIỆU POST)
if (isset($_POST['name'])) {
    try {
        // 1. Gọi hàm Update dữ liệu (Bạn nhớ viết hàm updateUser bên file function nhé)
        updateUser($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
        
        // 2. Chuyển hướng người dùng về lại trang danh sách
        header('Location: users.php'); 
        
        // 3. CHỖ NÀY CỰC KỲ QUAN TRỌNG: Lệnh exit để ép code dừng lại!
        // Nếu không có exit, nó sẽ chạy tuột xuống dòng 28 và báo lỗi $output
        exit(); 

    } catch (PDOException $e) {
        // Nếu lỗi DB thì báo lỗi vào biến output
        $title = 'Error';
        $output = 'Database error: ' . $e->getMessage();
    }
} 
// NHÁNH 2: KHI BẠN MỚI BẤM VÀO NÚT "EDIT" TỪ TRANG DANH SÁCH
else {
    // Kéo dữ liệu cũ từ DB lên
    $id = $_POST['id'] ?? $_GET['id'] ?? 0;
    $user = getUser($pdo, $id); 
    
    $title = 'Edit User';

    // BẮT BUỘC PHẢI CÓ 3 DÒNG NÀY ĐỂ TẠO BIẾN $output
    ob_start(); // Mở bộ đệm
    include 'templates/editusers.html.php'; // Gọi giao diện form ra
    $output = ob_get_clean(); // Đóng bộ đệm và gom hết HTML vào biến $output
}

// Dòng 28: Cuối cùng mới gọi layout. Nếu bị rớt xuống đây mà chưa có $output là sẽ báo lỗi dòng 49 ngay!
include 'templates/layout.html.php';
?>