-- -------------------------------------------------------------
-- 						LOAD
-- -------------------------------------------------------------
-- USERS
load data infile 'D:\\UserData\\z0047dtc\\OneDrive - Siemens AG\\Documents\\SPE\\2022_01_31_PTI018\\InstallCocktailDB\\users.csv' 
into table tbl_users
fields terminated by ';' optionally enclosed by '"' (usr_name, usr_password);
-- select * from tbl_users;

-- RECIPES
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/recipes.csv' 
into table tbl_recipes
fields terminated by ';' optionally enclosed by '"' (rec_name, rec_image, rec_instructions);
-- select * from tbl_recipes;

-- FAVORITE
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/favorites.csv' 
into table tbl_favourites
fields terminated by ';' optionally enclosed by '"' (usr_id, rec_id);
-- select * from tbl_favorites;

-- INGREDIENTS
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/ingredients.csv' 
into table tbl_ingredients
fields terminated by ';' optionally enclosed by '"' (ing_name);
select * from tbl_ingredients;

-- INVENTORY -- TODO
-- load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/inventory.csv' 
-- into table tbl_inventory
-- fields terminated by ';' optionally enclosed by '"' (usr_id, ing_id);
-- select * from tbl_inventory;

-- CATEGORIES
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/categories.csv' 
into table tbl_categories
fields terminated by ';' optionally enclosed by '"' (cat_name);
-- select * from tbl_categories;

-- RECIPES_CATEGORIES
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/recipe_categories.csv' 
into table tbl_recipes_categories
fields terminated by ';' optionally enclosed by '"' (rec_id, cat_id);
-- select * from tbl_recipes_categories;

-- UNITS
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/units.csv' 
into table tbl_units
fields terminated by ';' optionally enclosed by '"' (uni_name);
-- select * from tbl_units;

-- RECIPES_INGREDIENTS
load data infile 'D:/UserData/z0047dtc/OneDrive - Siemens AG/Documents/SPE/2022_01_31_PTI018/InstallCocktailDB/recipe_ingredients.csv' 
into table tbl_recipes_ingredients
fields terminated by ';' optionally enclosed by '"' (rec_id, ing_id, uni_id, servings);
-- select * from tbl_recipes_ingredients;