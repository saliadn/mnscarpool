<nav class="menu">
   <h2></h2>
   <ul class="menu-links">
      <li class="<?php if($page == 'dashboard'){echo 'active';} ?>"><a href="/admin"><i class="fa-solid fa-chart-column fa-fw"></i> Dashboard</a></li>
      <li class="<?php if($page == 'users'){echo 'active';} ?>"><a href="/admin/membres"><i class="fa-solid fa-circle-user fa-fw"></i> Membres</a></li>
      <li class="<?php if($page == 'annonces'){echo 'active';} ?>"><a href="/admin/annonces"><i class="fa-solid fa-car fa-fw"></i> Annonces</a></li>
      <li class="<?php if($page == 'reports'){echo 'active';} ?>"><a href="#"><i class="fa-solid fa-flag fa-fw"></i> Signalements</a></li>
   </ul>
</nav>