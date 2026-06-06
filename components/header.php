<!-- <div class="header-left">
    <a href="dashboard.php" class="brand-link">
        <span class="brand-logo">MS</span>
        <span class="brand-name">MySarafi</span>
    </a>
</div> -->

<div class="header-center">
    <h2 class="branch-title">Welcome To <span class="mysarafi">MySarafi</span> (Mazar-e-Sharif Branch)</h2>
</div>

<div class="header-dollar-rate">
    <form action="" method="post" class="dollar-rate-form">
        <label for="dollar_rate">1 USD =</label>

        <input
            type="number"
            id="dollar_rate"
            name="dollar_rate"
            placeholder="AFN"
            step="0.01">

        <button type="submit" name="save_dollar_rate">
            Save
        </button>
    </form>
</div>

<div class="header-user">
    <span class="user-label">User:</span>
    <span class="user-name">
        <?php echo $_SESSION['user_name'] ?? 'Guest'; ?> ↓
    </span>
</div>