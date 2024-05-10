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


function auth($rule2 = null, $rule3 = null, $rule4 = null)
{
    if ($_SESSION['admin']) {
        if (
            $_SESSION['admin']['rule'] == 1 || $_SESSION['admin']['rule'] == $rule2
            || $_SESSION['admin']['rule'] == $rule4
            || $_SESSION['admin']['rule'] == $rule3
        ) {
        } else {
            redirect('pages-error-404.php');
        }
    } else {
        redirect('pages-login.php');
    }
}


// filter All Inputs
function filterInputs($input)
{
    $input  = trim($input);
    $input  = strip_tags($input);
    $input  = stripslashes($input);
    $input  = htmlspecialchars($input);
    return $input;
}


// String Validation;

function stringValidation($input, $min = 3, $max = 20)
{
    $emptyError = empty($input);
    $minError = strlen($input) < $min;
    $maxError = strlen($input) >  $max;
    if ($emptyError == true || $minError == true || $maxError == true) {
        return true;
    } else {
        return false;
    }
}

// Number Validation

function numberValidation($input, $numberStatus = 'int')
{
    $emptyError = empty($input);
    $isNagtiveError = $input <= 0;
    if ($numberStatus == 'int') {
        $isNumberError = filter_var($input, FILTER_VALIDATE_INT) == false;
    } else {
        $isNumberError = filter_var($input, FILTER_VALIDATE_FLOAT) == false;
    }

    if ($emptyError == true || $isNagtiveError == true || $isNumberError == true) {
        return true;
    } else {
        return false;
    }
}

function fileReq($file_name)
{
    $emptyError = empty($file_name);
    if ($emptyError == true) {
        return true;
    } else {
        return false;
    }
}

function sizeFile($fileSize, $your_size = 2)
{
    $sizeByMiga = ($fileSize / 1024) / 1024;
    if ($sizeByMiga > $your_size) {
        return true;
    } else {
        return false;
    }
}

function validationType(
    $file_type,
    $type1 = null,
    $type2 = null,
    $type3 = null,
    $type4 = null,
    $type5 = null,
) {
    if (
        $file_type == $type1 || $file_type == $type2 ||
        $file_type == $type3 || $file_type == $type4 ||
        $file_type == $type5
    ) {
        return false;
    } else {
        return true;
    }
}
