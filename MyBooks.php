<?php
     require_once ("Includes/simplecms-config.php"); 
     require_once  ("Includes/connectDB.php");
     include("Includes/header.php");
     $_SESSION['url'] = "MyBooks";

    if (isset($_POST['SubmitBook']))
    {

        $_SESSION['idBook'] = $_POST["SubmitBook"];
        $IdBook = $_SESSION['idBook'];
        
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connection to DB');


        $query = "SELECT * FROM books WHERE idBook = '$IdBook'";
        $result = mysqli_query($dbc,$query);
        if ($result && mysqli_num_rows($result) > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $_SESSION['bookCode'] = $row["bookCode"];
                $_SESSION['bookTitle'] = $row["bookTitle"];
                $_SESSION['bookWriter'] = $row["bookWriter"];
                $_SESSION['bookLanguage'] = $row["bookLanguage"];
                $_SESSION['bookPublicationDate'] = $row["bookPublicationDate"];
                $_SESSION['bookNbPage'] = $row["bookNbPage"];
                $_SESSION['bookState'] = $row["state"];
                $_SESSION['bookPrice'] = $row["bookPrice"];
            }   
        } 

        header ('Location: MyBookToValidate.php');
    }

?>

<h2>My Books</h2>
<form action="MyBooks.php" method="post">

<?php
    printBookTable($_SESSION['username']);
?>

  

</div> <!-- End of outer-wrapper which opens in header.php -->
<?php 
    include ("Includes/footer.php");
 ?>