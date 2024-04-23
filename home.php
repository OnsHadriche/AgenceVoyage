<?php

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
// <!-- get hotels -->
$sql = "SELECT * FROM room";
$result = $conn->query($sql);
$hotels = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $hotels[] = $row;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/home.css">
  <title>Hotel blue bird</title>
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
  <style>
    #guestdetailpanel {
      display: none;
    }

    #guestdetailpanel .middle {
      height: 450px;
    }

    .input-box {
      position: relative;
      height: 76px;
      max-width: 1000px;
      width: 100%;
      background: #fff;
      margin: 0 50px;
      border-radius: 8px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .input-box i,
    .input-box .button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
    }

    .input-box i {
      left: 20px;
      font-size: 30px;
      color: #707070;
      border-radius: 5px;
    }

    .input-box input {
      height: 100%;
      width: 100%;
      outline: none;
      font-size: 18px;
      font-weight: 400;
      border: none;
      padding: 0 155px 0 65px;
      background-color: #B3C8CF;
      color: #102C57;

    }

    .input-box .button {
      right: 20px;
      font-size: 16px;
      font-weight: 400;
      color: #fff;
      border: none;
      padding: 12px 30px;
      border-radius: 6px;
      background-color: #102C57;
      cursor: pointer;
    }

    .input-box .button.clicked {
      transform: translateY(-50%) scale(0.98);
    }

    /* Responsive */
    @media screen and (max-width: 500px) {
      .input-box {
        height: 66px;
        margin: 0 50px;
      }

      .input-box i {
        left: 12px;
        font-size: 25px;
      }

      .input-box input {
        padding: 0 112px 0 50px;
      }

      .input-box .button {
        right: 12px;
        font-size: 14px;
        padding: 8px 18px;
      }
    }
  </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
      <p>BLUEBIRD</p>
    </div>
    <ul class="d-flex d-flex justify-content-between">
      <li class="me-2"><a href="#firstsection">Home</a></li>
      <li class="me-2"><a href="#secondsection">Offers</a></li>
      <li class="me-2"><a href="#contactus ">Contact</a></li>
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


  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="carousel-image" src="./image/hotel1.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel2.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel3.jpg">
      </div>
      <div class="carousel-item">
        <img class="carousel-image" src="./image/hotel4.jpg">
      </div>

      <div class="welcomeline">
        <h1 class="welcometag">Welcome to heaven on earth</h1>
      </div>


      <!-- bookbox -->


    </div>
  </section>

  <section id="secondsection">
    <img src="./image/homeanimatebg.svg">
    <div class="ourroom">
      <h1 class="head">≼ Hotels ≽</h1>
      <section id="secondsection">
        <div class="container">
          <form method="GET" action="searchResult.php">

            <div class="input-box shadow">
              <i class="uil uil-search"></i>
              <input type="text"  id ="search" name ='search' placeholder="Search here..." />
              <button class="button"  type="submit">Search</button>
            </div>
          </form>
        </div>
    </div>
    </div>
  </section>

  <section class="container text-center">
    <div class="row gx-2 d-flex">
      <div class="col">
        <div class="card shadow-sm  mb-5 bg-body-tertiary rounded" style="width: 18rem;">
          <img src="https://imgcy.trivago.com/c_fill,d_dummy.jpeg,e_sharpen:60,f_auto,h_258,q_auto,w_258/hotelier-images/09/19/b67aac8a601df2a4849f044de23b8e5998e8c38d584d5125af6116cf5266.jpeg" class="card-img-top" alt="..." height="200px" width="200px">
          <div class="card-body d-flex flex-column justify-content-start align-items-start">
            <h5 class="">MovenPick</h5>
            <p style="color: royalblue;">Tunis-Sousse</p>
            <p>Single </p>

            <div class="d-flex flex-row justify-content-between align-items-center">

              <h5>240 TND</h5>
              <button class="btn btn-primary bookbtn" onclick="handleDetails($id)">Voir Offre</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col">

        <div class="card shadow-sm  mb-5 bg-body-tertiary rounded" style="width: 18rem;">
          <img src="https://www.resabo.com/cr.fwk/images/hotels/Hotel-2205-20200925-115108.jpg" class="card-img-top" alt="..." height="200px" width="200px">
          <div class="card-body d-flex flex-column justify-content-start align-items-start">
            <h5 class="">ElMouradi</h5>
            <p style="color: royalblue;">Tunis-Hammamet</p>
            <p>Single </p>
            <div class="d-flex flex-row justify-content-between align-items-center">

              <h5>120 TND</h5>
              <button class="btn btn-primary bookbtn" onclick="openbookbox()">Voir offer</button>
            </div>
          </div>
        </div>
      </div>
      <?php
      foreach ($hotels as $hotel) : ?>
        <div class="col">
          <div class="card shadow-sm  mb-5 bg-body-tertiary rounded" style="width: 18rem;">
            <img src="https://trendymagazine.net/wp-content/uploads/2021/03/Le-Mo%CC%88venpick-Hotel-Gammarth-Tunis-recoit-le-Green-Globe-Gold-Status-.jpg" class="card-img-top" alt="..." height="200px" width="200px">
            <div class="card-body d-flex flex-column justify-content-start align-items-start">
              <h5 class=""> <?php
                            echo  $hotel['Name'] ?> </h5>
              <p style="color: royalblue;">Tunis-Hammamet</p>

              <div class="d-flex flex-row justify-content-between align-items-center">
                <h5><?php echo $hotel['Price'] ?> TND</h5>
                <button class="btn btn-primary bookbtn" onclick="handleDetails(<?php echo $hotel['id'] ?>)">Voir Offre</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>




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

<script>
  AOS.init();
  const handleDetails = (id) => {
    window.location.href = `detailshotel.php?id=${id}`
  }
</script>


</html>