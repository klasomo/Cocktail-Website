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
<style>

</style>
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script><script async src='/cdn-cgi/bm/cv/669835187/api.js'></script></head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <button class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">SelzzUp</a>
      <div class="collapse navbar-collapse justify-content-between">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="searchForCocktail.php">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($LoggedIn == true){ echo ' active';} else{ echo 'disabled';} ?>" href="newCocktail.php">Make a Cocktail</a>
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
							<h3 class="card-title">Privacy Policy</h3>
                            <p class="card-text">
                                <p>
                                    Thank you for visiting our website. Compliance with data protection regulations is of particular importance to us.
                                    The aim of this data protection declaration is to inform you as a user of the website about the nature, scope and purpose of the processing of 
                                    personal data and the rights that exist for you, insofar as you are considered a data subject within the meaning of Article 4 No. 1 of the General Data Protection Regulation.
                                    The following data protection declaration takes into account the innovations under the General Data Protection Regulation (DSGVO) in force since 25.5.2018.
                                    At the same time, this declaration also fulfills the requirements of Section 13 of the German Telemedia Act (Telemediengesetz) that applied until then.
                                </p>                
                               <p><strong>Personal Data: </strong> <br>
                                    Unless otherwise specified below, the provision of your personal data is neither required by law or contract, nor is it necessary for the conclusion of a contract.
                                    You are not obliged to provide the data. Failure to provide it will have no consequences. This applies only to the extent that no other indication is made in the subsequent processing operations.
                                    "Personal data" means any information relating to an identified or identifiable natural person.
                                </p>
                                <p><strong>Liability for Contents:</strong><br>
                                    As a service provider, we are responsible for our own content on these pages in accordance with general legislation pursuant to Section 7 (1) of the German Telemedia Act (TMG).
                                    According to §§ 8 to 10 TMG, however, we are not obligated as a service provider to monitor transmitted or stored third-party information or to investigate circumstances that indicate illegal activity. 
                                    Obligations to remove or block the use of information according to general laws remain unaffected. However, liability in this regard is only possible from the point in time at which a concrete infringement of the law becomes known.
                                    If we become aware of any such infringements, we will remove this content immediately. 
                                </p>
                                <p><strong>Liability for Links:</strong><br>
                                    The respective provider or operator of the pages is always responsible for the content of the linked pages. 
                                    The linked pages were checked for possible legal violations at the time of linking. Illegal contents were not recognizable at the time of linking.
                                    However, a permanent control of the contents of the linked pages is not reasonable without concrete evidence of a violation of the law. If we become aware of any infringements, we will remove such links immediately.
                                </p>
                                <p><strong>Advertisement: </strong><br>
                                    We do not place advertising on our website.<br>
                               </p>
                               <p><strong>Contact:</strong> <br>
                                Tel: 01234-789456<br>
                                Fax: 1234-56789<br>
                                E-Mail: <a href='mailto:customerservice@SellzUp.de'>customerservice@SellzUp.de</a></br>
                                </p>
                                <p> <strong>Responsible: </strong><br>
                                    JJTN GmbH & Co. KG
                                </p>
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
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6d728b5599da92ab',m:'iScpXer0hEZBjSWwtYumYEH6AH5CFu7mnq0GffEsvgA-1643795730-0-AWozRHBAHp6luuiYxdpS17IE12aRlUA1gONUbFNd9cxhTMdUeOVp9ZAgu9EuPZ1zktGrkdh8Rj6O1qKNupooB9Yds5Tc3Nim+Lbuz37bA4c9CzMN4gJMvCB1TDixtnpcMfjYJ7VljW/5hyg65jwO0BpEDF/3ZPdoD6O2dBzqtTtwgE6j1Pz8ATFuQDfhhnwLig==',s:[0xaf3332d4ee,0x2c74c39bc0],}})();</script><script type="text/javascript">(function(){window['__CF$cv$params']={r:'6ddecb5af93f68f7',m:'2NhbRQI0wEe55Xo.noZ_Kd7uZEqZ8_YzBApzrw_cvjA-1644930815-0-AXoC0BOD7NjNJMi5vAtTMNNC2sicFn3qIPwdy7tinM2n2wXCbSCStd9/es+o9puvz6wsAZgVKIdGMUCOST8f1qDe+x4vTDMij1AFLe8nDJx1EwzYlnpR9SlmweVOTenf/x9X7EMcvvnU0svXMAHxpexpcSfO+1WU5l5IddsmwPkM+G4M6yqy+wrvypgJ3JNQk52TE0ZAkl4+OeAfYVludMY=',s:[0x8a2a9d5f18,0xc93c820369],}})();</script><script type="text/javascript">(function(){window['__CF$cv$params']={r:'6ddf85ee7c589124',m:'67kPBSlUwmRfGdgk7DOMObqM67qpdLQwS0ATdEM2KdA-1644938457-0-ASv24MBVt7tayp82UzpAspjQpAc7u2wz3j9Bol4Y4Vcm4YuG/WMVIEHTBamPK23Cff/tbvC2rUuawrAYGgMFXSyyYbVTolTaicnh/PYnoWJhSI3GXpDiRGU1yxVdCPx9tAj2Rgv1mZ9VzxrDm4ou84SOh4HDP3XTuB+bOBTXAOIw+ZwDb3UQT/auEyE258n0HSYgUBcWlHDNxD2ce6tkF7E=',s:[0xfbde0d158c,0x11b130d6a1],}})();</script></body>
</html>