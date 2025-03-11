<?php
// new

require 'markov.php';

function process_post() {
    // generate text with markov library
    $order  = $_POST['order'];
    $length = $_POST['length'];
    $input  = $_POST['input'];
    $ptext  = $_POST['text'];

    if (!ctype_digit($order) || !ctype_digit($length)) {
        throw new Exception("Your order or length are not correct");
    }

    $order = (int) $order;
    $length = (int) $length;

    if ($order < 0 || $order > 20) {
        throw new Exception("Invalid order");
    }

    if ($length < 1 || $length > 25000) {
        throw new Exception("Text length is too short or too long");
    }

    if ($input) {
        $text = $input;
    } else if ($ptext) {
        if (!in_array($ptext, ['pop', 'rap', 'poet','country'])) {
            throw new Exception("Invalid text");
        } else {
            $text = file_get_contents("./text/$ptext.txt");
        }
    }

    if (empty($text)) {
        throw new Exception("No text given");
    }

    $markov_table = generate_markov_table($text, $order);
    $markov = generate_markov_text($length, $markov_table, $order);
    return htmlentities($markov);
}

if (isset($_POST['submit'])) {
    try {
        $markov = process_post();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>

<html lang="en">
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: "Lato", sans-serif}
.mySlides {display: none}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="#smartstu" class="w3-bar-item w3-button w3-padding-large w3-hide-small">SMARTSTU</a>
    <a href="#team" class="w3-bar-item w3-button w3-padding-large w3-hide-small">TEAM</a>
    <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CONTACT</a>
    
   
  </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <a href="#smartstu" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">SMARTSTU</a>
  <a href="#team" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">TEAM</a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTACT</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">MERCH</a>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

  <!-- SmartStu lyrics -->
  <body>
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="wrapper">
    <h1>SmartStu</h1>
    <p>Our Markov generator is intended to inspire ideas and help you, the artist, create a masterpiece. Simply choose a genre and the application will output a seed for your imagination. Regenerate as many times as you desire until the creativity kicks back in. </p>

    <?php if ($error): ?>
        <p class="error"><strong><?= $error; ?></strong></p>
    <?php endif; ?>

    <?php if ($markov): ?>
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="smartstu">
        <h2>Lyrics</h2>
        <textarea rows="20" cols="60" readonly="readonly"><?= $markov; ?></textarea>
    <?php endif; ?>

    <h2></h2>
    <form method="post" action="" name="markov">
        <br />


   
        <br />
        <select name="text">
            <option value="">Pick a genre!</option>
            <option value="pop">Pop</option>
            <option value="rap">Rap</option>
            <option value="poet">Poetry</option>
            <option value="country">Country</option>
        </select>
        <br />
        <p></p>
        <label for="order">Order</label>
        <input type="text" name="order" value="4" />
        <label for="length">Text size of output</label>
        <input type="text" name="length" value="2500" />
        <br />
        <p></p>
        <input type="submit" name="submit" value="GO" />
    </form>
</div> <!-- /wrapper -->
</body>


  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="team">
    <h2 class="w3-wide">THE TEAM</h2>
    <p class="w3-opacity"><i>We love music</i></p>
    <p class="w3-justify">  As former artists, we understand the hardship of a creative block. The pressure piles and it can really deprecate one's work and composure. SmartStu is our take on a solution. SmartStu is meant to inspire ideas while being light-hearted. The lyrics are not meant to be taken literally but merely a clay for you to mold. Whether you're performing Poetry in the Park, singing some country, or dropping some bars, SmartStu is meant to help. </p>
    <div class="w3-row w3-padding-32">
      <div class="w3-half">
        <p>Peter Pham</p>
        <img src="peter.JPG" class="w3-round w3-margin-bottom" alt="random name" style="width:60%">
      </div>
      <div class="w3-half">
        <p>Cole Davis</p>
        <img src="cole.JPG" class="w3-round w3-margin-bottom" alt="random name" style="width:60%">
      </div>
    </div>
  </div>

 
  <!-- The Contact Section -->
  <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
    <h2 class="w3-wide w3-center">CONTACT</h2>
    <p class="w3-opacity w3-center"><i>Fan? Drop a note!</i></p>
    <div class="w3-row w3-padding-32">
      <div class="w3-col m6 w3-large w3-margin-bottom">
        <i class="fa fa-map-marker" style="width:30px"></i> Atlanta, US<br>
        <i class="fa fa-envelope" style="width:30px"></i> Email: PPham20@student.gsu.edu<br>
        <i class="fa fa-envelope" style="width:30px"> </i> Email: CDavis339@gatech.edu<br>
      </div>
      <div class="w3-col m6">
        <form action="/action_page.php" target="_blank">
          <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
            </div>
            <div class="w3-half">
              <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
            </div>
          </div>
          <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
          <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
        </form>
      </div>
    </div>
  </div>
  
<!-- End Page Content -->
</div>

<!-- Image of location/map -->
<img src="map.jpg" class="w3-image w3-greyscale-min" style="width:100%">

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
</footer>

<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>

