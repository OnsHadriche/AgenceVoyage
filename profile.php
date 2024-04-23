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
// <!-- get hotels by user  -->
if ($username) {
    // echo $username;
    $sql = "SELECT * FROM roombook WHERE roombook.Email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the username parameter to the statement
        $stmt->bind_param("s", $username);

        // Execute the statement
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Fetch the rows into an array
        $reservations = array();
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
        // $result = $conn->query($sql);
        // $reservations = array();
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $reservations[] = $row;
        //     }
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
    <script rel="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/profile.css">
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
    </style>
</head>

<body>
    <nav>
        <div class="logo">
            <img class="bluebirdlogo" src="./image/bluebirdlogo.png" alt="logo">
            <p>BLUEBIRD</p>
        </div>
        <ul class="d-flex d-flex justify-content-between">
            <li class="me-2"><a href="./home.php">Home</a></li>
            <li class="me-2"><a href="./home.php#secondsection">Offers</a></li>
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
    <div class="row py-5 px-5  ">
        <div class="col-md-12 home">
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="media-body mb-5 p-2 text-white">
                            <h4 class="mt-0 mb-4"> <?php echo $username ?></h4>
                        </div>
                    </div>
                </div>
                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Reservations</h5>
                    </div>
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Hotel</th>
                                    <th scope="col">Check in</th>
                                    <th scope="col">Check out</th>
                                    <th scope="col">Number of days</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Meal</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($reservations as $reservation) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $reservation['hotel']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['cin']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['cout']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['nodays']; ?> day(s)

                                        </td>
                                        <td>
                                            <?php echo $reservation['RoomType']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['Meal']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['Price']; ?>

                                        </td>
                                        <td>
                                            <?php echo $reservation['stat']; ?>

                                        </td>
                                        <td>
                                            <a href="reservationDelete.php?id=<?php echo $reservation['id'] ?>"><button class='btn btn-danger'><i class="bi bi-trash3"></i></button></a>
                                        </td>
                                    <?php endforeach; ?>
                                    </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="contactus" style="margin-top: 150px;">
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