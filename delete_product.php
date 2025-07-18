<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Product ID missing");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_product.php?message=Product+deleted+successfully");
    exit;
} else {
    echo "Error deleting product.";
}
?>
