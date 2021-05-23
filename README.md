# lazur 
A sample project with procedural php. Nothing too fancy, this is just a demo of using prepared statements to display results from database.


Project overview:
For delivers of a company is needed: 
Company, Deliver, Bulstat, Address (which is only a town), Phone number, Year of registry, Person's name.
We have a database with two tables - `provider` (with provider's data) and `cities` (with city data).
Via HTML5 form we can store provider's data which will be outputed as an html table. 
In the form we have a dropdown menu which displays cities from the city table and it will store them accordingly to the address id 
both in the address column from provider's table and the cityId column inside cities table.
We will also have crud operations to update and delete data which will also affect records in the database.

Important files:
* config.php - establish database connection
* create.php - create tables
