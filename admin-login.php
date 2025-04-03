<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dummy credentials for authentication
    $username = 'abood123';
    $password = '123'; // Use hashed password in production

    // Check if username and password match
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['authenticated'] = true; // Set session variable
        header('Location: admin.php'); // Redirect to the main admin page
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center">
    <div class="w-full max-w-xs bg-white rounded-xl p-6 shadow-lg">
        <h2 class="text-xl font-semibold text-slate-800 mb-6">Admin</h2>
        <?php if (isset($error)) echo "<div class='mb-4 text-red-600'>$error</div>"; ?>
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
  
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Login</button>
        </form>
    </div>
</body>
</html>
