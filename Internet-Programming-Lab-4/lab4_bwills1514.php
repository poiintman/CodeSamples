<!DOCTYPE html >
<!--

Programmer: Bryan Wills
Class ID: bwills1415
Lab 4
CIS 2800: Internet Programming
Fall 2015
Due date: 12/4/15   
Date completed: 12/3/15
*************************************
Program Explanation
A web page that displays an Inventory management system for a small bookstore.  
The program allows the user to view all of the books in inventory, add a book to 
inventory, view books by genre, books that were published, before,after or durring
a year the user enters, delete a book from inventory, and to change the price of 
a book.

The script uses one file for processing and displaying forms, a  file for 
displaying the home page where the user can add a book and an additional
css style file.  Uses REGEX for data validation forms and form processing and introduces
SQL Queries.

-->

    
<head>
        <!-- Text in browser Tab -->
	<title>Database Query Results</title>
	<!-- links php file to style sheet -->
        <link rel="stylesheet" type="text/css" href="style_bwills1514.css" class ='add' />
<!-- header file include -->
<?php include_once 'inc_header.php'; ?>
<!-- Header output -->
<h2>Add a Book To Inventory</h2>
</head>
<body>
    <!-- creation of form for adding books to the stores inventory-->
    <form action="inventory_bwills1514.php" method="post" name ='add' class ='add'  >
        <!--table parameters -->
 <table width = '50%'border = '1'table align="center">
     <!-- output of  row with text field for user entry -->
  <tr><td>ISBN13:</td><td><input type ="text" name = "isbn"/></td></tr>
  <!-- output of row with text field for user entry --> 
<tr><td>Book Title:</td><td><input type ="text" name="bookTitle"/></td>
     <!-- output of row with text field for user entry -->
<tr><td>Author's First Name:</td><td><input type ="text" name="firstName"/></td></tr>
<!-- output of row with text field for user entry -->
<tr><td>Author's Last Name:</td><td><input type ="text" name="lastName"/></td></tr>
<!-- Output of a genre drop down list for easier sorting by genre -->
<tr><td>Genre:</td>
<td><select name ="genres">
        <option value ="Science Fiction">Science Fiction</option>
        <option value ="Cooking">Cooking</option>
        <option value ="Fiction">Fiction</option>
        <option value ="Horror">Horror</option>
        <option value ="History">History</option>
        <option value ="Biography">Biography</option>
        <option value ="Children's">Children's</option>
            </select></td></tr>
<!-- output of row with text field for user entry -->
<tr><td>Publisher:</td><td><input type ="text" name="publisher"/></td></tr>
<!-- output of row with text field for user entry -->
<tr><td>Copyright Year:</td><td><input type ="text" name="copyrightYear"/></td></tr>
<!-- output of row with text field for user entry -->
<tr><td>Price:</td><td><input type ="text" name="price"/></td></tr>
<!-- submit button for processing -->
<tr><td><input type ="submit" name="submit" value = "Submit"/></td><td>
        <!-- clear button to clear form -->
        <input type ="submit" name="clear"value = "Clear"/></td></tr></table></form>
<message>
    <!-- message about price text field input -->
    Price should be entered as ###.##.
</message>

<?php
// includes of navigation and footer files
include_once "inc_navigation_bwills1514.php";
include_once "inc_footer.php"
?>

</body>
</html>
