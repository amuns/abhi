<?php
function displaySidebar($links){
?>
<nav class="sidebar-wrapper" id="sidebar">
  <div class="sidebar-header-row">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
      <i class="ri-menu-line"></i>
    </button>
    <div class="sidebar-brand">
      <img src="../img/dashboad-logo.png" alt="Logo" class="sidebar-logo">
      <span class="sidebar-logo-text">FBMD</span>
    </div>
  </div>
  <div class="sidebar-section">
    <div class="sidebar-links-nav">
      <?php foreach($links as $link) : ?>
        <a href="<?=$link['link']?>">
          <?php
            $iconMap = [
              'dashboard' => 'ri-home-5-line',
              'users' => 'ri-user-3-line',
              'logs' => 'ri-file-list-3-line',
              'scan patient' => 'ri-search-eye-line',
              'new patient' => 'ri-user-add-line',
              'enroll' => 'ri-fingerprint-line',
            ];
            $iconClass = $iconMap[strtolower($link['title'])] ?? 'ri-apps-2-line';
          ?>
          <i class="<?=$iconClass?>"></i>
          <span><?=ucwords($link['title'])?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="sidebar-bottom">
    <a class="logout" href="../layouts/logout.php">
      <i class="ri-logout-box-line"></i>
      <span>Sign out</span>
    </a>
  </div>
</nav>
<script>
const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('sidebarToggle');
toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
  document.body.classList.toggle('sidebar-collapsed');
});
</script>

<?php
}
?>