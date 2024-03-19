<?php
// common-attribute-process.php
include('session.php');
include('common_functions.php');

if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}


function addNewNavigation($code, $name)
{
    global $conn;

    $code = stripslashes($code);
    $name = stripslashes($name);

    if ($code == $_SESSION['_token'] && isset($name) && !empty($name)) {
        // Insert into custom_navigations table
        $insertNavigationQuery = "INSERT INTO custom_navigations (name) VALUES (?)";
        $stmt = $conn->prepare($insertNavigationQuery);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $navigationId = $stmt->insert_id;
        $stmt->close();

        if ($navigationId > 0) {
            // Insert into custom_navigation_products table
            $insertProductQuery = "INSERT INTO custom_navigation_products (navigation_id) VALUES (?)";
            $stmt = $conn->prepare($insertProductQuery);
            for ($i = 0; $i < 4; $i++) {
                $stmt->bind_param("i", $navigationId);
                $stmt->execute();
            }
            $stmt->close();

            echo "Navigation added successfully.";
        } else {
            echo "Failed to insert into custom_navigations.";
        }
    } else {
        echo "Invalid values.";
    }
}

function editNavigation($code, $id, $banner, $products)
{
    global $conn;

    $code = stripslashes($code);
    $id = stripslashes($id);

    if ($code == $_SESSION['_token'] && !empty($id)) {
        // Retrieve existing data from custom_navigation_products using the provided $id
        $selectQuery = "SELECT * FROM custom_navigation_products WHERE id = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        // Check if a new banner file is uploaded
        $imagePath = $row['banner'];
        if ($banner['size'] > 0) {
            unlinkFile($imagePath);
            $imagePath = secureImageUpload($banner, '../media/')['filePath'];
        }

        // Decode existing products in JSON format
        $existingProducts = (!empty($row['products'])) ? json_decode($row['products'], true) : [];

        if (!empty($products)) {
            // Append new products to existing products
            $allProducts = array_merge($existingProducts, $products);

            // Make sure to keep only unique products in the final array
            $allProducts = array_unique($allProducts);
        } else {
            $allProducts = array_unique($existingProducts);
        }

        // Update custom_navigation_products table
        $updateProductsQuery = "UPDATE custom_navigation_products SET banner = ?, products = ? WHERE id = ?";
        $stmt = $conn->prepare($updateProductsQuery);

        // Convert products array to JSON format
        $jsonProducts = json_encode($allProducts);

        $stmt->bind_param("ssi", $imagePath, $jsonProducts, $id);
        $stmt->execute();
        $stmt->close();

        echo "Navigation updated successfully.";
    } else {
        echo "Invalid values.";
    }
}

function deleteNavigation($code, $id)
{
    global $conn;

    $code = stripslashes($code);
    $id = stripslashes($id);

    if ($code == $_SESSION['_token'] && !empty($id)) {
        // Retrieve existing data from custom_navigation_products using the provided $id
        $selectQuery = "SELECT * FROM custom_navigation_products WHERE navigation_id = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Iterate through each row
        while ($row = $result->fetch_assoc()) {
            // Call unlinkFile to delete associated banner
            unlinkFile($row['banner']);

            // Delete from custom_navigation_products
            $deleteQuery = "DELETE FROM custom_navigation_products WHERE id = ?";
            $stmtDelete = $conn->prepare($deleteQuery);
            $stmtDelete->bind_param("i", $row['id']);
            $stmtDelete->execute();
            $stmtDelete->close();
        }

        // Delete from custom_navigations
        $deleteNavigationQuery = "DELETE FROM custom_navigations WHERE id = ?";
        $stmt = $conn->prepare($deleteNavigationQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "Navigation and associated products deleted successfully.";
    } else {
        echo "Invalid values.";
    }
}

function deleteNavigationProduct($code, $custom_navigation_product_id, $product_id)
{
    global $conn;

    $code = stripslashes($code);
    $custom_navigation_product_id = stripslashes($custom_navigation_product_id);
    $product_id = stripslashes($product_id);

    if ($code == $_SESSION['_token'] && !empty($custom_navigation_product_id) && !empty($product_id)) {
        // Retrieve existing data from custom_navigation_products using the provided $custom_navigation_product_id
        $selectQuery = "SELECT * FROM custom_navigation_products WHERE id = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("i", $custom_navigation_product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        // Decode existing products in JSON format
        $existingProducts = (!empty($row['products'])) ? json_decode($row['products'], true) : [];

        // Find the index of the product_id in the existing products array
        $indexToRemove = array_search($product_id, $existingProducts);

        // Check if the product_id exists before attempting to remove it
        if ($indexToRemove !== false) {
            // Remove the product_id from the array
            unset($existingProducts[$indexToRemove]);

            // Reindex the array numerically
            $existingProducts = array_values($existingProducts);

            // Update custom_navigation_products table with the modified products array
            $updateProductsQuery = "UPDATE custom_navigation_products SET products = ? WHERE id = ?";
            $stmt = $conn->prepare($updateProductsQuery);

            // Convert products array to JSON format
            $jsonProducts = json_encode($existingProducts);

            $stmt->bind_param("si", $jsonProducts, $custom_navigation_product_id);
            $stmt->execute();
            $stmt->close();

            echo "Product deleted successfully.";
        } else {
            echo "Product not found in the navigation.";
        }
    } else {
        echo "Invalid values or session token.";
    }
}

// Usage example for add operation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "addNewNavigation" && isset($_POST['navigationName']) && isset($_POST['code'])) {
    addNewNavigation($_POST['code'], $_POST['navigationName']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "editBanner" && $_POST['custom_navigation_product_id'] && $_FILES['banner'] && isset($_POST['code'])) {
    editNavigation($_POST['code'], $_POST['custom_navigation_product_id'], $_FILES['banner'], $_POST['products']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "deleteNavigation" && $_POST['navigation_id'] && isset($_POST['code'])) {
    deleteNavigation($_POST['code'], $_POST['navigation_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type'] === "deleteProduct" && $_POST['custom_navigation_product_id'] && $_POST['product_id'] && isset($_POST['code'])) {
    deleteNavigationProduct($_POST['code'], $_POST['custom_navigation_product_id'], $_POST['product_id']);
}