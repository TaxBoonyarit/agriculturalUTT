<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- icon web -->
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- css w3 -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- icons -->
<link href="../service/fontawesome/css/fontawesome.css" rel="stylesheet">
<link href="../service/fontawesome/css/brands.css" rel="stylesheet">
<link href="../service/fontawesome/css/solid.css" rel="stylesheet">

<!-- css  style sheet-->
<link rel="stylesheet" href="../service/style/style.css" type="text/css">

<!-- chart -->
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<!-- data table -->
<script src="../service/DataTables/datatables.min.js"></script>
<link href="../service/DataTables/datatables.min.css" type="text/css" />

<!-- sweet alert -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if (isset($_GET['logout'])) {
        session_destroy();
        header("location: login.php");
    }

    if (isset($_GET['update_profile'])) {
        $_SESSION['email'];
        header('location: profile.php');
    }
    $id_f_g_l =  isset($_SESSION['id_F_L_G']) ?  $_SESSION['id_F_L_G'] : '';

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover,user-scalable=no">

    <title>Agricultural@UTT</title>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <h3><i class="fas fa-leaf"></i>
            เกษตรมูลค่าสูง
        </h3>
        <?php if (isset($_SESSION['email'])) : ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <span class="navbar-text">
                        &nbsp; เมนูจัดการเกษตร
                    </span>
                    <li class="nav-item active">
                        <a href="plot.php" class="btn"><i class="fas fa-tractor"></i> จัดการแปลงเกษตร</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php?update_profile='1'" class="btn "><i class="fas fa-user-edit"></i> จัดการโปรไฟล์</a>
                    </li>
                    <li class="nav-item">
                        <?php if ($id_f_g_l === 'active') : ?>
                            <a href="reset_password.php" class="btn "><i class="fas fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน</a>
                        <?php endif ?>
                    </li>
                    <li class="nva-item">
                        <a href="login.php?logout='1'" class="btn"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                    </li>
                </ul>
            </div>
        <?php endif ?>
    </nav>
    <a name="up"></a>
</head>