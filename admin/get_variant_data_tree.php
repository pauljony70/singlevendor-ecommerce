<?php
include('session.php');
$code = $_POST['code'];

$code = "123"; // stripslashes($code);
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
} else if ($code == "123") {

    try {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $return = array();
        $i = 0;

        function variantTree($parent_idv = 0, $sub_mark = '')
        {
            global $conn;
            global $return;
            global $i;
            $query2 = $conn->query("SELECT * FROM product_variant_cat WHERE parent_id = $parent_idv ORDER BY variant_name ASC");
            if ($query2->num_rows > 0) {
                while ($row = $query2->fetch_assoc()) {
                    // Check if the current category has child categories
                    $hasChildCategories = $conn->query("SELECT * FROM product_variant_cat WHERE parent_id = " . $row['variant_id'])->num_rows > 0;

                    // If it has child categories or parent_id is 0, use optgroup
                    if ($hasChildCategories || $parent_idv == 0) {
                        echo '<optgroup label="' . $row['variant_name'] . '">';
                        variantTree($row['variant_id'], $sub_mark . '---');
                        echo '</optgroup>';
                    } else {
                        echo '<option value="' . $row['variant_name'] . '">' . $sub_mark . $row['variant_name'] . '</option>';
                    }

                    $return[$i] = array(
                        'id' => $row['variant_id'],
                        'name' => $sub_mark . $row['variant_name']
                    );
                    $i++;
                }
            }
        }
        variantTree();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
