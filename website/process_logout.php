<?php
session_start();
include 'db_connection_userroles.php';

$response = [];

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username'];

    $stmt = $conn_users->prepare("SELECT id FROM Users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $stmt = $conn_users->prepare("INSERT INTO UserRoles (user_id, action) VALUES (?, 'Logout')");
        $stmt->bind_param("i", $user['id']);
        $stmt->execute();

        $response['status'] = 'success';
        $response['message'] = "ออกจากระบบสำเร็จ ลาก่อน $user_id";
    } else {
        $response['status'] = 'error';
        $response['message'] = 'ไม่พบข้อมูลผู้ใช้ในระบบ';
    }
}

session_unset();
session_destroy();

echo json_encode($response);
exit();
?>
