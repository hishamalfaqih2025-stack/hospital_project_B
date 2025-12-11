<?php
include 'config.php';

// Unified add for doctor or patient
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$type = $_POST['type'] ?? '';

if ($type === 'doctor') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO doctors (name, specialty, phone) VALUES ('$name', '$specialty', '$phone')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=doctor_added');
        exit;
    } else {
        die('Error: ' . mysqli_error($conn));
    }

} elseif ($type === 'patient') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];
    $doctor_id = ($_POST['doctor_id'] === '') ? "NULL" : (int)$_POST['doctor_id'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO patient (name, age, doctor_id, phone) VALUES ('$name', $age, $doctor_id, '$phone')";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?msg=patient_added');
        exit;
    } else {
        die('Error: ' . mysqli_error($conn));
    }
} else {
    header('Location: index.php');
    exit;
}
?>
