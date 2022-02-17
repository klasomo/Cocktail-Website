<?php

require_once "config.php";
$cocktailNameView = $_POST["cocktailNameView"];
$LoggedIn = FALSE;
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $LoggedIn = TRUE;
    }else{
      $LoggedIn = FALSE;
    }


function getCocktailCategory($link2, $cocktailNameView2)
{
    $sqlGetCategory = 'SELECT cat_name FROM tbl_categories
    JOIN tbl_recipes_categories ON tbl_recipes_categories.cat_id=tbl_categories.cat_id
    JOIN tbl_recipes ON tbl_recipes.rec_id=tbl_recipes_categories.rec_id
    WHERE rec_name ="'. $cocktailNameView2 .'";';

    $db_result = mysqli_query($link2, $sqlGetCategory);
    $CocktailCategory = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
    return $CocktailCategory["cat_name"];
}

function getCocktailImage($link3, $cocktailNameView3)
{
    $sqlGetImage = 'SELECT rec_image FROM tbl_recipes WHERE rec_name ="'. $cocktailNameView3 .'";';

    $db_result = mysqli_query($link3, $sqlGetImage);
    $CocktailImage = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
    return $CocktailImage["rec_image"];
}

function getCocktailInstrunctions($link4, $cocktailNameView4)
{
    $sqlGetInstructions = 'SELECT rec_instructions FROM tbl_recipes where rec_name ="'. $cocktailNameView4 .'";';
    $db_result = mysqli_query($link4, $sqlGetInstructions);
    $CocktailInstructions = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
    return $CocktailInstructions["rec_instructions"];
}

function getCocktailID($link5, $cocktailNameView5)
{
    $sqlGetID = 'SELECT id from tbl_recipes_ingredients where rec_id = (select rec_id from tbl_recipes where rec_name ="'. $cocktailNameView5 .'");';

    $db_result = mysqli_query($link5, $sqlGetID);
    $CocktailIDdatabase = array();
    for($i = 0; $CocktailIDdatabase[$i] = mysqli_fetch_array($db_result, MYSQLI_ASSOC); $i++){}
    

    return $CocktailIDdatabase;
}

function getCocktailIngredients($link6, $cocktailNameView6)
{
    $idArray = array();
    $idArray = getCocktailID($link6,$cocktailNameView6);
    $IngredientsArray=array(array());
    for($i = 0; $i+1<count($idArray);$i++){
    $sqlGetAmount = 'SELECT servings, uni_name, ing_name from tbl_recipes_ingredients
    join tbl_ingredients on tbl_ingredients.ing_id=tbl_recipes_ingredients.ing_id
    join tbl_units on tbl_units.uni_id=tbl_recipes_ingredients.uni_id
    where tbl_recipes_ingredients.id ="'. implode('',$idArray[$i]) .'";';

    $db_result = mysqli_query($link6,$sqlGetAmount);
    $IngredientsArray[$i] = mysqli_fetch_array($db_result, MYSQLI_ASSOC);
    }
    return $IngredientsArray;
}


