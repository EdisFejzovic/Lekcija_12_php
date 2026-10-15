<?php
require_once "config.php";

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

include "header.php";
?>

<?php include('header.php'); ?>

<div class="auth-container">
    <h1 class="h3">Please Sign Up</h1>

    <form action="register.php" method="POST">

    <input type="text" class="form-control"  name="name" required placeholder="name">

    <input type="text" class="form-control"  name="surname" required placeholder="surname">

    <input type="text" class="form-control"  name="username" required placeholder="username">

    <input type="email" class="form-control"  name="email" required placeholder="email">

    <input type="password" class="form-control"  name="password" required placeholder="password">

    <button type="submit" name="submit" class="btn btn-primary btn-lg">Sign Up</button>

    </form>

    <small>Already have an account? <a href="login.php">Log In!</a></small>

    <p class="text-muted">Digital School &copy; 2026</p>
</div>

<?php include('footer.php'); ?>