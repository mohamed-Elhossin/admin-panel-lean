<?php
session_start();
define("BASE_URL", 'http://localhost/learn/admin/');


function URL($var = null)
{
    return BASE_URL . $var;
}



function testMessage($condication, $message)
{
    if ($condication) {
        return  $message;
    }
}



function redirect($var = null)
{
    echo "<script>
window.location.replace('http://localhost/learn/admin/$var');
</script>";
}


function auth(){
    if ($_SESSION['admin']) {
    } else {
      redirect('pages-login.php');
    }
}