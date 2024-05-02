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
    $select = "SELECT * FROM categories where id = $id";
    $data  = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($data);
    echo  $row['name'];
    $name = $row['name'];
    if (isset($_POST['send'])) {
        $name = $_POST['name'];

        $insert = " UPDATE categories  SET name =  '$name' where id = $id";
        $i = mysqli_query($conn, $insert);
        $message =  testMessage($i, "Update Category Successfully");
        redirect('categories/index.php');
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
            <h5 class="card-title"> Edit Categories
                <a class="float-end btn btn-dark" href="./index.php"> List All </a>

            </h5>

            <!-- No Labels Form -->
            <form method="post" class="row g-3">
                <div class="col-md-12">
                    <input type="text" value="<?= $name ?>" name="name" class="form-control" placeholder="Category Name">
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