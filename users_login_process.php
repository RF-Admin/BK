<?php
include 'db_connect.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM bk.Users WHERE PhoneNumber = :phone_number";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':phone_number' => $phone_number]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PasswordHash'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];
            echo "Login successful!";
        } else {
            echo "Invalid phone number or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

