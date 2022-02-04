<?php 
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //validate username $_POST["username"] wenn gesetzt ist dann...
    if(isset($_POST["username"])){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username!";
    } elseif(!preg_match('/^[a-zA-Z0-9_0]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores!";
    } else{
        $sql = "SELECT usr_id FROM tbl_users WHERE usr_name = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt,"s",$param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Username is already taken!";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ups! Something went wong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    //validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password!";
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have atleast 8 characters!";
    } else{
        $password = trim($_POST["password"]);
    }
    //Validate Confirmpassword
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password!";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match!";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO tbl_users (usr_name, usr_password) VALUES (?,?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss",$param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)){
                header("location: PHPlogin.php");
            } else{
                echo "Upsala! Something went wrong!";
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
  <link rel="php" href="PHPUser.php">
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script></head>
<body>
	
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand text-center">
						<h1 class="">SelzzUp</h1>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" novalidate="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" name="username" required autofocus>
                                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" required data-eye value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group">
									<label for="confirm_password">Confirm Password</label>
									<input id="confirm_password" type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                </div>
								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
									</div>
								</div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-danger btn-block" onclick="CheckValidation()">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="login.html">Login</a>
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
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6d728b408a1b92ab',m:'2HCIJcfk3G.p2QijePrTboljuGYdpXHMmqbDdeAXtuo-1643795727-0-AQO3Pi24b7FCFrFL0QsmXMoM1FOIuJcuDIu2IexeA34T4Cpqbi6McHeyjsLI1NQhSkDf4dH6RWY6YlqXxiIHFEBA3d9fgjcr8SkeXwxUzqieIC5lHLHZLzemdCjP7l+SQGApVs2MOPJHHkXbo7MA4I6xcaOYh+iHLFS3wA9gL2Zb7qc9/L6Ah7tsgOyEdm9hIs8hIqT7O+P/aPLYrWypwYE=',s:[0xb470264f69,0x96e07457d8],}})();</script>
</body>
</html>