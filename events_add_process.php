<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_id = $_POST['location_id'];
    $event_date = $_POST['event_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $max_players = $_POST['max_players'];
    $event_type = $_POST['event_type'];

    try {
        $sql = "INSERT INTO bk.Events (LocationID, EventDate, StartTime, EndTime, MaxPlayers, EventType)
                VALUES (:location_id, :event_date, :start_time, :end_time, :max_players, :event_type)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':location_id' => $location_id,
            ':event_date' => $event_date,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':max_players' => $max_players,
            ':event_type' => $event_type
        ]);
        echo "Event added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

