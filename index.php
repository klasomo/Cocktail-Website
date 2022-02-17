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
  <link href="Navbar.php">
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script></head>
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
  <header class="masthead coverImageMain" >
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    <h1 class="mb-5">Search for Cocktail Recipe</h1>
                    <form class="form-search" id="cocktailNameForm" method="POST" action="searchForCocktail.php">
                        <div class="row">
                            <div class="col">
                                <input class="form-control form-control-lg" name="CocktailNameSuche" id="cocktailName" type="cocktailName" placeholder="Cocktail Name" />
                            </div>
                            <div class="col-auto"><button class="btn btn-danger btn-lg" id="submitButton" type="submit">Search</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </header>
  <section class="showcase mt-5">
    <div class="container-fluid p-0">
        <div class="row g-0" onclick="location.href='searchForCocktail.php';">
            <div class="col-lg-6 order-lg-2 showcase-img" style="background-image: url('assets/alcohol_shelf.jpg')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2 class="text-dark">Find Cocktail</h2>
                <p class="lead mb-0 text-dark">You can search for a cocktail and then the requested Cocktail will be displayed to you.</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 showcase-img" style="background-image: url('assets/shopping_list.jpg')"></div>
            <div class="col-lg-6 my-auto showcase-text">
                <h2 class="text-dark">Create Shopping List</h2>
                <p class="lead mb-0 text-dark">You can choose cocktails and the corresponding ingredients will be added to a shopping list.</p>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-lg-6 order-lg-2 showcase-img" style="background-image: url('assets/make_cocktail.jpg')"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                <h2 class="text-dark">Make me a Cocktail</h2>
                <p class="lead mb-0 text-dark">You can add ingredients to your inventory afterwards you will be shown which cocktail you can prepare.</p>
            </div>
        </div>
    </div>
</section>

  </div>
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
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6ddec897dece913d',m:'5DtshUxeOnDvSZgC0tQrD73d35nmkQPLM6ZlLXe7sAQ-1644930702-0-AT3cb6+IupcbOYcdna5VI1NcaIPsRK7daFCzI7AgHA4oJQB+simrizYojBVPmMCLC38IEDxQnvU2Dalzle0pXgQzouZVGrTciIK2KzMtK+qSSbaGS+Ubx0eZLKqefMwk4hGbjSQRwqFxSgBYtS6KcViX7BT9DkyXZcjaYvtmyB324rXdoPLkDXUBHt/M9CWhDA==',s:[0x8708a9a688,0xfa97181fb1],}})();</script></body>
</html>


