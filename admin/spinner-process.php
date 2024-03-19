<?php
include('session.php');
include('common_functions.php');

global $conn;

$code = stripslashes($_POST['code']);
$id = stripslashes($_POST['id']);
$name = stripslashes($_POST['name']);
$value = stripslashes($_POST['value']);

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

if ($code == $_SESSION['_token'] && !empty($name) && !empty($value)) {
    $stmt12 = $conn->prepare("SELECT count(id) FROM spinners WHERE name = ? AND id != ?");
    $stmt12->bind_param("si", $name, $id);
    $stmt12->execute();
    $stmt12->store_result();
    $stmt12->bind_result($col55);

    while ($stmt12->fetch()) {
        $totalrow = $col55;
    }

    if ($totalrow == 0) {
        $image_array = secureImageUpload($_FILES['image'], '../media/');
        $image = '';
        if ($image_array['status'] === 'success') {
            $image = $image_array['filePath'];
        }

        $stmt11 = $conn->prepare("UPDATE spinners SET name = ?, value = ?, image = ? WHERE id = ?");
        $stmt11->bind_param("sssi", $name, $value, $image, $id);

        $stmt11->execute();
        $stmt11->store_result();

        echo "Spinner Updated Successfully.";
    } else {
        echo "Spinner already exists.";
    }
} else {
    echo "Invalid values.";
}
