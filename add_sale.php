<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sale</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            animation: fadeSlide 0.6s ease-out;
            margin-top: 40px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }

        .back-btn {
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .back-btn a:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🧾 Add New Sale</h2>
        <form method="post">
            <label>Order Date:</label>
            <input type="date" name="order_date" required>

            <label>Customer Name:</label>
            <input type="text" name="customer_name" required>

            <label>Quantity:</label>
            <input type="number" name="quantity" required>

            <label>Buying Price (₹):</label>
            <input type="number" step="0.01" name="buying_price" required>

            <label>Selling Price (₹):</label>
            <input type="number" step="0.01" name="selling_price" required>

            <input type="submit" name="submit" value="Add Sale">
        </form>

        <div class="back-btn">
            <a href="dashbord.php">⬅ Back to Dashboard</a>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $order_date = $_POST['order_date'];
            $customer_name = $_POST['customer_name'];
            $quantity = $_POST['quantity'];
            $buying_price = $_POST['buying_price'];
            $selling_price = $_POST['selling_price'];

            $sql = "INSERT INTO sales (order_date, customer_name, quantity, buying_price, selling_price)
                    VALUES ('$order_date', '$customer_name', '$quantity', '$buying_price', '$selling_price')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='message' style='color:green;'>✅ Sale added successfully.</p>";
            } else {
                echo "<p class='message' style='color:red;'>❌ Error: " . $conn->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
