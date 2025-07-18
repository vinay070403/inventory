# 📚 Inventory Management System with QR Code (PHP + MySQL)

Hey! This is a mini PHP project made by me where we can manage products like in a small shop. For every product, we also generate a **QR Code** based on its **SKU**. That QR code can be scanned later to identify the product.

---

## 🧠 What This Project Does

- Add new products (like phone, pen, etc.)
- Enter a unique code for each product (SKU)
- It automatically creates a QR code from that SKU
- You can see all products in a table
- You can delete any product
- It saves everything in a database (MySQL)

---

## 🎯 Technologies Used

- PHP (for backend logic)
- MySQL (to store products)
- HTML/CSS (basic design)
- phpqrcode library (to generate QR images)

---

## 🧪 How to Set It Up (Step by Step)

### Step 1: Install XAMPP

- Download from: https://www.apachefriends.org/index.html
- Install it and run **Apache** and **MySQL**

---

### Step 2: Put This Project in `htdocs`

- Copy the project folder to:  
  `C:/xampp/htdocs/inventory/`

---

## Step 3: Create Database

1. Open browser → go to `http://localhost/phpmyadmin`
2. Create a database called: `inventory`
3. Inside that DB, run this SQL:

## Step 4 Edit  (db.php)

Make sure this file has your DB connection:

 CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `sku` VARCHAR(100) NOT NULL UNIQUE,
  `quantity` INT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
Step 4: Edit db.php
Make sure this file has your DB connection:

php
Copy
Edit
<?php
$conn = new mysqli("localhost", "root", "", "inventory");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

## Step 5: Enable GD Extension

For QR code to work, do this:

Open php.ini file (in xampp/php)

Find this line:
;extension=gd

Remove the ; → it becomes:
extension=gd

Save it and restart Apache

## Step 6: Run the Project
Open browser and go to:
### http://localhost/inventory/add_product.php


✍️ Made By
👨‍🎓 Name: vinay chavada

🎓 Class/Batch: 2021-2025

#"I created an inventory system in PHP where we can add products and generate a QR code using the SKU. I used phpqrcode library for QR creation, and MySQL for storing product details. The system also lets us delete items and see all product data in one place."

