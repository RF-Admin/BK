<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $phone_number = $_POST['phone_number'];

    try {
        $sql = "SELECT PhoneNumber FROM bk.Users WHERE PhoneNumber = :phone_number";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':phone_number' => $phone_number]);
        $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_user) {
            echo "This phone number is already registered.";
        } else {
            $sql = "INSERT INTO bk.Users (Username, PasswordHash, Email, PhoneNumber, UserLevel) 
                    VALUES (:username, :password, :email, :phone_number, 'user')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':username' => $username,
                ':password' => $password,
                ':email' => $email,
                ':phone_number' => $phone_number
            ]);
            echo "Registration successful!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

