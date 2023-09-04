<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="pizza.css">
    <title>Document</title>
    
</head>
<body>

  
<nav id="adminNav" class="navbar navbar-expand-lg navbar-light bg-light" style="display:none">
<div class="container-fluid">
    <a class="navbar-brand" href="#">AdminNavbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Pizzák</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Futárok</a>
        </li>
        <li class="nav-item">
              <button class="nav-link" aria-current="page" id="logoutAdmin" >Kijelentkezés</button>
        </li>
      </ul>
    
    </div>
  </div>
</nav>

<nav id="user" class="navbar navbar-expand-lg navbar-light bg-light" style="display:none"> 
<div class="container-fluid">
    <a class="navbar-brand" href="#">UserNavbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="?page=pizza">Pizzák</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Futárok</a>
        </li>
        <li class="nav-item">
              <button class="nav-link" aria-current="page" id="logoutUser" >Kijelentkezés</button>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto" >
          <li class="nav-item">
              <button class="nav-link" aria-current="page" href="?page=order" id="order" >Rendelés
              <span class="top-1 start-100 translate-middle badge rounded-pill bg-danger id=counting"></span>
              </button>
          </li>
      </ul>
    
    </div>
  </div>
</nav>

<div class ="container-fluid">
  <div class="row">
    <?php
       if(isset($_GET["page"])){
            switch($_GET["page"]){
              case "register":
                include "register.php";
                break;
              case "pizza":
                include "pizza.php";
                break;
              case "order": 
                include "order.php";
                break;


             default;
            }
        }else{
            include "login.php";
        }


    ?>
  </div>
</div>
</body>
<script src="session.js"></script>

</html>