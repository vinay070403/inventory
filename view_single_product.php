<?php
include 'db.php';

$sku = $_GET['sku'] ?? '';
$product = null;

if ($sku) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE sku = ?");
    $stmt->bind_param("s", $sku);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head><title>Product Details</title></head>
<body>

<h2>🔍 Product Info</h2>
<a href="scan.php">🔙 Scan Another</a> | <a href="view_product.php">📦 All Products</a>
<br><br>

<?php if ($product): ?>
    <p><strong>Name:</strong> <?= htmlspecialchars($product['name']) ?></p>
    <p><strong>SKU:</strong> <?= htmlspecialchars($product['sku']) ?></p>
    <p><strong>Quantity:</strong> <?= $product['quantity'] ?></p>
    <p><strong>QR Code:</strong><br>
        <img src="qr/<?= htmlspecialchars($product['sku']) ?>.png" width="150">
    </p>
<?php else: ?>
    <p><strong>Product not found for SKU: <?= htmlspecialchars($sku) ?></strong></p>
<?php endif; ?>

</body>
</html>
