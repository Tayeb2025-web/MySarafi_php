
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>


  
   <nav class="sidebar-nav">
    <div class="header-left">
      <a href="dashboard.php" class="brand-link">
          <span class="brand-logo">MS</span>
          <span class="brand-name">MySarafi</span>
      </a>
    </div>
    <ul class="nav-list">

      <li class="nav-item">
        <a href="dashboard.php" class="nav-link nav-link-dashboard <?= ($current_page == 'dashboard.php') ? 'active' : '' ?>"> Dashboard </a>
      </li>
    
      <li class="nav-item">
        <a href="send.php" class="nav-link nav-link-send <?= ($current_page == 'send.php') ? 'active' : '' ?>">Send</a>
      </li>
      <li class="nav-item">
        <a href="receive.php" class="nav-link nav-link-receive <?= ($current_page == 'receive.php') ? 'active' : '' ?>">Receive</a>
      </li>

       <li class="nav-item">
        <a href="branch.php" class="nav-link nav-link-branches <?= ($current_page == 'branch.php') ? 'active' : '' ?>">Branches</a>
      </li>
     
      <li class="sidebar-footer">
        <a href="logout.php" class="logout-link">Logout</a>
      </li>
   
      </ul>
        </nav>

      
  

