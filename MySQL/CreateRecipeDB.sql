-- -------------------------------------------------------------
-- 						CREATE
-- -------------------------------------------------------------
drop database if exists recipes;
create database if not exists recipes;
use recipes;

drop table if exists tbl_users;
CREATE TABLE IF NOT EXISTS tbl_users (
    usr_id INT AUTO_INCREMENT PRIMARY KEY,
    usr_name VARCHAR(45) NOT NULL UNIQUE,
    usr_password VARCHAR(255) NOT NULL
);

drop table if exists tbl_recipes;
CREATE TABLE IF NOT EXISTS tbl_recipes (
    rec_id INT AUTO_INCREMENT PRIMARY KEY,
    rec_name VARCHAR(45) NOT NULL UNIQUE,
    rec_image VARCHAR(100),
    rec_instructions VARCHAR(2600)
);

drop table if  exists tbl_favourites;
CREATE TABLE IF NOT EXISTS tbl_favourites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usr_id INT NOT NULL,
    rec_id INT NOT NULL,
    CONSTRAINT uq_favorites UNIQUE (usr_id, rec_id),
    CONSTRAINT fk_fav_usr FOREIGN KEY (usr_id)
        REFERENCES tbl_users (usr_id) 
        ON DELETE CASCADE,
	CONSTRAINT fk_fav_rec FOREIGN KEY (rec_id)
        REFERENCES tbl_recipes (rec_id)
        ON DELETE CASCADE
);

drop table if exists tbl_ingredients;
CREATE TABLE IF NOT EXISTS tbl_ingredients (
    ing_id INT AUTO_INCREMENT PRIMARY KEY,
    ing_name VARCHAR(45) NOT NULL
);

drop table if  exists tbl_inventory;
CREATE TABLE IF NOT EXISTS tbl_inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usr_id INT NOT NULL,
    ing_id INT NOT NULL,
    CONSTRAINT uq_inventory UNIQUE (usr_id, ing_id),
    CONSTRAINT fk_inv_usr FOREIGN KEY (usr_id)
        REFERENCES tbl_users (usr_id)
        ON DELETE CASCADE,
	CONSTRAINT fk_inv_ing FOREIGN KEY (ing_id)
        REFERENCES tbl_ingredients (ing_id)
        ON DELETE CASCADE
);

drop table if  exists tbl_categories;
CREATE TABLE IF NOT EXISTS tbl_categories (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_name VARCHAR(45) NOT NULL UNIQUE
);

drop table if exists tbl_recipes_categories;
CREATE TABLE IF NOT EXISTS tbl_recipes_categories (
	id INT AUTO_INCREMENT PRIMARY KEY,
    rec_id INT NOT NULL,
    cat_id INT NOT NULL,
    CONSTRAINT uq_reccat UNIQUE (rec_id, cat_id),
    CONSTRAINT fk_reccat_cat FOREIGN KEY (cat_id)
        REFERENCES tbl_categories (cat_id)
        ON DELETE CASCADE,
	CONSTRAINT fk_reccat_rec FOREIGN KEY (rec_id)
        REFERENCES tbl_recipes (rec_id)
        ON DELETE CASCADE
);

drop table if exists tbl_units;
CREATE TABLE IF NOT EXISTS tbl_units (
	uni_id INT AUTO_INCREMENT PRIMARY KEY,
    uni_name VARCHAR(45) NOT NULL UNIQUE
);

drop table if exists tbl_recipes_ingredients;
CREATE TABLE IF NOT EXISTS tbl_recipes_ingredients (
	id INT AUTO_INCREMENT PRIMARY KEY,
    rec_id INT NOT NULL,
    ing_id INT NOT NULL,
    uni_id INT NOT NULL,
    servings VARCHAR(45) NOT NULL,
    CONSTRAINT uq_reccat UNIQUE (rec_id, ing_id, uni_id),
    CONSTRAINT fk_recing_ing FOREIGN KEY (ing_id)
        REFERENCES tbl_ingredients (ing_id)
        ON DELETE CASCADE,
	CONSTRAINT fk_recing_uni FOREIGN KEY (uni_id)
        REFERENCES tbl_units (uni_id)
        ON DELETE CASCADE,
	CONSTRAINT fk_recing_rec FOREIGN KEY (rec_id)
        REFERENCES tbl_recipes (rec_id)
        ON DELETE CASCADE
);
