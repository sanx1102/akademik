<?php
session_start();
session_unset();
session_destroy();

echo "<script>
    alert('Berhasil Logoutt');
    window.location.href = 'login.php';
</script>";
exit;
