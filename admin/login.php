<?php
session_start();

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded admin credentials (college project)
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<?php include "../partials/head.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Admin Login</h4>

                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <input type="text"
                                   name="username"
                                   class="form-control"
                                   placeholder="Username"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Password"
                                   required>
                        </div>

                        <button type="submit"
                                name="login"
                                class="btn btn-primary w-100">
                            Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="../index.php" class="btn btn-link">
                            ⬅ Back to Home
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../partials/footer.php"; ?>
