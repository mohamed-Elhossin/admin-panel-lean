<?php
// Database Conniction
include_once '../App/configDatabase.php';
include_once '../App/functions.php';
// Shared UI
include_once '../shared/head.php';
include_once '../shared/header.php';
include_once '../shared/aside.php';
$message = null;

// $message =  testMessage($i, "Create Category Successfully");

$select = "SELECT * FROM categories";
$data  = mysqli_query($conn, $select);


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = "DELETE FROM categories WHERE id = $id";
    $data  = mysqli_query($conn, $delete);
    redirect('categories/index.php');
}


auth(2);
?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Categories

                            <a class="float-end btn btn-dark" href="./create.php"> Add New </a>
                        </h5>


                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th colspan="2">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $item) : ?>
                                    <tr>
                                        <th scope="row"><?= $item['id'] ?></th>
                                        <th><?= $item['name'] ?></th>
                                        <th><a href="./edit.php?edit=<?= $item['id'] ?>"><i class='bx bxs-message-square-edit'></i></a></th>

                                        <th><a href="./index.php?delete=<?= $item['id'] ?>"><i class='text-danger bx bxs-message-square-x'></i></a></th>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
<?php
include_once '../shared/footer.php';
include_once '../shared/script.php';
?>