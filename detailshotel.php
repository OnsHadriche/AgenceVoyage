<?php
require_once('config.php');
include 'config.php';
session_start();
// page redirect
$usermail = "";
$usermail = $_SESSION['usermail'];
if ($usermail == true) {
} else {
  header("location: index.php");
}

if (isset($_GET['id'])) {
  $hotel_id = $_GET['id'];
  $sql = "SELECT * FROM room WHERE room.id = $hotel_id";

  // Exécution de la requête SQL
  $result = $conn->query($sql);

  // Vérification des erreurs de requête SQL
  if (!$result) {
    die("Erreur de requête SQL : " . $conn->error);
  }

  // Traitement des résultats de la requête
  if ($result->num_rows > 0) {
    // Il y a des résultats, vous pouvez les utiliser
    while ($row = $result->fetch_assoc()) {
      // Faites quelque chose avec chaque ligne de résultat
      // echo "Nom de la chambre : " . $row['Name'] . "<br>";
      // Autres données de la chambre...
    }
  } else {
    // Aucun résultat trouvé pour l'ID de l'hôtel spécifié
    echo "Aucune chambre trouvée pour cet hôtel.";
  }
} else {
  // L'ID de l'hôtel n'est pas spécifié dans l'URL
  echo "Aucun ID d'hôtel spécifié dans l'URL.";
}
?>
<!-- <?php include 'header.php'; ?> -->

