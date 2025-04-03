<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ink Order Form</title>
</head>
<body>
    <h2>Place an Ink Order</h2>
    <form action="submit_order.php" method="POST">
        <label for="ink-name">Full Name:</label>
        <input type="text" id="ink-name" name="ink-name" required><br><br>
        
        <label for="ink-email">Email:</label>
        <input type="email" id="ink-email" name="ink-email" required><br><br>
        
        <label for="ink-phone">Phone Number:</label>
        <input type="text" id="ink-phone" name="ink-phone" required><br><br>
        
        <label for="ink-type">Ink Type:</label>
        <input type="text" id="ink-type" name="ink-type" required><br><br>
        
        
        <label for="ink-quantity">Quantity (Liters):</label>
        <input type="number" id="ink-quantity" name="ink-quantity" min="1" required><br><br>
        
        <label for="ink-notes">Additional Notes:</label>
        <textarea id="ink-notes" name="ink-notes"></textarea><br><br>
        
        <button type="submit">Submit Order</button>
    </form>
</body>
</html>