?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create new Cocktail</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="css/style.css">
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
            <div class="container">
                <div class="row mt-5">
                    <div class="vstack gap-2">
                        <img class="cocktail_cover_img" id="import-cocktail-Image" src=<?php echo '"' . getCocktailImage($link,$cocktailNameView) . '"'; ?>>
                    </div>
                    <div class="col col-md-9">
                      
                            
                            <h2><?php echo''. $cocktailNameView .'' ?></h2><br>
                        
                            <label class="mr-5">Category:</label>
                            <label><?php echo''. getCocktailCategory($link,$cocktailNameView) .''; ?></label>
         

                        <div>
                            <label>Cocktail Instructions:</label>
                            <div class="col col-sm-3 col-md-6 text-center">
                                <div class="instructions_singleCocktail">
                                    <label>
                                        <?php
                                            echo '' . getCocktailInstrunctions($link,$cocktailNameView) . '';
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <table class="table table-striped table-light" id="ingredient_table">
                        <thead>
                          <tr>
                            <th scope="col">Servings</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Ingredient</th>
                          </tr>
                        </thead>
                        <tbody id="ingredient_table_body">
                        <?php
                        $db_erg = array(array());
                        $db_erg = getCocktailIngredients($link,$cocktailNameView);
                            for($i=0; $i< count($db_erg);$i++){
                                echo '
                                <tr>
                                    <td id="IngredientAmountCellTemplate">
                                    <label>' .$db_erg[$i]["servings"].'</label>
                                    </td>
                                    <td id="IngredinetUnitCellTemplate">
                                        <label>'. (($db_erg[$i]["uni_name"] == "Null")?' ': $db_erg[$i]["uni_name"]) .'</label>
                                    </td>
                                    <td id="IngredinetCellTemplate">
                                        <label>'.$db_erg[$i]["ing_name"].'</label>
                                    </td>
                                </tr>
                                ';
                            }
                        ?>
                        </tbody>
                      </table>
                    
                </div>
               
            </div>
        <script>
            var Cocktail ={
                Name: "",
                Category: "",
                Instructions: "",
                imageUrl: "",
                Ingredients: [
                    [],
                    [],
                    [],
                ]
            }

            $('select').attr('data-live-search', 'true');
            $('select').attr('data-style', 'form-control');
            $('select').selectpicker();

            $('#input_test').on('keyup', function () {
                console.log($('#cocktail_category_selector'));
                $('#cocktail_category_selector').selectpicker('refresh');
            });

            var counter = 1;
            var Ingredients =["test1","test2","test3","test4"];
            var Units=["ml","l","g","oz","test"];
            window.onload = function() {
                TableInit();
            };

            function TableInit(){
                elementCounter = 0;
                for(var i of Units){
                    elementCounter +=1;
                    $('#ingredientUnit_1').append('<option value="'+i+'">'+i+'</option>');
                }
                $('#ingredientUnit_1').selectpicker("refresh");
                $('#ingredientUnit_1').selectpicker("val",Units[0])
            }

            
            function CreateIngredientTableRow()
            {
                var IngredientTableBody = document.getElementById("ingredient_table_body");
                var newRow = IngredientTableBody.insertRow();
                var rowCount = document.getElementById('ingredient_table').rows.length-1;

                var newAmountCell = newRow.insertCell();
                var amount_input_original = $("#ingredientAmount_1");
                amount_input_clone = amount_input_original.clone();
                amount_input_clone.appendTo(newAmountCell);
                amount_input_clone.attr("id","ingredientAmount_"+rowCount);


                var newUnitCell = newRow.insertCell();

                var UnitCellTemplate = $("#ingredientUnit_1");
                var UnitCellClone = UnitCellTemplate.clone();
                UnitCellClone.appendTo(newUnitCell);
                
                UnitCellClone.attr("id","ingredientUnit_"+rowCount);
                UnitCellClone.find('.bootstrap-select').replaceWith(function() { return $('select', this); });
                
                $('#ingredientUnit_'+rowCount).selectpicker("refresh");

                var newIngredientCell = newRow.insertCell()
                newIngredientCell.innerHTML = document.getElementById("IngredinetCellTemplate").innerHTML
            }


            document.getElementById('btn_import_img').onclick = function() {
                if(isValidImageURL(document.getElementById('image_url').value)){
                    img = document.getElementById('import-cocktail-Image');
                    img.src = document.getElementById('image_url').value;
                }
            }

            function isValidImageURL(str){
                if ( typeof str !== 'string' ) return false;
                return !!str.match(/\w+\.(jpg|jpeg|gif|png|tiff|bmp)$/gi);
            }

            function SaveCocktail()
            {
                alert("Your Cocktail has been saved!");
            }

            document.getElementById("btn_delete_row").onclick = function () 
            {
                var rowCount = document.getElementById('ingredient_table').rows.length;
                if(rowCount > 2){
                    counter-=1;
                    document.getElementById("ingredient_table").deleteRow(rowCount-1);
                }
            }  
            document.getElementById("btn_create_cocktail").onclick = function(){
                Cocktail.Name = document.getElementById("in_cocktailname").value;
                Cocktail.imageUrl = document.getElementById("import-cocktail-Image").src;
                Cocktail.Category = document.getElementById("cocktail_category_selector").value;
                Cocktail.Instructions = document.getElementById("in_cocktail_instruction").value;

                var rowCount = document.getElementById('ingredient_table').rows.length-1;
                for(var i = 0; i < rowCount; i++){
                    Cocktail.Ingredients[i][1] = document.getElementById("ingredientUnit_"+1).value;
                    Cocktail.Ingredients[i][0] = document.getElementById("ingredientAmount_"+1).value;
                    console.log(Cocktail.Ingredients[i][0]);
                }
            }


            document.getElementById("btn_add_ingredient").onclick = function () 
            {
                CreateIngredientTableRow();
            }
        </script>
    <script type="text/javascript">(function(){window['__CF$cv$params']={r:'6ddd7ecf1b126909',m:'s11D9L8xGxjafoo0rLOMOGfuxQZnHFTFq1c.FYC1b.4-1644917194-0-ATfu1Buwtu4O0AYTDOKMNopedy7uQ8HzcPSajrfekYrDGJ2fql11GaG2XXu4XnndDtoJiud4OfUdGPXUmOyPhmE7rDMQ7PAa99npZ1Dxd1v72l9LiPFJ1u51udQ/RkjqYSOFyoDamWvYYr05ryzdmtZiB6N33P1BFi03rY+cqpdRS+/3AjE59i54MAtS74lOsboqiqkCNfISVcoh4de8+Ts=',s:[0x9dbc82b945,0x7afecebdbd],}})();</script></body>
</html>