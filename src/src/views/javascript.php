<?php
$jquery = file_get_contents('/var/www/html/node_modules/jquery/dist/jquery.min.js');
$jquery_ui = file_get_contents('/var/www/html/node_modules/jquery-ui-dist/jquery-ui.min.js');
$pagination = file_get_contents('/var/www/html/node_modules/paginationjs/dist/pagination.min.js');
$observer = file_get_contents('/var/www/html/javascript/obserber.js');
$register = file_get_contents('/var/www/html/javascript/register.js');
$slide = file_get_contents('/var/www/html/javascript/slide.js');
$drop = file_get_contents('/var/www/html/javascript/drop.js');
$buttn = file_get_contents('/var/www/html/javascript/buttn.js');
$accordion = file_get_contents('/var/www/html/javascript/acordion.js');
$pagenation = file_get_contents('/var/www/html/javascript/pagenation.js');
$export = file_get_contents('/var/www/html/javascript/template.js');
$location = file_get_contents('/var/www/html/javascript/location.js');
$resize = file_get_contents('/var/www/html/javascript/resize.js');
$responce = file_get_contents('/var/www/html/javascript/responce.js');
?>

<script id=" script" type="module">
  <?= $jquery ?>
  <?= $jquery_ui ?>
  <?= $pagination ?>
  <?= $observer ?>
  <?= $register ?>
  <?= $slide ?>
  <?= $drop ?>
  <?= $buttn ?>
  <?= $accordion ?>
  <?= $pagenation ?>
  <?= $export ?>
  <?= $location ?>
  <?= $resize ?>
  <?= $responce ?>
</script>
