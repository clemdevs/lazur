# lazur 
A sample project with procedural php. Nothing too fancy, this is just a demo of using prepared statements to display results from database.


How to run:

You will need apache and mysql services running.
- Edit database variables inside `config.php` based on your mysql credentials to establish a connection, and make sure to have the database lazur created.
- Then go to create.php which will create the tables for the database.

Project overview:
For delivers of a company is needed: 


Company, Deliver, Bulstat, Address (which is only a town), Phone number, Year of registry, Person's name.


We have a database with two tables - `provider` (with provider's data) and `cities` (with city data).


We can store provider's data via HTML5 form  which will be then outputed from the database as an html table. 
In the form we have a dropdown menu which displays cities from the city table and it will store them accordingly to the address id 
both in the address column from provider's table and the cityId column inside cities table.
We will also have crud operations to update and delete data which will also affect records in the database.

Important files:
* config.php - establish database connection
* create.php - create/manage tables data

Crud files:
* update1.php - Displays provider's phone, deliver, and name only. Updates 1 provider name, phone, or bulstat via mysqli query.
* delete1.php - Displays provider's bulsat only. Deletes 1 provider via mysqli query. 

Todo:
* Add Update and Delete methods for both multiple records and one record.
