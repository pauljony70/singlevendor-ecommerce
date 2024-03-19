<?php
header('Content-Type: application/json');

include('session.php');
include('common_functions.php');

$uploadData = secureImageUpload($_FILES['file'], '../media/'); // Adjust the path as needed

if ($uploadData['status'] === 'success') {
    // File uploaded successfully, proceed with the database update
    $response = array(
        'status' => 'success',
        'message' => 'Image uploaded successfully',
        'data' => array(
            'filePath' => $uploadData['filePath'], // Assuming this is the correct key from your $uploadData array
            'link' => $uploadData['link'] // Assuming this is the correct key from your $uploadData array
        )
    );
} else {
    // Error during file upload
    $response = array(
        'status' => 'error',
        'message' => 'Error uploading file.',
        'data' => array('filePath' => null)
    );
}

echo json_encode($response);
