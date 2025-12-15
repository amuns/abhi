<?php
function displaySidebar($links){
?>
<nav class="sidebar-wrapper" id="sidebar">
    <div class="dashboard-logo">
        <i class="ri-stack-line" style="font-size:2.2rem;color:#2663a7;background:#fff;padding:12px;border-radius:50%;"></i>
        <h2>FBMD</h2>
    </div>
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <i class="ri-menu-line"></i>
    </button>
    <div class="dashboard-cta">
        <div class="links">
            <?php foreach($links as $link) : ?>
                <a href="<?=$link['link']?>">
                    <?php
                        $iconMap = [
                            'dashboard' => 'ri-dashboard-line',
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
        <a class="logout" href="../layouts/logout.php">
            <i class="ri-logout-box-line"></i>
            <span>Sign out</span>
        </a>
    </div>
</nav>
<script>
// Sidebar toggle script
const sidebar = document.getElementById('sidebar');
const toggleBtn = document.getElementById('sidebarToggle');
toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('collapsed');
});
</script>

<?php
}
?>