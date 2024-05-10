<?php
// Database Conniction
include_once '../App/configDatabase.php';
include_once '../App/functions.php';
// Shared UI
include_once '../shared/head.php';
include_once '../shared/header.php';
include_once '../shared/aside.php';
$message = null;
$errors = [];
$name = null;
if (isset($_POST['send'])) {


    $name =  filterInputs($_POST['name']);
    $teacher = filterInputs($_POST['teacher']);
    $category = filterInputs($_POST['category']);
    $description = filterInputs($_POST['description']);
    $hours     = filterInputs($_POST['hours']);
    if (stringValidation($name)) {
        $errors[] = "Please Enter Valid Name";
    }
    if (stringValidation($description)) {
        $errors[] = "Please Enter Valid Description";
    }

    if (numberValidation($hours)) {
        $errors[] = "Please Enter  Valid Number in Hours";
    }


    // Image Code;
    if (fileReq($_FILES['image']['name'])) {
        $errors[] = "Please Enter Image";
    }
    $file_size = $_FILES['image']['size'];
    if (sizeFile($file_size, 1)) {
        $errors[] = "Please Enter Image Size Leess than";
    }
    $image_type = $_FILES['image']['type'];

    if (validationType($image_type, 'image/jpeg', 'image/jpg', 'image/png')) {
        $errors[] = "Please Enter  Valid Type Image";
    }

    $image_name = rand(0, 255) . rand(0, 255) .  $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $location = "./upload/$image_name";
    move_uploaded_file($image_tmp, $location);
    // ?????
    $full_image_path = URL('courses/upload/') . $image_name;
    if (empty($errors)) {
        $insert = "INSERT INTO courses VALUES (null , '$name' ,'$full_image_path' , '$hours' ,'$description',$category,$teacher)";
        $i = mysqli_query($conn, $insert);
        $message =  testMessage($i, "Create courses Successfully");
    }
}
$categories = "SELECT * FROM categories";
$categoriesdata  = mysqli_query($conn, $categories);
$teachers = "SELECT * FROM teachers";
$teachersdata  = mysqli_query($conn, $teachers);
?>

<main id="main" class="main">

    <div class="card">
        <?php


        if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <ul>
                        <li> <?= $error ?></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($message != null) : ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"> Add New courses
                <a class="float-end btn btn-dark" href="./index.php"> List All </a>

            </h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12">
                    <input type="text" name="name" value="<?=  $name ?>" class="form-control" placeholder="Course Name">
                </div>
                <div class="col-md-12">
                    <input type="text" name="description" class="form-control" placeholder="Course description">
                </div>
                <div class="col-md-12">
                    <input type="number" name="hours" class="form-control" placeholder="Course hours	">
                </div>
                <div class="col-md-12">
                    <input type="file" name="image" class="form-control" placeholder="Course Image">
                </div>

                <div class="row">
                    <div class="col-md-6 my-3">
                        <select name="teacher" id="" class="form-control">
                            <option disabled selected>Select Teacher</option>
                            <?php foreach ($teachersdata as $item) : ?>
                                <option value="<?= $item['id'] ?>"> <?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 my-3">
                        <select name="category" id="" class="form-control">
                            <option disabled selected>Select category</option>
                            <?php foreach ($categoriesdata as $item) : ?>
                                <option value="<?= $item['id'] ?>"> <?= $item['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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