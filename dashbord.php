<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mango Accounting Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset & base */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #fceabb, #f8b500);
            color: #333;
            padding: 20px;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .summary-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .card {
            flex: 1 1 250px;
            margin: 10px;
            padding: 20px;
            border-radius: 12px;
            background: #fef9e7;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #d35400;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            color: #27ae60;
        }

        .actions {
            text-align: center;
            margin: 20px 0;
        }

        .actions a {
            background: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 0 10px;
            display: inline-block;
            transition: background 0.3s;
        }

        .actions a:hover {
            background: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f8c471;
            color: #2c3e50;
        }

        .mango-icon {
            display: block;
            width: 80px;
            margin: 0 auto 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @media (max-width: 600px) {
            .summary-box {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- 🍋 Mango Icon (simple SVG) -->
        <img src="https://cdn-icons-png.flaticon.com/512/415/415733.png" alt="Mango Icon" class="mango-icon" width="80" />

        <h1>Mango Accounting Dashboard</h1>

        <?php
        $total_sales = 0;
        $total_expenses = 0;
        $profit = 0;

        $result = $conn->query("SELECT SUM(selling_price * quantity) AS total_sales FROM sales");
        if ($row = $result->fetch_assoc()) {
            $total_sales = $row['total_sales'];
        }

        $result = $conn->query("SELECT SUM(amount) AS total_expenses FROM expenses");
        if ($row = $result->fetch_assoc()) {
            $total_expenses = $row['total_expenses'];
        }

        $profit = $total_sales - $total_expenses;
        ?>

        <div class="summary-box">
            <div class="card">
                <h3>Total Sales</h3>
                <p>₹<?php echo number_format($total_sales, 2); ?></p>
            </div>
            <div class="card">
                <h3>Total Expenses</h3>
                <p>₹<?php echo number_format($total_expenses, 2); ?></p>
            </div>
            <div class="card">
                <h3>Profit / Loss</h3>
                <p style="color:<?php echo $profit >= 0 ? '#27ae60' : '#e74c3c'; ?>">
                    ₹<?php echo number_format($profit, 2); ?>
                </p>
            </div>
        </div>

        <div class="actions">
            <a href="add_sale.php">➕ Add Sale</a>
            <a href="add_expense.php">➕ Add Expense</a>
        </div>

        <h2>Sales Details</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Profit</th>
            </tr>
            <?php
            $sales = $conn->query("SELECT * FROM sales ORDER BY order_date DESC");
            while ($row = $sales->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['order_date']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>₹{$row['buying_price']}</td>
                    <td>₹{$row['selling_price']}</td>
                    <td>₹" . ($row['selling_price'] - $row['buying_price']) . "</td>
                </tr>";
            }
            ?>
        </table>

        <h2>Expense Details</h2>
        <table>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Description</th>
            </tr>
            <?php
            $expenses = $conn->query("SELECT * FROM expenses ORDER BY expense_date DESC");
            while ($row = $expenses->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['expense_date']}</td>
                    <td>{$row['category']}</td>
                    <td>₹{$row['amount']}</td>
                    <td>{$row['description']}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
