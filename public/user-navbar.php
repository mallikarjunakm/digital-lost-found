<style>
    .user-nav {
        background: #0d6efd;
        padding: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .user-nav .nav-left a {
        color: white;
        margin-right: 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .user-nav a:hover {
        color: #ffc107;
    }

    .user-nav .nav-left a.active {
        text-decoration: underline;
        border-bottom: 2px solid #fff;
    }

    .user-nav .nav-right {
        color: #fff;
        font-weight: bold;
    }

    .admin-nav a:hover {
        color: #ffc107;   /* subtle color change */
    }

    .user-nav a.active {
        text-decoration: none;
        border-bottom: none;
    }

</style>

<div class="user-nav">
    <!-- LEFT: NAV LINKS -->
    <div class="nav-left">
        <a href="dashboard.php">Dashboard</a>
        <a href="lost-report.php">Report Lost Item</a>
        <a href="claim-item.php">Claim Found Item</a>
        <a href="logout.php" style="color:#ffd6d6;">Logout</a>
    </div>

    <!-- RIGHT: USER INDICATION -->
    <div class="nav-right">
        👤 User 
    </div>
</div>
