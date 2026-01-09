<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');

    if ($username !== "") {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Please enter your name";
    }
}
?>

<?php include "../partials/head.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">User Login</h4>

                    <?php
                    if (!empty($error)) {
                        echo '<div class="alert alert-danger">'
                            . htmlspecialchars($error) .
                            '</div>';
                    }
                    ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Enter your name"
                                required
                            >
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
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
