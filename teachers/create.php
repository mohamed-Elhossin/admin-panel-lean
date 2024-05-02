<?php
// Database Conniction
include_once '../App/configDatabase.php';
include_once '../App/functions.php';
// Shared UI
include_once '../shared/head.php';
include_once '../shared/header.php';
include_once '../shared/aside.php';
$message = null;
if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = sha1($password);
    $insert = "INSERT INTO teachers VALUES (null , '$name', '$hash_password','$email')";
    $i = mysqli_query($conn, $insert);
    $message =  testMessage($i, "Create Teachers Successfully");
}

?>

<main id="main" class="main">

    <div class="card">
        <?php if ($message != null) : ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"> Add New Teachers
                <a class="float-end btn btn-dark" href="./index.php"> List All </a>

            </h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3">
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Teacher Name">
                </div>
                <div class="col-md-12">
                    <input type="text" name="email" class="form-control" placeholder="Teacher Email">
                </div>
                <div class="col-md-12">
                    <input type="password" name="password" class="form-control" placeholder="Teacher Password">
                </div>
                <div class="text-center">
                    <button type="submit" name="send" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- End No Labels Form -->

        </div>
    </div>



</main>

<?php
include_once '../shared/footer.php';
include_once '../shared/script.php';
?>