<?php

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM room WHERE room.id = $id";
  $result = $conn->query($sql);
  $row = mysqli_fetch_array($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/home.css">
  <title>Hotel blue bird details</title>
  <!-- boot -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- fontowesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- sweet alert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="./admin/css/roombook.css">
  <link rel="stylesheet" href="./css/hotelDetails.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- <link rel="stylesheet" href="./css/search.css"> -->

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
                  <h6 class="dropdown-item d-flex align-items-center" style="font-size: 12px;"> <i class="bi bi-person"></i><?php echo $usermail ?></p>
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
  </nav>s

  <div>

    <div id="guestdetailpanel">
      <form action="" method="POST" class="guestdetailpanelform">
        <div class="head">
          <h3></h3>
          <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
        </div>
        <div class="middle">
          <div class="guestinfo">
            <h4>Guest information</h4>
            <input type="text" name="Name" placeholder="Enter Full name">
            <input type="email" name="Email" placeholder="Enter Email">

            <?php
            $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
            ?>

            <select name="Country" class="selectinput">
              <option value selected>Select your country</option>
              <?php
              foreach ($countries as $key => $value) :
                echo '<option value="' . $value . '">' . $value . '</option>';
              //close your tags!!
              endforeach;
              ?>
            </select>
            <input type="text" name="Phone" placeholder="Enter Phoneno">
          </div>

          <div class="line"></div>

          <div class="line"></div>


          <div class="reservationinfo">
            <h4>Hotel <?php echo $row['Name']; ?></h4>
            <select name="RoomType" class="selectinput">
              <option value selected>Type Of Room</option>
              <option value="Superior Room">SUPERIOR ROOM</option>
              <option value="Deluxe Room">DELUXE ROOM</option>
              <option value="Guest House">GUEST HOUSE</option>
              <option value="Single Room">SINGLE ROOM</option>
            </select>
            <select name="Bed" class="selectinput">
              <option value selected>Bedding Type</option>
              <option value="Single">Single</option>
              <option value="Double">Double</option>
              <option value="Triple">Triple</option>
              <option value="Quad">Quad</option>
              <option value="None">None</option>
            </select>
            <select name="NoofRoom" class="selectinput">
              <option value selected>No of Room</option>
              <option value="1">1</option>
              <!-- <option value="1">2</option>
                          <option value="1">3</option> -->
            </select>
            <select name="Meal" class="selectinput">
              <option value selected>Meal</option>
              <option value="Room only">Room only</option>
              <option value="Breakfast">Breakfast</option>
              <option value="Half Board">Half Board</option>
              <option value="Full Board">Full Board</option>
            </select>
            <div class="datesection">
              <span>
                <label for="cin"> Check-In</label>
                <input name="cin" type="date">
              </span>
              <span>
                <label for="cin"> Check-Out</label>
                <input name="cout" type="date">
              </span>
            </div>
          </div>
        </div>
        <div class="footer d-flex justify-content-center">
          <button class="btn btn-success mx-3" name="guestdetailsubmit">Submit</button>
          <button type="button" class="btn btn-danger" onclick="closebox()">Cancel</button>
        </div>
      </form>



      <!-- ==== room book php ====-->
      <?php
      $hotel = $row['Name'];
      if (isset($_POST['guestdetailsubmit'])) {
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Country = $_POST['Country'];
        $Phone = $_POST['Phone'];
        $RoomType = $_POST['RoomType'];
        $Bed = $_POST['Bed'];
        $NoofRoom = $_POST['NoofRoom'];
        $Meal = $_POST['Meal'];
        $cin = $_POST['cin'];
        $cout = $_POST['cout'];

        if ($Name == "" || $Email == "" || $Country == "") {
          echo "<script>swal({
                          title: 'Fill the proper details',
                          icon: 'error',
                      });
                      </script>";
        } else {
          $sta = "NotConfirm";
          $sql = "INSERT INTO roombook(Name,Email,Country,Phone,RoomType,Bed,NoofRoom,Meal,cin,cout,stat,nodays,hotel) VALUES ('$Name','$Email','$Country','$Phone','$RoomType','$Bed','$NoofRoom','$Meal','$cin','$cout','$sta',datediff('$cout','$cin'),'$hotel')";
          $result = mysqli_query($conn, $sql);


          if ($result) {
            echo "<script>swal({
                                  title: 'Reservation successful',
                                  icon: 'success',
                              });
                          </script>";
          } else {
            echo "<script>swal({
                                      title: 'Something went wrong',
                                      icon: 'error',
                                  });
                          </script>";
          }
        }
      }
      ?>
    </div>
  </div>

  <section class="container " style=margin-top:150px>
    <div class="row mt-4">
      <div class="col-5">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="./image/hotel2.jpg" class="d-block w-100" alt="..." width="100px" height="300px">
            </div>
            <div class="carousel-item">
              <img src="./image/hotel1.jpg" class="d-block w-100" alt="..." width="100px" height="300px">
            </div>
            <div class="carousel-item">
              <img src="./image/hotel3.jpg" class="d-block w-100" alt="..." width="100px" height="300px">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="col-7">
        <div class="card w-100 h-100 mb-3">
          <div class="card-body">
            <div class="d-flex flex-column">
              <div class="d-flex ign-items-baseline justify-content-between">
                <h4 class="card-title" style="color: #121481;"><?php echo $row['Name']; ?></h4>
                <span><?php echo $row['Price']; ?> TND</span>

              </div>
              <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" />
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" />
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" />
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" />
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" />
                <label for="star1" title="text">1 star</label>
              </div>

            </div>
            <p class="card-text">
              Lorem ipsum dolor sit amet consectetur,
              adipisicing elit. Quibusdam laborum rerum similique
              aliquam rem voluptatum ullam debitis, nemo ex
              blanditiis animi, reprehenderit,
              libero voluptate error praesentium ab sed deserunt?
              Voluptatibus.
              <br />
              <button type="button" class="btn btn-outline-primary float-end" onclick="openbookbox()">Book</button>
          </div>
        </div>
      </div>
    </div>
  </section>
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
<script>
  var bookbox = document.getElementById("guestdetailpanel");
  openbookbox = () => {
    bookbox.style.display = "flex";
  }
  closebox = () => {
    bookbox.style.display = "none";
  }
  let score = <?php echo $row["stars"]; ?>;
  document.getElementById('star' + score).checked = true;
</script>

</html>