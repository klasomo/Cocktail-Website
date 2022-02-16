<?php
    $LoggedIn = FALSE;
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $LoggedIn = TRUE;
    }else{
      $LoggedIn = FALSE;
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <title>Cocktail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <button class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="WelcomePage.php">SelzzUp</a>
      <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            <a class="nav-link active" href="WelcomePage.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="searchForCocktail.html">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($LoggedIn == true){ echo ' active';} else{ echo 'disabled';} ?>" href="Shoppingcart.php">Shopping List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($LoggedIn == true){ echo ' active';} else{ echo 'disabled';} ?>" href="newCocktail.php">Favorites</a>
          </li>
        </ul>
        <button class="btn btn-danger" onclick="window.location.href = '<?php if($LoggedIn == true){ echo 'Logout.php';} else{ echo 'PHPLogin.php';}?>'";><?php if($LoggedIn == true){ echo 'Logout';} else{ echo 'Login';} ?></button>
      </div>
  </nav>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand text-center">
						<h1 class="">SelzzUp</h1>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h3 class="card-title" >Impressum</h3>
                <p class="card-text">
                  <p>
                    Data according to § 5 TMG
                  </p>
                  <p>
                      Bac Ardi <br> 
                      Apistraße 3<br> 
                      12345 Barcadicity <br> 
                  </p>
                  <p>
                    <strong>Represented by: </strong><br>
                      Julia Besenbeck<br>
                      Timo Schneider<br>
                      Niklas Sommermann<br>
                      Johannes Schroll<br>
                  </p>
                  <p><strong>Contact:</strong> <br>
                      Tel: 01234-789456<br>
                      Fax: 1234-56789<br>
                      E-Mail: <a href='mailto:customerservice@SellzUp.de'>customerservice@SellzUp.de</a></br>
                  </p>
                  <p><strong>Regestry: </strong><br>
                      Entry in the register report: Wedgesstadt<br>
                      Register number: 12345<br>
                  </p>
                  <p><strong>VAT-ID: </strong> <br>
                      Sales tax and identification number according to §27a Value Added Tax Act: 42069AE.<br>
                  </p>
                  <p><strong>Business-ID: </strong><br>
                      615AF-AF185-AF128-H415G-13FEW<br>
                  </p>
                  </p>
                  <p><strong>Supervisory authority:</strong><br>
                      Sample supervision Samplecity<br>
                  </p><br> 
						</div>
					</div>
					<div class="footer text-center">
						Copyright &copy; 2022 SelzzUp 
					</div>
				</div>
			</div>
		</div>
	</section>
  <div class="footer-basic bg-dark footer-dark mt-5">
    <footer>
        <ul class="list-inline">
            <li class="list-inline-item text-light"><a href="Imprint.php">Impressum</a></li>
            <li class="list-inline-item text-light"><a href="ContactUs.php">Contact Us</a></li>
            <li class="list-inline-item text-light"><a href="PrivacyPolicy.php">Privacy Policy</a></li>
        </ul>
        <p class="copyright">SelzzUp © 2022</p>
    </footer>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6d728b5599da92ab',m:'iScpXer0hEZBjSWwtYumYEH6AH5CFu7mnq0GffEsvgA-1643795730-0-AWozRHBAHp6luuiYxdpS17IE12aRlUA1gONUbFNd9cxhTMdUeOVp9ZAgu9EuPZ1zktGrkdh8Rj6O1qKNupooB9Yds5Tc3Nim+Lbuz37bA4c9CzMN4gJMvCB1TDixtnpcMfjYJ7VljW/5hyg65jwO0BpEDF/3ZPdoD6O2dBzqtTtwgE6j1Pz8ATFuQDfhhnwLig==',s:[0xaf3332d4ee,0x2c74c39bc0],}})();</script></body>
</html>