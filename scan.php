<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Code</title>
    <!-- ✅ Part A: Load QR Scanner Library -->
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body>

<h2>📷 Scan Product QR</h2>
<a href="add_product.php">➕ Add Product</a> | <a href="view_product.php">📦 View Products</a>
<br><br>

<!-- Camera scanner area -->
<div id="reader" style="width:300px;"></div>

<!-- ✅ Part B: JavaScript to handle scanning -->
<script>
    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" }, // Use rear camera if available
        { fps: 10, qrbox: 250 },
        (qrCodeMessage) => {
            // ✅ When QR is scanned:
            // 1. Stop scanner
            // 2. Redirect to view_single_product.php?sku=...
            html5QrCode.stop().then(() => {
                window.location.href = "view_single_product.php?sku=" + encodeURIComponent(qrCodeMessage);
            }).catch(err => console.error("Stop failed", err));
        },
        (errorMessage) => {
            // Ignore scan errors for now
        }
    );
</script>

</body>
</html>
