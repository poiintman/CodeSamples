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
<br>
<form action="inventory_bwills1514.php" method="post"> 
    <!-- button inputs with appropriate names and values which are used in the
     if statement for processing and form display -->
        <input type="submit" name="add" value="Add a Book"> 
        <input type="submit" name="genre" value="Select by Genre">
        <input type="submit" name="selectYear" value="Select by Year">
        <input type="submit" name="delete" value="Delete book">
        <input type="submit" name="changePrice" value="Change Book Price">
        <input type="submit" name="displayBooks" value="Book Inventory">
        
       
    
</form>
</html>
