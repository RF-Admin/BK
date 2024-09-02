<?php
include 'db_connect.php';

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];

    try {
        $sql = "UPDATE bk.EventRegistrations SET Cancelled = 1 WHERE EventID = :event_id AND UserID = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':event_id' => $event_id,
            ':user_id' => $user_id
        ]);
        echo "Registration cancelled successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
