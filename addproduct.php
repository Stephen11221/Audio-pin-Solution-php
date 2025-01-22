<?php
// Connect to the database
$host = 'localhost';
$user = 'student';  // Replace with your username
$password = 'your_password';  // Replace with your password
$database = 'audio-pine';

$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    // Handle image upload
    $imagePath = 'uploads/' . basename($image['name']);
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true); // Create uploads directory if it doesn't exist
    }
    move_uploaded_file($image['tmp_name'], $imagePath);

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssds', $name, $description, $price, $imagePath);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <style>
        body {
            display: flex;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .side {
            background-color: green;
            width: 300px;
            height: 100vh;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .side a {
            color: white;
            text-decoration: none;
            margin: 20px 0;
            font-size: 18px;
        }
        .side a:hover {
            text-decoration: underline;
        }
        .main-content {
            width: 100%;
            background: gray;
            padding: 20px;
        }
        form {
            width: 50%;
            display: flex;
            flex-direction: column;
            color: blue;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
        }
        label {
            margin-top: 10px;
        }
        input, textarea {
            border: 1px solid green;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
        }
        textarea {
            resize: none;
        }
        button {
            padding: 10px 20px;
            margin-top: 20px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>
    <div class="side">
        <h2>Menu</h2>
        <a href="add_product.php">Add Product</a>
        <a href="sold_items.php">Sold Items</a>
    </div>
    <div class="main-content">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" placeholder="Product Name" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Description"></textarea>
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" placeholder="Price" required>
            </div>
            <div>
                <label for="image">Product Image</label>
                <input type="file" name="image" id="image" required>
            </div>
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
