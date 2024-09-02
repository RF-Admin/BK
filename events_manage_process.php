<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $action = $_POST['action'];

    try {
        if ($action == 'delete') {
            $sql = "UPDATE bk.Events SET IsDeleted = 1 WHERE EventID = :event_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':event_id' => $event_id]);
            echo "Event marked as deleted.";
        } elseif ($action == 'update') {
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $event_type = $_POST['event_type'];
            $max_players = $_POST['max_players'];

            $sql = "UPDATE bk.Events
                    SET StartTime = :start_time, EndTime = :end_time, EventType = :event_type, MaxPlayers = :max_players
                    WHERE EventID = :event_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':start_time' => $start_time,
                ':end_time' => $end_time,
                ':event_type' => $event_type,
                ':max_players' => $max_players,
                ':event_id' => $event_id
            ]);
            echo "Event updated successfully!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
