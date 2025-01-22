<?php
// Database connection
$host = 'localhost';
$user = 'student';
$password = '';
$database = 'audio-pine';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Our Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg  fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="assets/logo/DALL·E 2024-12-23 05.25.28 - A professional and sophisticated logo for 'Audio Pine Solutions,' designed to attract serious customers and convey trust and expertise. The central fo.webp" alt="Audio Pine Solutions" style="width: 50px;">
      </a>
      <button class="navbar-toggler-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""><i class="fa fa-bars" aria-hidden="true"></i></span>
      </button>
       <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="product.php">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#cybertrend">Cybertrend Blog</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  
    <div class="container my-5">



    <h1 class="text-center text-success mb-4">Our Products</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                            <p class="fw-bold">Ksh <?php echo $row['price']; ?></p>
                            <button class="btn btn-success">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
