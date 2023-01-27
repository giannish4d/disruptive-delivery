As explained in the document, the whole project was developed in WordPress. This was done to help with the User Interface, connection to database, login system etc. 
Local by Flewheel was used to run the WordPress locally, therefore it is not live


As the code in this matter is only relevant to check wether what we describe in the Final Document matches with the implementation, in this git we do not include the
whole WordPress project for the following reasons:
  - It is hard to import a whole WordPress project as everything has to be very precise on what versions of php,database and webserver you are going to use.
  - In the MariaDB database, a lot of metadata are included that are only used to support the functionality of the WordPress dashboard
  - PHP functions are in a global functions.php file in the WordPress's current theme directory.
  - In some pages (e.g the Homepage), the design of HTML pages was done by WordPress and then custom HTML blocks were used to write the javascript functions.
  - Login system was implemented by a plugin
  - Master page - header,footer etc. were designed by the WordPress's theme (with a UI) and basically the stylesheet was applied automatically to each page



Therefore, in this git we uploaded only the files that are relevant for what is described in the Final Document:
  -php:       The Server Side PHP files that are relevant for each page (Some of these php files, include the queries for the database)
  -js:        The javascript functions that make requests to the server (to call a PHP function)
  -database:  The 5 tables from the database that are responsible for the functionalities of our scope
  
  
The complete website was implemented and shown in the second presentation aswell so this is why we believe it is not as relevant to include technical details of wordpress.
However if it is requested, I can make the WordPress project live on a server and give admin details for the dashboard. 

