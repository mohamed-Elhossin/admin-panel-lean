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


function auth($rule2 = null , $rule3 = null ,$rule4 = null)
{
    if ($_SESSION['admin']) {
        if ($_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule']==$rule2
        || $_SESSION['admin']['rule']==$rule4
        || $_SESSION['admin']['rule']==$rule3) {
        } else {
            redirect('pages-error-404.php');
        }
    } else {
        redirect('pages-login.php');
    }
}
