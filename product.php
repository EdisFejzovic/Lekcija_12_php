
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"]) || !filter_var($_GET["id"], FILTER_VALIDATE_INT)) {
    header("Location: productDashboard.php");
    exit;
}

$id = (int) $_GET["id"];

$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([":id" => $id]);

$product = $stmt->fetch();

if (!$product) {
    header("Location: productDashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Update Product</h2>

    <form action="updateProduct.php" method="POST">

        <input type="hidden" name="id" value="<?= $product["id"] ?>">

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($product["title"]) ?>"
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
                value="<?= htmlspecialchars($product["description"]) ?>"
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
                value="<?= $product["quantity"] ?>"
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
                value="<?= $product["price"] ?>"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Save Changes
        </button>

        <a href="productDashboard.php" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

</body>
</html>
