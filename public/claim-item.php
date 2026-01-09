<?php
session_start();
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

include("../config/db.php");
?>

<?php
$found_items = $conn->query(
    "SELECT * FROM found_items WHERE status = 'unclaimed'"
);
?>

<?php include "../partials/head.php"; ?>
<?php include "user-navbar.php"; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Claim a Found Item</h4>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Found Item</label>
                            <select name="found_id" class="form-select" required>
                                <option value="">-- Select Item --</option>
                                <?php while ($item = $found_items->fetch_assoc()) { ?>
                                    <option value="<?php echo $item['found_id']; ?>">
                                        <?php
                                        echo $item['item_type'] .
                                            " found at " .
                                            $item['found_location'];
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="number"
                                   name="lost_id"
                                   class="form-control"
                                   placeholder="Your Lost Item ID"
                                   required>
                        </div>

                        <div class="mb-3">
                            <input type="text"
                                   name="claimant_name"
                                   class="form-control"
                                   placeholder="Your Name"
                                   required>
                        </div>

                        <div class="mb-3">
                            <textarea name="verification_notes"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Explain identifying details (proof of ownership)"
                                      required></textarea>
                        </div>

                        <button type="submit"
                                name="submit"
                                class="btn btn-primary w-100">
                            Submit Claim
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {

    $found_id = $_POST['found_id'];
    $lost_id = $_POST['lost_id'];
    $name = $_POST['claimant_name'];
    $notes = $_POST['verification_notes'];
    $username = $_SESSION['username'];

    // STEP 1: Verify that this lost_id belongs to the logged-in user
    $check_lost = $conn->query(
        "SELECT lost_id FROM lost_items 
         WHERE lost_id = '$lost_id' 
         AND reported_by = '$username'"
    );

    if ($check_lost->num_rows === 0) {
        // Invalid lost_id or does not belong to this user
        echo "<div class='alert alert-danger text-center'>
                Invalid Lost Item ID. You can only claim items you reported as lost.
              </div>";
    } else {

        // STEP 2: Insert claim
        $sql = "INSERT INTO claims
                (lost_id, found_id, claimant_name, verification_notes, claimed_by)
                VALUES
                ('$lost_id', '$found_id', '$name', '$notes', '$username')";

        if ($conn->query($sql)) {
            echo "<div class='alert alert-success text-center'>
                    Claim submitted successfully. Await admin verification.
                  </div>";
        } else {
            echo "<div class='alert alert-danger text-center'>
                    Error submitting claim
                  </div>";
        }
    }
}
?>


<?php include "../partials/footer.php"; ?>
