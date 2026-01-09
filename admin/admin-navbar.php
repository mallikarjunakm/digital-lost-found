<style>
    .admin-nav {
        background: #222;
        padding: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .admin-nav .nav-left a {
        color: white;
        margin-right: 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .admin-nav a:hover {
        color: #ffc107;
    }


    .admin-nav .nav-left a.active {
        text-decoration: none;
        border-bottom: 2px solid #ffc107; /* admin highlight */
    }

    .admin-nav .nav-right {
        color: #ffc107;
        font-weight: bold;
    }

    
</style>

<div class="admin-nav">

    <!-- LEFT: ADMIN NAV LINKS -->
    <div class="nav-left">
        <a href="dashboard.php" >Dashboard</a>
        <a href="add-found-item.php">Add Found Item</a>
        <a href="match-items.php">Match Items</a>
        <a href="verify-claims.php">Verify Claims</a>
        <a href="claim-logs.php">Audit Logs</a>
        <a href="logout.php" style="color:#ff6b6b;">Logout</a>
    </div>

    <!-- RIGHT: ADMIN INDICATION -->
    <div class="nav-right">
        🛠 Admin 
    </div>

</div>
