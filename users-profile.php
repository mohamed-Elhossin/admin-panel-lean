<?php
include_once './shared/head.php';
include_once './shared/header.php';
include_once './shared/aside.php';
include_once './App/functions.php';
include_once './App/configDatabase.php';

$user_id = $_SESSION['admin']['id'];
$select = "SELECT * FROM admins where id = $user_id";
$data  = mysqli_query($conn, $select);
$admin = mysqli_fetch_assoc($data);
$message  = null;
if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Image Code;
  if (empty($_FILES['image']['name'])) {
    // $image_name = $admin['image'];
    $full_image_path = $admin['image'];
  } else {
    unlink($admin['image']);
    $image_name = rand(0, 255) . rand(0, 255) .  $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $location = "./admins/upload/$image_name";
    move_uploaded_file($image_tmp, $location);
    // ?????
    $full_image_path = URL('admins/upload/') . $image_name;
    $_SESSION['admin']['image'] = $full_image_path;
  }



  $insert = "UPDATE  admins SET name=  '$name' , email = '$email'  , image= '$full_image_path' where id = $user_id";
  $i = mysqli_query($conn, $insert);
  // $message =  testMessage($i, "Update admins Successfully");
  redirect('users-profile.php');
}

// 40bd001563085fc35165329ea1ff5c5ecbdbbeef
// 40bd001563085fc35165329ea1ff5c5ecbdbbeef
// 7110eda4d09e062aa5e4a390b0a572ac0d2c0220

if (isset($_POST['changePassword'])) {
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $current = $_POST['current'];
  $hashCurrent = sha1($current);
  if ($hashCurrent ==  $admin['password']) {
   
    if ($password == $confirm_password) {

      $hashPassword = sha1($password);
      $insert = "UPDATE  admins SET `password`='$hashPassword'  where id = $user_id";
      $i = mysqli_query($conn, $insert);
      // $message =  testMessage($i, "Update admins Successfully");
      redirect('users-profile.php');
    }else{
      $message = "Please Confirm Your Password";
    }
  }else{
    $message =  "Wrong Current Password";
  }
}
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?= $admin['image']  ?>" alt="Profile" class="rounded-circle">
            <h2><?= $admin['name']  ?></h2>
            <h3> <?= $admin['email']  ?></h3>
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <?php if ($message != null) : ?>
          <div class="alert alert-danger">
            <?= $message ?>
          </div>
        <?php endif; ?>
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>



              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?= $admin['name']  ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?= $admin['email']  ?></div>
                </div>


              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="post" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <img src="<?= $admin['image'] ?>" alt="Profile">
                      <div class="pt-2">
                        <input type="file" name="image" class="btn btn-primary btn-sm" title="Upload new profile image">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="name" type="text" class="form-control" id="fullName" value="<?= $admin['name'] ?>">
                    </div>
                  </div>





                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="<?= $admin['email'] ?>">
                    </div>
                  </div>




                  <div class="text-center">
                    <button type="submit" name="save" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">


              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post">

                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="current" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="confirm_password" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php
include_once './shared/footer.php';
include_once './shared/script.php';
?>