<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['phone_number'];

    try {
        $sql = "SELECT PhoneNumber FROM bk.Users WHERE PhoneNumber = :phone_number";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':phone_number' => $phone_number]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo 'exists';
        } else {
            echo 'available';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
