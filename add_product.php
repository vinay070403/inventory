<?php
include 'db.php';
require_once __DIR__ . '/lib/phpqrcode/qrlib.php';


// Function to add product to DB
function addProduct($conn, $name, $sku, $quantity)
{
    $sql = "INSERT INTO products (name, sku, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $sku, $quantity);
    return $stmt->execute();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $sku = $_POST['sku'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);

    if ($name && $sku) {
        if (addProduct($conn, $name, $sku, $quantity)) {

            // Generate QR code image for SKU

            $qrPath = 'qr/' . $sku . '.png';
            QRcode::png($sku, $qrPath, QR_ECLEVEL_L, 4);

            $message = "Product added successfully! QR code generated.";
        } else {
            $message = "Error: Could not add product. SKU might already exist.";
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product</title>
</head>

<body>

    <h2>Add New Product</h2>

    <?php if ($message): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>SKU (unique):</label><br>
        <input type="text" name="sku" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="0" min="0"><br><br>

        <button type="submit">Add Product</button>
    </form>

    <br>
    <a href="view_product.php">View Products</a> | <a href="scan.php">Scan QR</a>

</body>

</html>