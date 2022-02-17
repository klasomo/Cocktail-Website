<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
    }

    $LoggedIn = FALSE;
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $LoggedIn = TRUE;
    }else{
      $LoggedIn = FALSE;
    }

    require_once "config.php";

    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["username"])){

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username!";
        } else{
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password!";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT usr_id, usr_name, usr_password FROM tbl_users WHERE usr_name = ?";
            if($stmt = mysqli_prepare($link,$sql)){
                mysqli_stmt_bind_param($stmt,"s",$param_username);
                $param_username = $username;
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            echo "$password";
                            echo password_verify($password,$hashed_password);
                            if(password_verify($password,$hashed_password)){
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                header("location: index.php");
                            } else{
                                $login_err = "Invalid username or password!";
                            }
                        }
                    } else{
                        $login_err = "Invalid username or password!";
                    }
                }else{
                    echo "Oops! Something went wrong! Please try again later!";
                }
                mysqli_stmt_close($stmt);
            }
        }
    }
        mysqli_close($link);
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
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">

					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
                            <?php 
                                if(!empty($login_err)){
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }        
                            ?>
							<form method="POST" class="my-login-validation" novalidate="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
								<div class="form-group">
									<label>Username</label>
									<input id="username" type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" name="username" value="<?php echo $username; ?>" required autofocus>
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" required data-eye >
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-danger btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="PHPregister.php">Create One</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer text-center">
						Copyright &copy; 2022 SelzzUp 
					</div>
				</div>
			</div>
		</div>
	</section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6d728b5599da92ab',m:'iScpXer0hEZBjSWwtYumYEH6AH5CFu7mnq0GffEsvgA-1643795730-0-AWozRHBAHp6luuiYxdpS17IE12aRlUA1gONUbFNd9cxhTMdUeOVp9ZAgu9EuPZ1zktGrkdh8Rj6O1qKNupooB9Yds5Tc3Nim+Lbuz37bA4c9CzMN4gJMvCB1TDixtnpcMfjYJ7VljW/5hyg65jwO0BpEDF/3ZPdoD6O2dBzqtTtwgE6j1Pz8ATFuQDfhhnwLig==',s:[0xaf3332d4ee,0x2c74c39bc0],}})();</script></body>
</html>