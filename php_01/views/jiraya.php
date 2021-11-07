<?php
    $url = $_SERVER["REQUEST_URI"];

    $is_image = $url == "/jiraya/image";
    $is_description = $url == "/jiraya/description";
?>

<h1>Jiraya</h1>

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/jiraya/image">
        Image
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $is_description ? "active" : '' ?>" href="/jiraya/description">
        Description
    </a>
  </li>
</ul>

<?php
    if (preg_match("#^/jiraya/image#", $url)) {
        require "../jiraya/image.php";
    } elseif (preg_match("#^/jiraya/description#", $url)) { 
        require "../jiraya/description.php";
} ?>