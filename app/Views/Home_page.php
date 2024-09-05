<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <script src="https://kit.fontawesome.com/ba57058827.js" crossorigin="anonymous"></script>
    <style>
        body{
            margin:0 ;
            padding: 0;
            min-height: 100vh;
            background-image: linear-gradient(80deg,rgb(5,124,172),rgb(199, 101, 10));
            overflow:hidden;
            font-family: 'poppins';
        }
        .center-text {
            text-align: center;
        }
        #up{
            position: absolute;
            height: 800px;
            width: 800px;
            border-radius: 50%;
            background-image: linear-gradient(80deg,rgb(5,124,172),rgb(43,247,202,0.5));
            filter:blur(80px);
            animation: down 40s infinite;
        }
        #down{
            position: absolute;
            right: 0;
            height: 500px;
            width: 500px;
            border-radius:50%; 
            background-image:linear-gradient( 80deg,rgba(245,207,82,0.8),rgb(225, 61, 11));
            filter: blur(80px);
            animation: up 30s infinite;
        }
        #left{
            position: absolute;
            height: 500px;
            width: 500px;
            border-radius:50%; 
            background-image: linear-gradient( 80deg,rgb(5,124,172),rgba(52, 253, 96, 0.8));
            filter: blur(80px);
            animation: left 30s 1s infinite;
        }
        #right{
            position: absolute;
            height: 500px;
            width: 500px;
            border-radius:50%;
            background-image: linear-gradient( 80deg,rgb(26,248,18,0.6),rgba(227, 58, 11, 0.8));
            filter: blur(80px);
            animation: left 40s .5s infinite;
        }
        nav{
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
            backdrop-filter: blur(5px);
            padding: 20px 30px;
            color:#fff;
        }
        .nav-list{
            display: flex; 
            align-items: center;
            justify-content: space-evenly;
            list-style-type:none;
        }
        .nav-list li{
            margin:20px;
            font-size:15px;
            cursor: pointer;
        }
        .nav-list button{
            padding:10px 20px;
            margin: 0 20px;
            border: 1px solid #fff;
            background-color: transparent;
            color: #fff;
            font-family: inherit;
            transition: all ease-in .4s;
            cursor:pointer;
        }
        .nav-list button:hover{
            background-color: #fff;
            color: #000;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo h1 {
            margin-left: 10px; 
        }
        .search-container{
            margin: 10px;
        }
        .search-container input{
            width:200px;
            font-size:15px;
            padding:5px 20px;
            border-radius:20px;
            border:none;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
            transition:0.4s ease-in-out;
        }
        .search-container input:focus{
            width:450px;
        }
        .search-container i{
            position: relative;
            top:70%;
            right:30px;
            transform: translateY(-40%);
            color:#555;
            cursor:pointer;
        }
        
        #details{
            position: relative;
            display:flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            z-index: 999;
            text-align: center;
            color: #ebe7e7;
        }
        #details h1{
            font-size: 70px;
            text-align: center;
            line-height: 0px;
            }
        #details span{
            background-color: transparent;
            text-decoration: underline;
            font-size: 30px;
            font-weight: 600;
            padding: 0 20px;
        }
        #details p{
            width: 100%;
        }
        #details ul{
            width: 50%;
        }
        .list-group-item{
            background-color: rgba(255,255,255,0.1);
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 20px;
            cursor: pointer;
            transition: all ease-in .4s;
            list-style: none;
        }
        .list-group{
            position: relative;
            list-style: none;
            text-align:center;
        }
        a:link {
            color: white;
            background-color: transparent;
            text-decoration: none;
            }
        .btn-white {
            background-color: white;
            color: black;

            }
        .list-container {
            margin: 0 30px; 
            }
        @keyframes down{
            0%, 100%{
                top: -100px;
            }
            70%{
                top:700px;
            }
        }
        @keyframes up{
            0%, 100%{
                bottom: -100px;
            }
            70%{
                bottom:700px;
            }
        }
        @keyframes left{
            0%, 100%{
                left: -100px;
            }
            70%{
                left:1300px;
            }
        }
        @keyframes right{
            0%, 100%{
                right: -100px;
            }
            70%{
                right:1300px;
            }
        }
        .center-text {
            text-align: center;
        }
    </style>

</head>
<body>
    <div id="up"></div>
    <div id="down"></div>
    <div id="left"></div>
    <div id="right"></div>
    
    <nav>
    
        <div class="logo">
            <img src=<?=base_url('/image/logo.jpg')?> alt="logo" height="50">
            <h1>My Little Club.</h1></div>
        <ul class="nav-list">
            <li>
                <form method="post" id="recherche" action="<?= site_url('/homepage/recherche') ?>">
                    <div class="search-container">
                    <input type="text" name="searchTerm" placeholder="Rechercher un groupe...">
                    <button type="submit" style=" border:none; color: transparent; background-color: transparent;"><i class="fa fa-search" style="color:white;"></i></button>
                    </div>
                </form>
                
            <li><a href=<?=site_url('/profil')  ?> class="btn btn-info mr-2"> Profil</a></li>
            <li><a href=<?=site_url('/groupe')  ?> style="color: white; background-color: transparent; ">Créer un Groupe</a></li>
            <li>
                <form method="post" action="<?= site_url('logout') ?>">
                    <button type="submit" class="btn btn-warning" style=" border:none; border-radius: 20px;"><i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            </li>
        </ul>
        
    </form>
    </nav>
    
    
    <section id="details">
    <div class="container" style="display: flex; justify-content: space-between;">
        <div class="suggestion list-container">
        <span class="center-text">Suggestions de groupes</span>
            <p class="center-text">Ces groupes peuvent vous intéresser</p>
            <ul class="list-group">
            <?php foreach ($liste_suggest as $item) { ?>
                <li class="list-group-item"><a href="groupepage/<?= $item['id_groupe'] ?>"><?= $item['nom_gr'] ?></a></li>
            <?php } ?>
            </ul>
        </div>
        <div class="mes-groupes list-container">
        <span class="center-text">Vos groupes</span>
        <p class="center-text">Restez à jour avec vos groupes préférés</p>
            <ul class="list-group">
            <?php foreach ($liste_rejoint as $row) { ?>
                <li class="list-group-item"><a href="groupepage/<?= $row['id_groupe'] ?>"><?= $row['nom_gr'] ?></a></li>
            </ul>
            <?php } ?>
        </div>
    </div>    
    </section>
</body>
</html>