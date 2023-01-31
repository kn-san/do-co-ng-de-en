Hello
<?php date_default_timezone_set ('Asia/Tokyo'); ?>
IP Address: <?php echo $_SERVER['REMOTE_ADDR']; ?>

Date: <?php echo date('Y-m-d H:i:s'); ?>

<?php
foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n";
}
?>
