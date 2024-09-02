<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $location_name = $_POST['location_name'];

    try {
        $sql = "INSERT INTO bk.Locations (LocationName) VALUES (:location_name)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':location_name' => $location_name]);
        echo "Location added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
