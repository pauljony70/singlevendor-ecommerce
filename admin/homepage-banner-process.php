<?php
include('session.php');
include('common_functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    $code = isset($_POST['code']) ? $_POST['code'] : '';

    if ($code !== $_SESSION['_token']) {
        $response = array('status' => 'error', 'message' => 'Invalid CSRF token');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $id = $_POST['id'];
    $link = $_POST['uploadLink'];
    $formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

    if ($formType === 'imageUpload') {
        // Handle image upload
        $uploadData = secureImageUpload($_FILES['image'], '../media/'); // Adjust the path as needed

        // Check if the file upload was successful
        if ($uploadData['status'] === 'success') {
            // File uploaded successfully, proceed with the database update

            // Extract the file path from the upload response
            $uploadFile = $uploadData['filePath'];

            // Fetch the old image path from the database
            $sqlFetchOldImage = "SELECT image FROM homepage_banner WHERE id = ?";
            $stmtFetchOldImage = $conn->prepare($sqlFetchOldImage);
            $stmtFetchOldImage->bind_param("i", $id);
            $stmtFetchOldImage->execute();
            $stmtFetchOldImage->bind_result($oldImagePath);
            $stmtFetchOldImage->fetch();
            $stmtFetchOldImage->close();

            // Check if the old image path exists and is different from the new one
            if ($oldImagePath && $oldImagePath !== $uploadFile) {
                // Remove the old image file
                $oldImageFile = '../media/' . $oldImagePath;

                if (file_exists($oldImageFile)) {
                    unlink($oldImageFile);
                }
            }

            // Prepare and execute the SQL query
            $sqlUpdate = "UPDATE homepage_banner SET link = ?, image = ? WHERE id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ssi", $link, $uploadFile, $id);

            if ($stmtUpdate->execute()) {
                $response = array('status' => 'success', 'message' => 'Banner updated successfully', 'data' => array('filePath' => $uploadFile, 'link' => $link));
            } else {
                $response = array('status' => 'error', 'message' => 'Error updating banner: ' . $stmtUpdate->error);
            }

            // Close the statement
            $stmtUpdate->close();
        } else {
            // Error during file upload
            $response = array('status' => 'error', 'message' => 'Error uploading file.', 'filePath' => null);
        }
    } elseif ($formType === 'buttonUpload') {
        // Handle text input (button upload)
        $linkText = isset($_POST['image']) ? $_POST['image'] : '';

        // Prepare and execute the SQL query
        $sqlUpdate = "UPDATE homepage_banner SET link = ?, image = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ssi", $link, $linkText, $id);

        if ($stmtUpdate->execute()) {
            $response = array('status' => 'success', 'message' => 'Button updated successfully',  'data' => array('linkText' => $linkText, 'link' => $link));
        } else {
            $response = array('status' => 'error', 'message' => 'Error updating button: ' . $stmtUpdate->error);
        }

        // Close the statement
        $stmtUpdate->close();
    } else {
        // Invalid form type
        $response = array('status' => 'error', 'message' => 'Invalid form type');
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request
    header('HTTP/1.1 400 Bad Request');
    exit();
}
