<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense</title>
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
            animation: slideIn 0.6s ease-out;
            margin-top: 40px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message {
            margin-top: 20px;
            text-align: center;
            color: green;
            font-weight: bold;
        }

        .back-btn {
            display: block;
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
        <h2>➕ Add New Expense</h2>
        <form method="post">
            <label>Expense Date:</label>
            <input type="date" name="expense_date" required>

            <label>Category:</label>
            <select name="category" required>
                <option value="transportation">Transportation</option>
                <option value="petrol">Petrol</option>
                <option value="banner">Banner</option>
                <option value="other">Other</option>
            </select>

            <label>Amount (₹):</label>
            <input type="number" step="0.01" name="amount" required>

            <label>Description:</label>
            <input type="text" name="description">

            <input type="submit" name="submit" value="Add Expense">
        </form>

        <div class="back-btn">
            <a href="dashbord.php">⬅ Back to Dashboard</a>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $expense_date = $_POST['expense_date'];
            $category = $_POST['category'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];

            $sql = "INSERT INTO expenses (expense_date, category, amount, description)
                    VALUES ('$expense_date', '$category', '$amount', '$description')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='message'>✅ Expense added successfully.</p>";
            } else {
                echo "<p class='message' style='color:red;'>❌ Error: " . $conn->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
