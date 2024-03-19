<?php

include('db_connection.php');
$language   = htmlentities($_POST['language']);
$securecode = htmlentities($_POST['securecode']);
$user_id = htmlentities($_POST['user_id']);

if (isset($language)  && !empty($language) && isset($securecode)  && !empty($securecode) && !empty($user_id)) {
    global $conn;

    if ($conn->connect_error) {
        die(" connecction has failed " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM spinners");
    $stmt->execute();
    $result = $stmt->get_result();
    $spinner_details = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    if (!empty($spinner_details)) {
        foreach ($spinner_details as &$spinner) {
            if ($spinner['image']) {
                $spinner['image'] = MEDIA_URL . $spinner['image'];
            }
        }
        $response = [
            'status' => 1,
            'msg' => 'Spinner details',
            'Information' => $spinner_details
        ];
    } else {
        $response = [
            'status' => 0,
            'msg' => 'No Spinner data found',
            'Information' => []
        ];
    }

    echo json_encode($response);

    $conn->close();
}
