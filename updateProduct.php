
<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: productDashboard.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$title = trim($_POST["title"] ?? "");
$description = trim($_POST["description"] ?? "");
$quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT);
$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);

if (
    !$id ||
    $title === "" ||
    $description === "" ||
    $quantity === false ||
    $quantity === null ||
    $quantity < 0 ||
    $price === false ||
    $price === null ||
    $price < 0
) {
    exit("Invalid product information.");
}

$sql = "UPDATE products
        SET title = :title,
            description = :description,
            quantity = :quantity,
            price = :price
        WHERE id = :id";

$stmt = $conn->prepare($sql);

$stmt->execute([
    ":title" => $title,
    ":description" => $description,
    ":quantity" => $quantity,
    ":price" => $price,
    ":id" => $id
]);

header("Location: productDashboard.php");
exit;
?>
