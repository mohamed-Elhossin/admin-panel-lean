<?php
// Database Conniction
include_once '../App/configDatabase.php';
include_once '../App/functions.php';
// 



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
    // Image Code;
    $image_name = rand(0, 255) . rand(0, 255) .  $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";
    move_uploaded_file($image_tmp, $location);
    // ?????
    $full_image_path = URL('admins/upload/') . $image_name;
 
 
    $insert = "INSERT INTO admins VALUES (null , '$name' ,'$email','$hash_password' , '$full_image_path', 3)";
    $i = mysqli_query($conn, $insert);
    $message =  testMessage($i, "Create admins Successfully");
}


auth();
?>

<main id="main" class="main">

    <div class="card">
        <?php if ($message != null) : ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"> Add New admins
                <a class="float-end btn btn-dark" href="./index.php"> List All </a>

            </h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Admin Name">
                </div>

                <div class="col-md-12">
                    <input type="text" name="email" class="form-control" placeholder="Admin Email">
                </div>
                <div class="col-md-12">
                    <input type="password" name="password" class="form-control" placeholder="Admin Password">
                </div>
                <div class="col-md-12">
                    <label for="">Admin Image</label>
                    <input type="file" name="image" class="form-control">
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