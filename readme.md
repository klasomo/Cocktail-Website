Welcome to the installation of our cocktail database.

Note: The following instructions take place in the MySQL-Workbench. Open the relevant SQL-files in your root-access.
Installation:
	We start with the document "RecipeDB.sql". You have to execute this SQL-script once completely.
	If no error occurs the database is completely installed.
	Otherwise use our alternative installation (but this means more work for you).

Alternative installation:
	We start with the document "CreateRecipeDB,sql". You have to execute this SQL-script once completely.
	After that we continue with the document "LoadDataRecipeDB.sql" - here you have to adjust the path 
	of the CSV-files contained in this folder. (The "TODO" indicates the relevant sections)
	Please ensure consistent use of "\\" or "/".

	Afterwards you also need to run that script once completely.
	Finally the included "SELECT" statements can be used for verification.
	If no error occurs the database is completely installed.
	Otherwise contact us.

Before using our website you have to modify the user access in our "config.php" (DB_USERNAME, DB_PASSWORD)
- this does not take place in the MySQL-Workbench.

Thank you for choosing our product.
Best regards JJTN