<?php
include 'db_connection_userroles.php';
header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
    } elseif ($action == 'delete') {
    } elseif ($action == 'edit') {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $role = $_POST['role'];

        $stmt = $conn_users->prepare("UPDATE Users SET name = ?, lastname = ?, user_id = ?, status = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $name, $lastname, $user_id, $status, $role, $id);

        if ($stmt->execute()) {

            $response['success'] = true;
            $response['user'] = [
                'id' => $id,
                'name' => $name,
                'lastname' => $lastname,
                'user_id' => $user_id,
                'status' => $status,
                'role' => $role
            ];
        } else {
            $response['message'] = "Failed to update user in database.";
        }

        $stmt->close();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] == 'get_user') {
    $id = $_GET['id'];
    $stmt = $conn_users->prepare("SELECT * FROM Users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $response['success'] = true;
        $response['user'] = $result;
    }

    $stmt->close();
}

echo json_encode($response);
$conn_users->close();
?>
