<?php
include 'db_connect.php';

session_start();
$user_id = $_SESSION['user_id'];

try {
    $sql = "SELECT e.EventID, e.EventDate, e.StartTime, e.EndTime, er.Status
            FROM bk.EventRegistrations er
            JOIN bk.Events e ON er.EventID = e.EventID
            WHERE er.UserID = :user_id AND er.Cancelled = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $user_id]);

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($events as $event) {
        echo "Event ID: " . $event['EventID'] . "<br>";
        echo "Event Date: " . $event['EventDate'] . "<br>";
        echo "Start Time: " . $event['StartTime'] . "<br>";
        echo "End Time: " . $event['EndTime'] . "<br>";
        echo "Status: " . $event['Status'] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
