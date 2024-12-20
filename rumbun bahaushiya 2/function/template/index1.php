<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Drop Down Navigation Menu | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="#"><img src="logo.png" style=" max-width:180px;width: 300px;"></a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name"><img src="logo.png" style=" max-width:400px;width: 100px;"></span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <li><a href="#">HOME</a></li>
          <li>
            <a href="#">Books</a>
           

            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="#">Authors</a></li>
              <li><a href="#">Folk-Tales</a></li>
              <li><a href="#">Epic-Story</a></li>
              <li class="more">
                <span><a href="#">More</a>
                <i class='bx bxs-chevron-right arrow more-arrow'></i>
              </span>
                <ul class="more-sub-menu sub-menu">
                  <li><a href="#">Gallery</a></li>
                  <li><a href="#">Bio</a></li>
                  <li><a href="#">KIngdoms</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Songs</a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Artists</a></li>
              <li><a href="#">Peoms</a></li>
              <li><a href="#">Lyrics</a></li>
              <li><a href="#">Albums</a></li>
            </ul>
          </li>
          <li><a href="#">SIGN IN</a></li>
          <li><a href="#">ABOUT US</a></li>
          <li><a href="#">CONTACT US</a></li>
        </ul>
      </div>
      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <input type="text" placeholder="Search...">
          <button> Search</button>
        </div>

          <button type="submit" id="x" value="Search" />
      </div>
    </div>
  </nav>
  <script src="script.js"></script>

