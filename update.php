<?php
include 'config.php';

// Unified update for doctor or patient
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$type = $_POST['type'] ?? '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    die('معرف غير صالح');
}

if ($type === 'doctor') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "UPDATE doctors SET name='$name', specialty='$specialty', phone='$phone' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=doctor_updated');
        exit;
    } else {
        die('Error: ' . mysqli_error($conn));
    }
} elseif ($type === 'patient') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];
    $doctor_id = ($_POST['doctor_id'] === '') ? "NULL" : (int)$_POST['doctor_id'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "UPDATE patient SET name='$name', age=$age, doctor_id=$doctor_id, phone='$phone' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=patient_updated');
        exit;
    } else {
        die('Error: ' . mysqli_error($conn));
    }
} else {
    header('Location: index.php');
    exit;
}
?>
