<?php
    $LoggedIn = FALSE;
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $LoggedIn = TRUE;
    }else{
      $LoggedIn = FALSE;
    }

    require_once "config.php";
    
    if(isset($_POST["CocktailNameSuche"])){
        $sql ='SELECT * FROM tbl_recipes WHERE rec_name LIKE "'. $_POST["CocktailNameSuche"] .'%";';
    }else{
        $sql ="SELECT * FROM tbl_recipes";
    }
    $db_erg = mysqli_query($link,$sql);

    function getCategory($name,$link2){
        $sqlcategory = 'SELECT cat_name from tbl_categories
        join tbl_recipes_categories on tbl_recipes_categories.cat_id=tbl_categories.cat_id
        join tbl_recipes on tbl_recipes.rec_id=tbl_recipes_categories.rec_id
        where rec_name="'. $name .'";';

        $Category = mysqli_query($link2,$sqlcategory);
        $CategoryName = mysqli_fetch_array($Category,MYSQLI_ASSOC);
        return $CategoryName["cat_name"];
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
  <script src="/js/functions.js"></script>
</head>
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
            <a class="nav-link <?php if($LoggedIn == true){ echo ' active';} else{ echo 'disabled';} ?>" href="showFavourites.php">Favorites</a>
          </li>
        </ul>
        <button class="btn btn-danger" onclick="window.location.href = '<?php if($LoggedIn == true){ echo 'Logout.php';} else{ echo 'PHPLogin.php';}?>'";><?php if($LoggedIn == true){ echo 'Logout';} else{ echo 'Login';} ?></button>
      </div>
  </nav>
  <header class="masthead coverImageFindCocktail">
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
</h2>
<div hidden>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo purus quis mi cursus hendrerit eu eu metus. Aliquam aliquam arcu eget aliquet scelerisque. Pellentesque sodales turpis vitae venenatis vehicula. Ut id porta velit. Ut eu dignissim dui, quis gravida est. Cras quis venenatis mauris, a bibendum enim. Sed at augue libero. Nullam tortor metus, tincidunt ut urna id, posuere placerat orci. Ut quis risus dictum risus facilisis imperdiet quis sed eros.</p>
</div>
<h2>

    <div class="container cocktail-list">
        <div class="container" style="margin-top:50px;">
            <?php
                for($i = 0; $zeile = mysqli_fetch_array($db_erg,MYSQLI_ASSOC); $i++){
                    if($i%4 == 0){
                        echo '<div class="row pt-5">';
                    }
                    echo '
                    <div class="col-md-3">
                        <div class="card-sl">
                            <div class="card-image">
                                <img src="' . $zeile["rec_image"] . '" />
                            </div>
                            <div class="card-text text-light">
                                '. $zeile["rec_name"] .'
                            </div>
                            <div class="card-text text-light">
                                '. getCategory($zeile["rec_name"],$link) .'
                            </div>
                            <form class="" method="POST" action="showSingleCocktail.php">
                            <button class="btn btn-danger card-button" name="cocktailNameView" value="'.$zeile["rec_name"].'">Recipe</button>
                            </form>
                        </div>
                    </div>';
                    if($i%4 == 3){
                        echo "</div>";
                    }
                }
            ?>
        </div>
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
</body>
</html>