<?php 
include 'db.php';

// fetch all products
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
</head>
<body>
    <h2>📦 Product Inventory</h2>
    <a href="add_product.php">➕ Add Product</a> | <a href="scan.php">📷 Scan QR</a>
    <br><br>

    <?php if (isset($_GET['message'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Quantity</th>
            <th>QR Code</th>
            <th>Action</th> <!-- NEW COLUMN -->
        </tr>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['sku']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>
                    <?php
                        $qrFile = 'qr/' . $row['sku'] . '.png';
                        if (file_exists($qrFile)):
                    ?>
                        <img src="<?= $qrFile ?>" width="100">
                    <?php else: ?>
                        <span>QR not found</span>
                    <?php endif; ?>
                </td>
                <td>
                    <!-- ✅ Delete Link with confirmation -->
                    <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?');">🗑️ Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</body>
</html>
