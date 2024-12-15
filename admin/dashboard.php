<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold px-2">Admin Dashboard</h1>
            <div>
                <span class="mr-4">Welcome, <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong></span>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md mr-2 ">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto p-6 flex-grow">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">User Messages</h2>
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full text-left table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">Message</th>
                        <th class="px-4 py-2">Received At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['id']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['message']); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            &copy; <?php echo date('Y'); ?> Admin Dashboard. All Rights Reserved.
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
