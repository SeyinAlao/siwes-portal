<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sidebar</title>
    <link rel="stylesheet" href="style.css">
   <!--Boxicon Link--> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <i class='bx bxl-squarespace'></i>
            <div class="logo_name">SiwesPortal</div>
        </div>
        <i class='bx bx-menu' id="btm" ></i>
    </div>
    <ul class="nav_list">
        <li>
                <i class='bx bx-search'></i>
               <input type="text" placeholder="search..">
            <span class="tooltip">search</span>
        </li>
        <li>
            <a href="home.php">
                <i class='bx bx-home-smile'></i>
            <span class="link_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
        </li>
        <li>
            <a href="profile.php">
                <i class='bx bx-user'></i>
                <span class="link_name">Profile</span>
            </a>
            <span class="tooltip">Profile</span> 
        </li>   
         <li>
            <a href="contact.php">
                <i class='bx bx-chat'></i>
                <span class="link_name">Contact</span>
            </a>
           <span class="tooltip">Contact</span>
        </li>
        <li>
          <div class="icon-links">
            <a href="log.php">
                <i class='bx bx-book-content'></i>
                <span class="link_name">Logbook</span>
            </a>
            <span class="tooltip">Logbook</span>
        </div>
        </li>
       
    </ul>

    <div class="profile_content">
        <div class="profile">
           <div class="profile_details">
             <img src="download.jpg" alt="picture">
             <div class="name_title">
                <div class="name">Rod wave</div>
                <div class="title">Front-end Developer</div>
             </div>
           </div>
           <a href="logout.php">
           <i class='bx bx-log-out'id="log_out"></i>
           </a>
        </div>
    </div>
</div>
<div class="Home-content">
    <div class="Text"></div>
</div>
<script>
  let btm = document.querySelector("#btm");
  let sidebar = document.querySelector(".sidebar");
  let searchBtm = document.querySelector(".bx-search");

  btm.onclick =function(){
    sidebar.classList.toggle("active");
  }
  searchBtm.onclick =function(){
    sidebar.classList.toggle("active");
  }
 
</script>
</body>
</html>