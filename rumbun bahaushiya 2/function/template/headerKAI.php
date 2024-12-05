<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/styles.css" rel="stylesheet">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="./bootstrap/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.bundle.min.js"></script>


<!--  brower icons code --->

  <link rel="apple-touch-icon" sizes="180x180" href="./bootstrap/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./bootstrap/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="./bootstrap/img/favicon-16x16.png">
<link rel="manifest" href="./bootstrap/img/site.webmanifest">
  </head>

  <body>
    <div class="clear-fix pt-5 pb-3"></div>
    <nav class="navbar navbar-expand-lg  navbar-expand-md navbar-light bg-warning bg-gradient fixed-top">
      <div class="container">
        <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
          <a class="navbar-brand" href="index.php"><img src="./bootstrap/img/icon.png" style=" max-width:25%;height: auto; object-fit: scale-down;"></a>
        </div>

        <!--/.navbar-collapse -->
        <div class="collapse navbar-collapse" id="topNav">
          <ul class="nav navbar-nav">
            <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == true): ?>
                <li class="nav-item"><a class="nav-link" href="admin_book.php"><span class="fa fa-th-list"></span> Book List</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_add.php"><span class="far fa-plus-square"></span> Add New Book</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_signout.php"><span class="fa fa-sign-out-alt"></span> Logout</a></li>
            <?php else: ?>

              <!-- Books Section-->
           
                  <div class="nav-item"  class="nav-link"class="w3-dropdown-click">
      <i class="fas fa-book-open"></i>
        <button class="w3-button " onclick="myFunction()">
       Books <i class="fa fa-caret-down"></i>
      </button>
      <div id="demo" class="w3-dropdown-content w3-bar-block w3-card">

        <a href="books.php" class="w3-bar-item w3-button">Books List</a>
        <a href="publisher_list.php" class="w3-bar-item w3-button">Authors</a>
        <a href="#" class="w3-bar-item w3-button">Folk-Tales</a>
        <a href="#" class="w3-bar-item w3-button">Genes</a>
        <a href="#" class="w3-bar-item w3-button">Others</a>
      </div>
    </div>

 <!-- Audio Section-->
           
                  <div class="nav-item"  class="nav-link"class="w3-dropdown-click">
      <i class="fas fa-music"></i><button class="w3-button" onclick="myFunct()">
       Songs <i class="fa fa-caret-down"></i>
      </button>
      <div id="demos" class="w3-dropdown-content w3-bar-block w3-card">

        <a href="books.php" class="w3-bar-item w3-button">Artists</a>
        <a href="publisher_list.php" class="w3-bar-item w3-button">Peoms</a>
        <a href="#" class="w3-bar-item w3-button">Lyrics</a>
        <a href="#" class="w3-bar-item w3-button">Albums</a>
        <a href="#" class="w3-bar-item w3-button">Others</a>
      </div>
    </div>


              <!-- link to Gallery -->
              <div class="nav-item"><a class="nav-link" href="cart.php"><span class="fa fa-image"></span> Gallery</a></div>
                   <!-- link to Sign In -->
                <div class="nav-item"><a class="nav-link" href="admin_signout.php"><span class="fa fa-sign-in"></span> SIgn In</a></div>

                <div class="nav-item"><a class="nav-link" href="admin_signout.php"><span class="far fa-address-book"></span> About Us</a></div>

                <div class="nav-item"><a class="nav-link" href="admin_signout.php"><span class="fas fa-assistive-listening-systems"></span> Contact Us</a></div>
  
        

              <!-- link to search -->
        <!--<form method="GET" action="search_result.php">
          <fieldset>
          <input type="text" id="s" name="s" value="" />
          <input type="submit" id="x" value="Search" />
          </fieldset>
        </form>-->
        <div class="parent">
  
<input class="input" type="type" name="" placeholder="Search..." />

<button class="btn"  

onclick="
let input  = document.querySelector( 'input');
let btn    = document.querySelector('.btn');
let parent = document.querySelector('.parent');


btn.addEventListener('click', () => {
  parent.classList.toggle('active');
  input.focus();

});
"
>
  
  <i  class="fa-solid fa fa-search w3-xlarge"></i>

</button>

         </div>

<style type="text/css">
  .parent{

    position: relative;
  }

  .input{

    outline: none;
    border: none;
    border-radius: 100px;
    padding: 5px 10px;
    width: 40px;
    transition: width 0.3s ease;

  }

  .input : : placeholder{


    color: none;
  }

  .parent.active .input{


    width: 180px;
  }

  .btn{

    width: 40px;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 100px;
    border: none;
    display: inline;
    position: absolute;
    top: 0;
    left: 0;
    transition: transform 0.3s ease;


  }

  .parent.active .btn{

    transform: translateX(210px);
  }

  .fa-solid{

          color: #ffffff;

  }

</style>
     
              
            <?php endif; ?>
            </ul>
        </div>
      </div>
      
    </nav>
    <?php
      if(isset($title) && $title == "Home") {
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="container">
        <h1>Welcome to Rumbun Bahaushiya Online Book Store</h1>
        <hr>
      </div>
    <?php } ?>

    <div class="container" id="main">


  <script>
function myFunction() {
  var x = document.getElementById("demo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

function myFunct() {
  var x = document.getElementById("demos");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>
        