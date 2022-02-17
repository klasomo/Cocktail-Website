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
                        <img class="cocktail_cover_img" id="import-cocktail-Image" src="https://us.123rf.com/450wm/captainvector/captainvector1601/captainvector160108917/51367288-cocktail-glass.jpg?ver=6">
                        <form >
                            <input class="form-control" id="image_url" placeholder="Image URL" value="">
                        </form >
                        <div>
                            <input type="button" class="btn btn-danger" id="btn_import_img" value="Load Image"/>
                        </div>
                    </div>
                    <div class="col col-md-9">
                        <form class="form-inline form-group">
                            <label class="mr-5">Cocktail Name:</label>
                            <input id="in_cocktailname" placeholder="Cocktail Name" value="" name="cocktailName">
                        </form>
                        <form class="form-inline form-group search_select_category" id="input_test">
                            <label class="mr-5">Category:</label>
                            <select class="selectpicker" data-live-search="true" id="cocktail_category_selector">
                                <option>Cocktail</option>
                                <option>Shot</option>
                                <option>Soft Drink</option>
                                <option>Beer</option>
                                <option>Punch / Party Drink</option>
                                <option>Shake</option>
                                <option>Ordinary Drink</option>
                                <option>Other/Unknown</option>
                            </select>
                        </form>
                        <div>
                            <label>Cocktail Instructions:</label>
                            <div class="col col-sm-3 col-md-6 text-center">
                                <form class="instructions" mehtod="GET">
                                    <textarea name="instruction-textarea" rows = "4" cols = "50" id="in_cocktail_instruction" placeholder="You can type up to 200 Characters"></textarea><br>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <table class="table table-striped table-light" id="ingredient_table">
                        <thead>
                          <tr>
                            <th scope="col">Serving</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Ingredient</th>
                          </tr>
                        </thead>
                        <tbody id="ingredient_table_body">
                          <tr>
                            <td id="IngredientAmountCellTemplate">
                                <input placeholder="Serving" value="" id="ingredientAmount_1">
                            </td>
                            <td id="IngredinetUnitCellTemplate">
                                    <select class="selectpicker" data-live-search="true" id="ingredientUnit_1">
                                        <!--Options set in Javascript-->
                
                                    </select>
                            </td>
                            <td id="IngredinetCellTemplate">
                                <input placeholder="Ingredient" value="" id="ingredientName_1">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    
                </div>
                <div>
                    <input type="button" class="btn btn-danger" id="btn_add_ingredient" value="Add Ingredient"/>
                    <input type="button" class="btn btn-danger" id="btn_delete_row" value="Delete Row"/>
                </div>
                <?php

                    require_once "config.php";

                    $Cocktail_id = 0;
                    $ing_id = 0;
                    $ing_amount = 0;

                    $cocktail = array (
                        "Name" => "",
                        "Category" => "",
                        "Instructions" => "",
                        "imageUrl" => "",
                        "Ingredients" => [
                            [],
                            [],
                            []
	                    ]
                    );

                    if(isset($_POST['btn_create_cocktail'])){
                        $cocktail = json_decode($_POST['jsonCocktail']);
                        $_POST = array();
                        

                         //counter for to-be-added ingredients
                        $ing_amount = count($cocktail->{'Ingredients'}[0]);

                        $Cocktail_id = get_id_by_name($link, "rec_id", "tbl_recipes", "rec_name", $cocktail->{"Name"});

                        //when there is no cocktail in our database with the same name ...
                        if ($Cocktail_id == 0) {

                            //...we have to save the new one in "tbl_recipes"
                            insert_into_recipes($link, $cocktail->{"Name"}, $cocktail->{"imageUrl"}, $cocktail->{"Instructions"});
                            $Cocktail_id = get_id_by_name($link, "rec_id", "tbl_recipes", "rec_name", $cocktail->{"Name"});

                            //afterwards we have to adapt our linking tables
                                //tbl_recipes_ingredients
                            
                            for ($i=0; $i < $ing_amount; $i++) { 
                                $IngredientInfo = array($cocktail->{"Ingredients"}[0][$i],$cocktail->{"Ingredients"}[1][$i],$cocktail->{"Ingredients"}[2][$i]);
                                
                                insert_into_recipes_ingredients($link, $Cocktail_id, $IngredientInfo);
                            }
                                //tbl_recipes_categories
                            insert_into_recipes_categories($link, $Cocktail_id, (get_id_by_name($link, "cat_id", "tbl_categories", "cat_name", $cocktail->{"Category"})));

                        } else {
                            echo "<script type='text/javascript'>alert('Cocktailname already exists');</script>";
                         
                        }
                    }
                  
    
                    //Befor adding a new cocktail we have to check if there is no cocktail with the same name in our database
       
                    function get_id_by_name($db, $wanted_id, $tbl, $condition, $name)
                    {
                        $sql="SELECT $wanted_id FROM $tbl WHERE $condition = '$name'";
                        

                        try {
                            $result = mysqli_query($db, $sql);
                            $fetch = mysqli_fetch_array($result);

                            //item noavailable
                            if ($fetch == null)
                                return 0;
                            else
                                return $fetch[0];

                        } catch (mysqli_sql_exception $ex) {
                            $ex->getMessage();
                            die();
                        }
                    }


                    function insert_into_recipes($db, $_rec_name, $_rec_image, $_rec_instructions)
                    {
                        $sql = "INSERT INTO tbl_recipes (rec_name, rec_image, rec_instructions) VALUES (?,?,?)";

                        //Prepare an insert statement
                        if($stmt = mysqli_prepare($db, $sql))
                        {
                            //Bind variables to parameters
                            mysqli_stmt_bind_param($stmt, "sss", $rec_name, $rec_image, $rec_instructions);

                            $rec_name = $_rec_name;
                            $rec_image = $_rec_image;
                            $rec_instructions = $_rec_instructions;
            
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                            }else{
                                echo "Insert Into tbl_recipes went wrong";
                                //TODO FEEDBACK
                            }

                            mysqli_stmt_close($stmt);
                        }
                        else{
                            //TODO
                        }

                    }

                    function insert_into_recipes_ingredients($db, $_rec_id, $array)
                    {
                        //check if there is already an ingredient with this name
                        $_ing_id = get_id_by_name($db, "ing_id", "tbl_ingredients", "ing_name", $array[2]);
        
                        //if not available -> insert into ingredients
                        if ($_ing_id == 0) {
                            insert_into_ingredients($db, $array[2]);
                        }


                        $sql = "INSERT INTO tbl_recipes_ingredients (rec_id, ing_id, uni_id, servings) VALUES (?,?,?,?)";
        
                        //Prepare an insert statement 
                        if($stmt = mysqli_prepare($db, $sql))
                        {
                            //Bind variables to parameters 
                            mysqli_stmt_bind_param($stmt, "iiis", $rec_id, $ing_id, $uni_id, $servings);

                            $rec_id = $_rec_id;
                            $ing_id = get_id_by_name($db, "ing_id", "tbl_ingredients", "ing_name", $array[2]);
                            $uni_id = get_id_by_name($db, "uni_id", "tbl_units", "uni_name", $array[1]);
                            $servings = $array[0];

                           

                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                            }else{
                                echo "Insert Into tbl_recipes_ingredients went wrong";
                            }

                            mysqli_stmt_close($stmt);
                        }

                        
                    }

                    function insert_into_recipes_categories($db, $_rec_id, $_cat_id)
                    {
                        $sql = "INSERT INTO tbl_recipes_categories (rec_id, cat_id) VALUES (?,?)";
        
                        //Prepare an insert statement
                        if($stmt = mysqli_prepare($db, $sql))
                        {
                            //Bind variables to parameters
                            mysqli_stmt_bind_param($stmt, "ii", $rec_id, $cat_id);

                            $rec_id = $_rec_id;
                            $cat_id = $_cat_id;
            
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                            }else{
                                echo "Insert Into tbl_recipes_categories went wrong";
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }


                    function insert_into_ingredients($db, $_ing_name)
                    {
                        $sql = "INSERT INTO tbl_ingredients (ing_name) VALUES (?)";
        
                        //Prepare an insert statement
                        if($stmt = mysqli_prepare($db, $sql))
                        {
                            //Bind variables to parameters
                            mysqli_stmt_bind_param($stmt, "s", $ing_name);

                            $ing_name = $_ing_name;
            
                            if (mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_store_result($stmt);
                            }else{
                                echo "Insert Into tbl_ingredients went wrong";
                            }

                            mysqli_stmt_close($stmt);
                        }
                    }

                       
                ?>
 
                <form method="post" class="mt-5">
                    <input type="hidden" id="jsonCocktailString" value="" name="jsonCocktail">
                    <input type="submit" class="btn btn-danger" id="btn_create_cocktail" value="Create Cocktail" name="btn_create_cocktail"/>
                </form>

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
            
            var Units=["cl","cl hot","dl","ml","gr","oz","oz hot","glass","lb","cube","spash","splashes","tsp","tbsp","drop","shot","cup","part","scoops"];
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
                document.getElementById("ingredientAmount_"+rowCount).value = "";

                var newUnitCell = newRow.insertCell();

                var UnitCellTemplate = $("#ingredientUnit_1");
                var UnitCellClone = UnitCellTemplate.clone();
                UnitCellClone.appendTo(newUnitCell);
                
                UnitCellClone.attr("id","ingredientUnit_"+rowCount);
                UnitCellClone.find('.bootstrap-select').replaceWith(function() { return $('select', this); });
                
                $('#ingredientUnit_'+rowCount).selectpicker("refresh");


                var newIngredientCell = newRow.insertCell()

                var IngredientCellTemplate = $("#ingredientName_1");
                var IngredientCellClone = IngredientCellTemplate.clone();
                IngredientCellClone.appendTo(newIngredientCell);
   
                IngredientCellClone.attr("id","ingredientName_"+rowCount);
                document.getElementById("ingredientName_"+rowCount).value = "";
  
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
                    
                    document.getElementById("ingredient_table").deleteRow(rowCount-1);
                }
            }  

            document.getElementById("btn_create_cocktail").onclick = function(evt){


                Cocktail.Name = document.getElementById("in_cocktailname").value;
                if( Cocktail.Name == ""){
                    evt.preventDefault();
                    alert("Cocktailname can´t be empty");
                    return;
                }
                Cocktail.imageUrl = document.getElementById("import-cocktail-Image").src;
                Cocktail.Category = document.getElementById("cocktail_category_selector").value;
                Cocktail.Instructions = document.getElementById("in_cocktail_instruction").value;

                var rowCount = document.getElementById('ingredient_table').rows.length-1;
                for(var i = 0; i < rowCount; i++){
                    console.log(document.getElementById("ingredientName_"+(i+1)).value);
                    if(document.getElementById("ingredientName_"+(i+1)).value != "" && document.getElementById("ingredientAmount_"+(i+1)).value != ""){
                        Cocktail.Ingredients[0][i] = document.getElementById("ingredientAmount_"+(i+1)).value;
                        Cocktail.Ingredients[1][i] = document.getElementById("ingredientUnit_"+(i+1)).value;
                        
                        Cocktail.Ingredients[2][i] = document.getElementById("ingredientName_"+(i+1)).value; 
                    }else{
                        Cocktail.Name = "";
                        Cocktail.imageUrl = "";
                        Cocktail.Category = "";
                        Cocktail.Instructions = "";

                        Cocktail.Ingredients[0] = [];
                        Cocktail.Ingredients[1] = [];
                        Cocktail.Ingredients[2] = [];

                        evt.preventDefault();
                        alert("Ingredient can´t be empty");
                        break;
                    }
                }

                for (let i = 0; i < Cocktail.Ingredients[0].length; i++) { // nested for loop
                    for (let j = 0; j < Cocktail.Ingredients[0].length; j++) {
                        // prevents the element from comparing with itself
                        if (i !== j) {
                            // check if elements' values are equal
                            if (Cocktail.Ingredients[0][i] === Cocktail.Ingredients[0][j] && Cocktail.Ingredients[1][i] === Cocktail.Ingredients[1][j] && Cocktail.Ingredients[2][i] === Cocktail.Ingredients[2][j]) {
                                // duplicate element present                                
                                alert("two ingredient rows are the same");
                                evt.preventDefault();
                                break;
                            }
                        }
                    }
                }

                var s = JSON.stringify(Cocktail);
         
                document.getElementById("jsonCocktailString").value = s;
                //json_decode auf PHP seite
            }


            document.getElementById("btn_add_ingredient").onclick = function () 
            {
                CreateIngredientTableRow();
            }
        </script>
    <script type="text/javascript">(function(){window['__CF$cv$params']={r:'6ddd7ecf1b126909',m:'s11D9L8xGxjafoo0rLOMOGfuxQZnHFTFq1c.FYC1b.4-1644917194-0-ATfu1Buwtu4O0AYTDOKMNopedy7uQ8HzcPSajrfekYrDGJ2fql11GaG2XXu4XnndDtoJiud4OfUdGPXUmOyPhmE7rDMQ7PAa99npZ1Dxd1v72l9LiPFJ1u51udQ/RkjqYSOFyoDamWvYYr05ryzdmtZiB6N33P1BFi03rY+cqpdRS+/3AjE59i54MAtS74lOsboqiqkCNfISVcoh4de8+Ts=',s:[0x9dbc82b945,0x7afecebdbd],}})();</script></body>
</html>