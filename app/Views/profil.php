<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Comptabile" content="IE-edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <title>Profil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body{
            background: linear-gradient(to right,#F6E9B2,#F7F6BB);
            overflow:hidden;
            box-sizing:border-box;
        }
        .logo {
            height: 30px; 
            width: auto; 
        }

        .home-link {
            color: orange; 
            font-size: 1.5rem; 
            padding: 0 1px; 
            text-decoration: none; 
            display: inline-block;
            margin-right: 5px; 
        }
        .home-link i {
            font-size: 1.5rem; 
        }

        .home-link:hover {
            color: orangered; 
        }

        .icon-link {
            display: inline-block;
            margin-right: 5x; 
            color: #333; 
            text-decoration: none; 
        }

        .icon-link:hover::after {
            content: attr(title); 
            position: absolute;
            background: #000;
            color: #fff;
            padding: 5px 10px;
            white-space: nowrap;
            z-index: 10;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 4px;
            font-size: 0.75em;
        }

        .icon-link:hover::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: black transparent transparent transparent;
        }

        .comment-form, .comments-container {
            margin-top: 10px;
        }

        .hidden {
            display: none;
        }

        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            color: #333;
            font-size: 18px;
            padding: 5px;
        }

        .icon-button:hover {
            color: #007bff;
        }
        .actions button {
            border: none;
            background: none;
            cursor: pointer;
        }
        .container{
            background:#fff;
            width:540px;
            height:420px;
            margin: 0 auto;
            position:relative;
            margin-top:10%;
            box-shadow:2px 5px 20px rgba(166, 27, 13,0.5);
        }
        .logo{
            float:right;
            margin-right:12px;
            margin-top:12px;
            font-family:'Poppins';
            color:#FF9800;
            font-weight:900;
            font-size:1.5rem;
            letter-spacing:1px;
        }
        .leftbox{
            float:left;
            top:18%;
            left:30%;
            position:absolute;
            width:5%;
            height:70%;
            background: #EAD98A;
            box-shadow:3px 3px 10px rgba(166, 27, 13,0.5);
   
        }
        .leftbox i {
            position: absolute; /* Pour positionner l'icône de manière absolue */
            font-size: 2rem; /* ou toute autre taille de police souhaitée */
            left: 25%; /* Pour placer l'icône à 50% de la largeur de la leftbox */
        
            top: 30%; /
            
        }
        nav a{
            list-style:none;
            padding:35px;
            color:#fff;
            font-size:1.1em;
            display:block;
            transition: all 0.3 ease-in-out;
        }
        nav a:hover{
            color:#FF9800;
            transform:scale(1.2);
            cursor:pointer;
        }
        nav a:first-child{
            margin-top:110px;
            right: 25px; 
        }
        .active{
            color:#FF9800;
        }
        .rightbox{
            float:right;
            width:60%;
            height:100%;
            position: absolute;
            top: 50%;
            left: 60%;
            transform: translate(-50%, -50%);
        }
        .profile{
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width:70%;
        }
        h1{
            font-family:"Poppins";
            color:#777;
            font-size:17px;
            margin-top:40px;
            margin-bottom:35px;
        }
        h2{
            color:#FF9800;
            font-family:"Poppins";
            width:80%;
            text-transform:uppercase;
            font-size:13px;
            letter-spacing:1px;
            margin-left:2px;
        }
        p{
            border-width:1px;
            border-style:solid;
            border-image:linear-gradient(to right, #FF9800,rgba(197, 22, 5,0.5)) 1
            0%;
            border-top:0;
            width:60%;
            font-family:"Poppins";
            font-size:15px;
            padding:7px 0;
            color: #070707;
        }
        .header-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 1000; 
            display: flex;
            justify-content: space-between;
            padding: 10px 20px; 
            align-items: center;
        }

    </style>
    </head>
    <body>
    <header class="header-bar">
        <a href=<?=site_url('/homepage')  ?> class="home-link" class="icon-link home-link" title="Home">
            <img src=<?=base_url('/image/logo2.png')?> alt="Logo" class="logo">
        </a>
        <a href=<?=site_url('/profil')  ?> class="home-link" class="icon-link home-link" title="Profil">
            <i class="fas fa-user"></i>
        </a>
        <a href=<?=site_url('/groupe')  ?> class="home-link" class="icon-link home-link" title="Créer un groupe">
            <i class="fas fa-user-plus"></i>
        </a>
        <a href=<?=site_url('/logout')  ?> class="home-link" class="icon-link home-link" title="Déconnexion">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </header>
       <div class="container">
        <div id="'logo">
            <h1 class="logo">My Little Club.</h1>
        </div>
       </div>
       <div class="leftbox">
        <nav>
            <a href="#" class="active">
                <i class="fa fa-user"></i>
            </a>
        </nav>
       </div>
       <div class="rightbox">
        <div class="profile">
            <h1>Informations personnelles</h1>
            <?php if(isset($nom_user)&&(isset($email_user))):?>
                <h2>Nom utilisateur</h2>
                <p><?=$nom_user?></p>
                <h2>Adresse mail</h2>
                <p><?=$email_user?></p>
            <?php else:?>
                <p>Vous n'avez pas encore connecté.</p>
            <?php endif;?>
        </div>
       </div>
    </body>
</html>