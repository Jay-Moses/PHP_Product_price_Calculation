php
Copy code
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Selling Price Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: red;
        }
        h1, h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            display: inline-block;
            width: 150px;
        }
        input[type="number"] {
            margin-bottom: 10px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Product Selling Price Calculator</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Calculated Selling Prices</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Buying Price</th>
                <th>VAT</th>
                <th>General Expenses</th>
                <th>Profit Margin</th>
                <th>Selling Price</th>
            </tr>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                $buying_price = (float)$_POST["buying_price_$i"];
                $vat = (float)$_POST["vat_$i"];
                $expenses = (float)$_POST["expenses_$i"];
                $profit_margin = (float)$_POST["profit_margin_$i"];

                $vat_amount = ($buying_price * $vat) / 100;
                $expenses_amount = ($buying_price * $expenses) / 100;
                $profit_margin_amount = ($buying_price * $profit_margin) / 100;
                $selling_price = $buying_price + $vat_amount + $expenses_amount + $profit_margin_amount;
            ?>
                <tr>
                    <td>Product <?= $i ?></td>
                    <td><?= number_format($buying_price, 2) ?></td>
                    <td><?= number_format($vat_amount, 2) ?></td>
                    <td><?= number_format($expenses_amount, 2) ?></td>
                    <td><?= number_format($profit_margin_amount, 2) ?></td>
                    <td><?= number_format($selling_price, 2) ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="index.php">Go Back</a>
    <?php else: ?>
        <form action="index.php" method="post">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <h2>Product <?= $i ?></h2>
                <label for="buying_price_<?= $i ?>">Buying Price:</label>
                <input type="number" step="0.01" name="buying_price_<?= $i ?>" required><br>
                <label for="vat_<?= $i ?>">VAT (%):</label>
                <input type="number" step="0.01" name="vat_<?= $i ?>" required><br>
                <label for="expenses_<?= $i ?>">General Expenses (%):</label>
                <input type="number" step="0.01" name="expenses_<?= $i ?>" required><br>
                <label for="profit_margin_<?= $i ?>">Profit Margin (%):</label>
                <input type="number" step="0.01" name="profit_margin_<?= $i ?>" required><br><br>
            <?php endfor; ?>
            <input type="submit" value="Calculate Selling Prices">
        </form>
    <?php endif; ?>
</body>
</html>