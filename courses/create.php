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
    $teacher = $_POST['teacher'];
    $category = $_POST['category'];

    $insert = "INSERT INTO courses VALUES (null , '$name' ,$category,$teacher)";
    $i = mysqli_query($conn, $insert);
    $message =  testMessage($i, "Create courses Successfully");
}
$categories = "SELECT * FROM categories";
$categoriesdata  = mysqli_query($conn, $categories);
$teachers = "SELECT * FROM teachers";
$teachersdata  = mysqli_query($conn, $teachers);
?>

<main id="main" class="main">

    <div class="card">
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
            <form method="post" class="row g-3">
                <div class="col-md-12">
                    <input type="text" name="name" class="form-control" placeholder="Teacher Name">
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