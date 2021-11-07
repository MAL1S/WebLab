<?php
    $url = $_SERVER["REQUEST_URI"];

    $is_image = $url == "/pain/image";
    $is_description = $url == "/pain/description";
?>

<h1>Pain</h1>

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?= $is_image ? "active" : '' ?>" href="/pain/image">
        Image
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $is_description ? "active" : '' ?>" href="/pain/description">
        Description
    </a>
  </li>
</ul>

<?php
    if (preg_match("#^/pain/image#", $url)) {
        require "../pain/image.php";
    } elseif (preg_match("#^/pain/description#", $url)) { 
        require "../pain/description.php";
} ?>