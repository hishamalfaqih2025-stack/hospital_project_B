<?php
include 'config.php';

// Unified delete via GET
$type = $_GET['type'] ?? '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

if ($type === 'doctor') {
    // Optionally set patient.doctor_id to NULL before deleting or use foreign key with ON DELETE SET NULL
    $sql = "DELETE FROM doctors WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: index.php?msg=doctor_deleted');
    exit;
} elseif ($type === 'patient') {
    $sql = "DELETE FROM patient WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: index.php?msg=patient_deleted');
    exit;
} else {
    header('Location: index.php');
    exit;
}
?>
