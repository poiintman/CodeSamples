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
	<title>Bryan's Books</title>
	<!-- links php file to style sheet -->
        <link rel="stylesheet" type="text/css" href="style_bwills1514.css" />	
        <!-- header include statement -->
        <?php include_once 'inc_header.php'; ?>  
</head>

  

    
<body>
<?php

// main if else statement that works as a switch to  handle site and form navigation
// checks to see which button is clicked by checking to see if each button $_POST
// is set.
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           Display Inventory                               |
  //|                                                                           |
  //-----------------------------------------------------------------------------

// if display books is clicked
  if(isset($_POST['displayBooks']))
  {
      // process string == value of button
      $processString = $_POST['displayBooks'];
      // if value = book inventory...
      if($processString == "Book Inventory")
      {
          // outputs header
          echo("<h2> Inventory</h2>");
         //  sql statment selects all data from books table in database
        $queryString  = "SELECT * FROM books ORDER BY author_lastName ";
        // saves the result of the query in an array variable
        $result = QueryDatabase($queryString);
        // outputs the variable using the Display result function, passes in result
        DisplayResult($result);
        
      }
      
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           Add a Book                                      |
  //|                                                                           |
  //-----------------------------------------------------------------------------
  // if the add button is clicked
  else if(isset($_POST['add']))
  {   
   // seperate file that displays the add a book form is included.
          include_once 'lab4_bwills1514.php';
  }
  // if one of the two buttons with the name genre are clicked..
   else if(isset($_POST['genre']))
  {     // process string = button value using post method
      $processString = $_POST['genre'];
      // if he string is Select by genre
      if($processString == "Select by Genre")
      { // form is displayed that allows the user to select a genre...
          ?> <form action="inventory_bwills1514.php" method="post"  > 
            <!--header output -->
             <h2> Select By Genre</h2>
             <!--prompt and text field for starting point to add songs -->
            Select a genre you would like to select by: 
            <!-- select control that is filled with different book genres -->
            <select name ="genres">
                <option value ="Science Fiction">Science Fiction</option>
                <option value ="Cooking">Cooking</option>
                <option value ="Fiction">Fiction</option>
                <option value ="Horror">Horror</option>
                <option value ="History">History</option>
                <option value ="Biography">Biography</option>
                <option value ="Children's">Children's</option>
            </select>
            <!-- Enter Button -->
            <input type="submit" id ="submit" name="genre" value="Enter" > <br>
             <br> <?php
      }
      else // when the enter button with the name genre is clicked the form is processed
      {
       // query string is created using the selected genre and searches the database for
       // books that match the genre
      $queryString  = "SELECT * FROM `books` WHERE `genre` LIKE '".$_POST['genres']."'";
      // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
      $result = QueryDatabase($queryString);
      // header is output
      echo("<h2>All ".$_POST['genres']." Books In Inventory</h2>");
      // the results of the query are displayed using the Display Result function
      DisplayResult($result);
      }    
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           select book by year                             |
  //|                                                                           |
  //-----------------------------------------------------------------------------
  // if one of the two select year buttons is clicked
  else if(isset($_POST['selectYear']))
  {   // the value is stored in a string
      $processString = $_POST['selectYear'];
      // if the string is equl to select by year...
      if($processString == "Select by Year")
      {
          // from for selecting a year to sort by is output
         ?> <form action="inventory_bwills1514.php" method="post" > 
            <!--header output -->
             <h2> Select By Year</h2>
            
            Search for a book written
            <!-- Select control to select search modifier (beginning, after or during -->
            <select name ="typeOfSearch">
                <option value ="before">Before</option>
                <option value ="after">After</option>
                <option value ="during">During</option>
              
            </select>
            the year
            <!-- text field input that accepts the user entered year -->
            <input type ='text' name ='year' size = '4'>.
            <!-- submit button will be processed in the else  of this control -->
            <input type="submit" id ="submit" name="selectYear" value="Enter" > <br>
            <!-- prompt and text field for the titles of songs separated by a , -->
             <br> <?php
      }
      
      else 
      {
            // initializes the compare string that will be used for the SQL Query
            $comparestring = "=";
            // if the user selects after for the modifier...
            if($_POST['typeOfSearch'] == "after")
            {// compare string is set to greater than
              $comparestring = ">";
            }
            // if the user selects before as the modifier..
            elseif ($_POST['typeOfSearch'] == "before")
            {// the compare string is set to less than
             $comparestring = "<";
            }
            // if the user selects during as the modifier...
            elseif ($_POST['typeOfSearch'] == "during")
            {
                // the compare string is set to equal
             $comparestring = "=";
            }
            // sql query string is stored into a string variable selecting all of the books
            // where the year published concatinated with the modifier and the year for more user control
            $queryString  = "SELECT * FROM books WHERE yearPublished ".$comparestring." ".$_POST['year'];
             // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
            $result = QueryDatabase($queryString);
            // header output
            echo("<h2>All books published ".$_POST['typeOfSearch']." ".$_POST['year']." in inventory</h2>");
            // the result of the query is displayed using the display result function.
            DisplayResult($result);
          
          
      }    
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           delete book                                     |
  //|                                                                           |
  //-----------------------------------------------------------------------------
 // if either of the two delete buttons is clicked...
  else if(isset($_POST['delete']))
  {   // value of the button is stored in a string variable
      $processString = $_POST['delete'];
      // if the string variable = delete book
      if($processString == "Delete book")
          // header is output
      {   echo("<h2> Delete Book</h2>");
      // query string that selects all titles of the books from the table
          $queryString = "SELECT title FROM books";
          // stores the result array from the query  that is returned by the
          // Query Database function
          $result = QueryDatabase($queryString);
          // gets the number of rows from the result array
          $rows = $result->num_rows;
          // form is created
          ?> <form action="inventory_bwills1514.php" method="post" >
              <!-- output of form information, select input is created-->
              Select a book to delete  <select name ="books" ><?php
        // loop that loads each title into the select control
        for ($j = 0 ; $j < $rows ; ++$j)
        { // seek to record j and...
            $result->data_seek($j);
            // store record in assosiative array
            $row = $result->fetch_array(MYSQLI_ASSOC);
            // output of fields into options using assosiation
            print('<option value = '."'".$row['title']."'>".$row['title']."</option>");
            
        }
        ?></select> 
           <!-- submit button -->
          <input type="submit" id ="submit" name="delete" value="Delete from Inventory" > <br> <?php
            
      }
      else 
      { // processing of delete form...
        // Query string that deletes books by title that is selected...
        $queryString  = "DELETE FROM books WHERE title = '".$_POST['books']."'";
         // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
        $result = QueryDatabase($queryString);
        // prints message after book is deleted.
        print("<message>".$_POST['books']." was deleted from the inventory</message><br>");
        
          
      }    
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           Change Price                                    |
  //|                                                                           |
  //-----------------------------------------------------------------------------
  // if one of the two change price buttons are clicked...
  else if(isset($_POST['changePrice']))
  {   // stores string containg the button value
      $processString = $_POST['changePrice'];
      // if it equals "Change Book Price"
      if($processString == "Change Book Price")
      {     // output header
           echo("<h2> Change Price</h2>");
           //creates query string that selects all book titles from the table
          $queryString = "SELECT title FROM books";
           // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
          $result = QueryDatabase($queryString);
          // gets the number of rows in the associative array
          $rows = $result->num_rows;
          // creates a from to handle processing
          ?> <form action="inventory_bwills1514.php" method="post" >
              <!-- prompt that tells the user what to enter and creates a select input -->
              Select the book that you want to change the price of <select name ="books" ><?php
        // loop that loads the select list with book titles
        for ($j = 0 ; $j < $rows ; ++$j)
        { // seek to record j and...
            $result->data_seek($j);
            // store record in assosiative array
            $row = $result->fetch_array(MYSQLI_ASSOC);
            // output of fields into table using assosiation
            print('<option value = '."'".$row['title']."'>".$row['title']."</option>");
            
        }
        ?></select> 
              <!-- form prompt for the user to enter the new price -->
              <br>New Price  <input type ='text' name ='price' size = '4'>
           <!-- button that when clicked processes the new price -->
          <input type="submit" id ="submit" name="changePrice" value="enter" > <br> <?php
      }
      else 
      {
       // variables that store the valuse that the user enters on the form...
       $title= $_POST['books'];
       $price = $_POST['price'];
      // query string using variables from user entry to update the price of the book
       //by the selected title
      $queryString  = "UPDATE books SET price = ".$price. "WHERE title =  ". "'".$title."'";
      // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
      $result = QueryDatabase($queryString);
      // outputs message when the price has been changed
      print("<br><message>The price of the book has been changed to $".$_POST['price']."</message><br>");
      }    
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           Add a Book                                      |
  //|                                                                           |
  //-----------------------------------------------------------------------------
  // if the submit button on the add book form is clicked...
  else if(isset($_POST['submit']))
  { //  variables to hold user entered fields 
      $ISBN = $_POST['isbn'];
      $title = $_POST['bookTitle'];
      $author_firstName =$_POST['firstName'];
      $author_lastName=$_POST['lastName'];
      $genre =$_POST['genres'];
      $publisher =$_POST['publisher'];
      $yearPublished =$_POST['copyrightYear'];
      $price =$_POST['price'];
      //error variable is assigned after the data is validated..if no error variable is false...
      $error = ValidateAddData($ISBN,$title,$author_firstName,$author_lastName,$genre,
              $publisher,$yearPublished,$price);
      // if there is no error
      if($error == false)
      {     // the new book is added into the table with the Insert into sql statement
            $queryString  = "INSERT INTO books(ISBN,title, author_firstName,". 
              "author_lastName, genre, publisher, yearPublished, price)
            VALUES($ISBN,'$title','$author_firstName','$author_lastName','$genre',"
              . "'$publisher',$yearPublished,$price)";
       // the query result array is returned using the QueryDatabase function which
      // accepts the query string as a paramater
            QueryDatabase($queryString);
            // header output
            echo("<h2> Book Successfully Added to Inventory</h2>");
            // the book data is output using the output book data function as a confirmation
            // to the user that the book was entered.
            OutputBookData($ISBN,$title,$author_firstName,$author_lastName,$genre,
              $publisher,$yearPublished,$price);
      }
      else // if there is an error...
      {     // the form is re-output
          include_once 'lab4_bwills1514.php';
          // with an error message containing which field was entered wrong
          echo("<br><br><error>Please enter a valid ". $error."</error>");
      }
      
  }
  // if the clear button is clicked..
  else if(isset($_POST['clear']))
  { // a new instance of the add book form is output to the user
     include_once"lab4_bwills1514.php";
  }
  //-----------------------------------------------------------------------------
  //|                                                                           |
  //|                           Functions                                       |
  //|                                                                           |
  //-----------------------------------------------------------------------------
  
  // fucntion that accepts a SQL query string and returns the associative array
  //with the result
  function QueryDatabase($queryString)
  {
    require_once 'login.php'; //includes file containg database information
    // database mysqli object that uses the hostname, directory, password and 
    //database name from the login.php file
    $conn = new mysqli($hn, $un, $pw, $db);
      // if there is an error with the db connection...
    if ($conn->connect_error) 
    {
        // kills script
         die($conn->connect_error);
    }
    // saves assosiative array that is received from the connection object to variable
    $result = $conn->query($queryString);
    // if there is a query error (no result)
    if (!$result) 
    { // kills script
      die($conn->error);
    }
    // connection is closed
    $conn->close();  
    // result is returned.
     return $result;
  }
    

// fucnction that displays the associative array resulting from a query  
function DisplayResult($result)
{
    // gets the number of rows from the query object...
    $rows = $result->num_rows;
    //html table settings
    echo("<table width = '100%'border = '1'>");
    // outputs table header with appropriate titles
    echo("<tr><th>ISBN</th><th>Author First Name</th><th>Author Last Name</th><th>Title</th>");
    echo("<th>Genre</th><th>Publisher</th><th>Year Publsihed</th><th>Price</th></tr>");
    // for number of records in database  table -1 (start at 0)..
     for ($j = 0 ; $j < $rows ; ++$j)
     { // seek to record j and...
        $result->data_seek($j);
        // store record in assosiative array
        $row = $result->fetch_array(MYSQLI_ASSOC);
        // output of fields into table using assosiation
        echo ("<td>". $row['ISBN']. "</td>");
        echo ("<td>" . $row['author_firstName']. "</td>");
        echo ("<td>".$row['author_lastName']. "</td>");
        echo ("<td>".$row['title']. "</td>");
        echo ("<td>".$row['genre']. "</td>");
        echo ("<td>". $row['publisher']. "</td>");
        echo ("<td>". $row['yearPublished']. "</td>");
        echo ("<td>". $row['price']. "</td></tr>");
    
     }
     // close table
      echo ("</table>");
}
// function that uses nested if statements and REGEX to validate data input from
//the add book form receives fields as parameters and returns an error variable
//with a boolean false if there is no error or a field name for an error message
// if there is an error
function ValidateAddData($ISBN,$title,$author_firstName,$author_lastName,$genre,
              $publisher,$yearPublished,$price)
{   // tests user entered ISBN with the reg ex. if match ...
    if(preg_match('/^[0-9]{13}$/', $ISBN) == 1)
    {// tests user entered title with the reg ex. if match ...
        if(preg_match('/^[A-Za-z0-9 ]{1,40}$/', $title) == 1)
        {// tests user entered first name with the reg ex. if match ...
            if(preg_match('/^[A-Za-z0-9]{1,40}$/', $author_firstName) == 1)
            {// tests user entered last name with the reg ex. if match ...
                if(preg_match('/^[A-Za-z0-9]{1,40}$/', $author_lastName) == 1)
                {// tests user entered publisher with the reg ex. if match ...
                    if(preg_match('/^[A-Za-z0-9 ]{1,40}$/', $publisher) == 1)
                    {// tests user entered year  with the reg ex. if match ...
                        if(preg_match('/^[0-9]{4}$/', $yearPublished) == 1)
                        {// tests user entered price with the reg ex. if match ...
                            if(preg_match('/^\d{1,3}\.\d{2}$/', $price) == 1)
                            {// if control reaches this point all data is valid false is returned
                                $error = false;
                            }
                            else 
                            {// price does not match reg ex. string is returned for output
                                $error = "price"; 
                            }
                        }
                        else 
                        {// year published does not match reg ex. string is returned for output
                            $error = "year published"; 
                        }
                    }
                    else 
                    {// Publisher does not match reg ex. string is returned for output
                        $error = "publisher"; 
                    }
                }
                else 
                {// Last Name does not match reg ex. string is returned for output
                    $error = "author last name"; 
                }
            }
            else 
            {// First Name does not match reg ex. string is returned for output
                $error = "author first name"; 
            }
        }
        else 
        {// Title does not match reg ex. string is returned for output
           $error = "title"; 
        }
    }
    else
    {// ISBN does not match reg ex. string is returned for output
        $error = "ISBN";
    }
    return $error;
}
// function that receives the fields from one record as parameters and outputs the
// book in an HTML table.
function OutputBookData($ISBN,$title,$author_firstName,$author_lastName,$genre,
              $publisher,$yearPublished,$price)
{
    echo("<table width = '100%'border = '1'>");
    echo("<tr><td>ISBN13:</td><td>".$ISBN."</td></tr>");
    echo("<tr><td>Book Title:</td><td>".$title."</td></tr>");
    echo("<tr><td>Author's First Name:</td><td>".$author_firstName."</td></tr>");
    echo("<tr><td>Author's Last Name:</td><td>".$author_lastName."</td></tr>");
    echo("<tr><td>Genre:</td><td>".$genre."</td></tr>");
    echo("<tr><td>Publisher:</td><td>".$publisher."</td></tr>");
    echo("<tr><td>Year Published:</td><td>".$yearPublished."</td></tr>");
    echo("<tr><td>Price:</td><td>".$price."</td></tr></table>");
   
}

// includes for navigation and footer file
include_once "inc_navigation_bwills1514.php";
include_once "inc_footer.php";
    
?>
            </body>
</html>
