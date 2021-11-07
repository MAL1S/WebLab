<?php
    $url = $_SERVER["REQUEST_URI"];

    $is_image = $url == "/minato/image";
    $is_description = $url == "/minato/description";
?>

<h1>Minato</h1>

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/minato/image">
        Image
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $is_description ? "active" : '' ?>" href="/minato/description">
        Description
    </a>
  </li>
</ul>

<?php
    if (preg_match("#^/minato/image#", $url)) {
        require "../minato/image.php";
    } elseif (preg_match("#^/minato/description#", $url)) { 
        require "../minato/description.php";
} ?>