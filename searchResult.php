<?php
// search_results.php
include 'config.php';
session_start();
// Check if user is logged in
if (isset($_SESSION['usermail'])) {
    // User is logged in
    $username = $_SESSION['usermail'];
} else {
    // User is not logged in
    $username = null;
}
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    // Construct SQL query
    $sql = "SELECT * FROM room WHERE room.emplacement = '$search'";

    // Execute the query
    $result = $conn->query($sql);

    // Fetch the results
    $hotels = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hotels[] = $row;
        }
    }
}
?>
<!-- search_results.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- searchBar -->
    <link rel="stylesheet" href="./css/search.css">
    <title>Search Results</title>
</head>
<style>
    .ourroom {
        position: relative;
        top: 90px;
        height: 200px !important;
        width: 100%;
        /* background-color: #0040ff; */
    }
</style>

<body>
    <nav>
        <div class="logo">
            <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
            <p>BLUEBIRD</p>
        </div>
        <ul class="d-flex d-flex justify-content-between">
            <li class="me-2"><a href="./home.php">Home</a></li>
            <li class="me-2"><a href="./home.php#secondsection">Hotels</a></li>
            <li class="me-2"><a href="./home.php#thirdsection">Offers</a></li>
            <li class="me-2"><a href="./home.php#contactus ">Contact</a></li>
            <?php if ($username) : ?>
                <li class=" d-flex justify-content-evenly mt-2">
                    <div class="dropdown ">
                        <a class="btn btn-secondary btn-sm  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>

                        <ul class="dropdown-menu " style="width: 250px;">
                            <li>
                                <a href="./profile.php" class="dropdown-item">

                                    <h6 class="dropdown-item d-flex align-items-center" style="font-size: 12px;"> <i class="bi bi-person"></i><?php echo $username ?></p>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>

                                <a href="./logout.php" class="dropdown-item"><button class="btn btn-light d-flex align-items-center jutify-content-between"><i class="bi bi-box-arrow-in-right"></i> Log out</button></a>
                            </li>
                        </ul>
                    </div>


                </li>
            <?php else : ?>
                <a href="./index.php"><button class="btn btn-danger">LogIn</button></a>
            <?php endif; ?>
        </ul>
    </nav>
    <section id="secondsection">
        <img src="./image/bg.jpg">

        <div class=" ourroom">
            <h1 class="head">≼ Search results ≽</h1>
        </div>
    </section>
    <section class="container text-center" style="margin-top: 0;">
        <div class="row gx-2 d-flex">
            <?php if (isset($hotels) && !empty($hotels)) : ?>
                <?php
                foreach ($hotels as $hotel) : ?>
                    <div class="col">
                        <div class="card shadow-sm  mb-5 bg-body-tertiary rounded" style="width: 18rem;">
                            <img src="https://trendymagazine.net/wp-content/uploads/2021/03/Le-Mo%CC%88venpick-Hotel-Gammarth-Tunis-recoit-le-Green-Globe-Gold-Status-.jpg" class="card-img-top" alt="..." height="200px" width="200px">
                            <div class="card-body d-flex flex-column justify-content-start align-items-start">
                                <h5 class=""> <?php
                                                echo  $hotel['Name'] ?> </h5>
                                <p style="color: royalblue;"> <?php
                                                                echo  $hotel['emplacement'] ?> </p>

                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <?php if ($hotel['offer'] == 0) : ?>
                                        <span><?php echo $hotel['Price']; ?> TND</span>
                                    <?php else : ?>
                                        <?php $promotion = $hotel['Price'] * (1 - ($hotel['offer'] / 100));
                                        ?>
                                        <span style="color: red;"><?php echo $promotion ?> TND :
                                            <?php echo $hotel['offer'] ?><i class="bi bi-percent" style="color: red;"></i>
                                        </span>
                                    <?php endif; ?>
                                    <button class="btn btn-primary bookbtn" onclick="handleDetails(<?php echo $hotel['id'] ?>)">Voir Offre</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="alert alert-danger" role="alert">
                    <p>No hotels found matching your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section id="contactus">
        <div class="social">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="createdby">
            <h5>Created by @IITG</h5>
        </div>
    </section>
</body>

</html>
<script>
    const handleDetails = (id) => {
        window.location.href = `detailshotel.php?id=${id}`
    }
</script>