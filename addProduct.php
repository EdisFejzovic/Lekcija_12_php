
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    $sql = "INSERT INTO products (title, description, quantity, price)
            VALUES (:title, :description, :quantity, :price)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ":title" => $title,
        ":description" => $description,
        ":quantity" => $quantity,
        ":price" => $price
    ]);

    header("Location: productDashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Add Product</h2>

    <form action="addProduct.php" method="POST">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input
                type="text"
                id="description"
                name="description"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input
                type="number"
                id="quantity"
                name="quantity"
                class="form-control"
                min="0"
                required
            >
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input
                type="number"
                id="price"
                name="price"
                class="form-control"
                min="0"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            Save Product
        </button>

        <a href="productDashboard.php" class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

</body>
</html>
