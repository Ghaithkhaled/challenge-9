<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include the database configuration file
include('config.php');

// Retrieve the current user ID
$user_id = $_SESSION["id"];

// Prepare the SQL query with a WHERE clause to filter by user ID
$sql = "SELECT * FROM Dashboard WHERE user_id = $user_id";
$result = $conn->query($sql);

// Fetch the row for the current user
$row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <header>
        <img src="./imgs/MicrosoftTeams-image.png" alt="" id="foto">
        <h1  id="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welkom op uw site.</h1>
    </header>



    <div id="Sign-Out"> 
    <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out </a>  
    </div>

    <div id="buttons">
        <a href="" class="btn btn-warning">Dashboard</a>
        <a href="transacties.php" class="btn btn-warning">Transacties</a>
    </div>

    <table>
      <tr>
       <th>Totaal op de rekenung</th>
       <th>Uitgegeven deze maand</th>
       <th> <a href="Edit.php">Edit</a></th>
      </tr>

      <tr>
       <td><?php echo $row['Totaal op de rekening']?></td>
       <td><?php echo $row['Uitgegeven deze maand']?></td>
      </tr>
     </table>
  <style>
  body{ font: 16px sans-serif;  
    background: #dddddd70;
}



header{
    width: 100%;
    height: 150px;
    background-color: blue;
}

#Sign-Out {
text-align: right;
margin-top: -120px;
}

#buttons{
    text-align: right;
    margin-top: 10px;
}
#foto{
    margin-top: 25px;
}

#my-5{
    /* margin-top: -5px; */
    text-align: center;
    margin-top: -20px;
}


table{
    margin-top: 350px;
   margin-left: 35%;
}



 td, th {

     border: 2px solid #dddd;

     text-align: left;

     padding:50px;
}
</style>
</body>
</html>