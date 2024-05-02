<?php
// Database Conniction
include_once '../App/configDatabase.php';
include_once '../App/functions.php';
// Shared UI
include_once '../shared/head.php';
include_once '../shared/header.php';
include_once '../shared/aside.php';
$message = null;
$name = "";
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $select = "SELECT * FROM teachers where id = $id";
    $data  = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($data);
    // echo  $row['name'];
    // $name = $row['name
    if (isset($_POST['send'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash_password = sha1($password);
        $update = "UPDATE teachers SET  name= '$name' ,password= '$hash_password',email='$email'where id = $id";
        $i = mysqli_query($conn, $update);
        $message =  testMessage($i, "Up Teachers Successfully");
        redirect('teachers/index.php');
    }
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
            <h5 class="card-title"> Edit Teachers
                <a class="float-end btn btn-dark" href="./index.php"> List All </a>

            </h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3">
                <div class="col-md-12">
                    <input type="text" value="<?= $row['name'] ?>" name="name" class="form-control" placeholder="Teacher Name">
                </div>
                <div class="col-md-12">
                    <input type="text" value="<?= $row['email'] ?>" name="email" class="form-control" placeholder="Teacher Email">
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