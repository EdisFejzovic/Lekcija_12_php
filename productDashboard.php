
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();

$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2>Products Dashboard</h2>

    <a href="dashboard.php" class="btn btn-secondary mb-3">
        Back to Dashboard
    </a>

    <a href="addProduct.php" class="btn btn-success mb-3">
        Add Product
    </a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product["id"] ?></td>
                <td><?= htmlspecialchars($product["title"]) ?></td>
                <td><?= htmlspecialchars($product["description"]) ?></td>
                <td><?= $product["quantity"] ?></td>
                <td><?= $product["price"] ?></td>
                <td>
                    <a
                        href="product.php?id=<?= $product["id"] ?>"
                        class="btn btn-primary btn-sm">
                        Update
                    </a>

                    <form
                        action="deleteProduct.php"
                        method="POST"
                        class="d-inline">

                        <input
                            type="hidden"
                            name="id"
                            value="<?= $product["id"] ?>">

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>