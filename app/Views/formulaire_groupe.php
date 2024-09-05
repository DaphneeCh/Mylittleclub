<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un nouveau groupe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>   
        .container {
            max-width: 600px; 
            margin: 5rem auto;
            padding: 2rem;
            background-color: #FFF3E0; 
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 165, 0, 0.1); 
        }

        h1.text-center {
            color: #E65100; 
            margin-bottom: 1.5rem;
            text-align: center;
        }
        hr {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(255, 165, 0, 0.5);
            }
  
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        
        .formulaire_gr {
            margin-bottom: 1rem;
            width: 100%;
        }

        .formulaire_gr label {
            display: block;
            margin-bottom: .5rem;
            color: #FF9800; 
            font-weight: bold;
        }

        
        input[type="text"],
        select {
            width: calc(100% - 2rem);
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #FF6D00; 
            outline: none;
            box-shadow: 0 0 0 2px #FFE0B2; 
        }

        
        button {
            cursor: pointer;
            background-color: #FF9800; 
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #E65100; 
        }

       
        .text-danger {
            color: #FF7043;
            margin-top: 0.5rem;
            text-align: center;
        }
        .header-bar {
            background-color: whitesmoke; 
            padding: 10px 10px; 
            display: flex;
            align-items:center;
            justify-content: space-between;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .logo {
            height: 30px; 
            width: auto; 
        }

        .home-link {
            color: orange; 
            font-size: 1.5rem; 
            padding: 0 5px; 
            text-decoration: none; 
        }

        .home-link:hover {
            color: orangered; 
        }

        .icon-link {
            display: inline-block;
            margin-right: 10px; 
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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Créer un nouveau groupe</h1>
    <hr>
    <?php if(isset($validation)) : ?>
        <div class="text-danger">
            <?=  $validation->listErrors()?>
        </div>
    <?php endif;?>
    <form align="center" method="post">
            <div class="formulaire_gr">
                <label for ="">Nom du groupe:</label>
                <input type="text" id="ngroupe " name="Nom_du_groupe" placeholder="Conseils de voyage">
            </div>
            <div class="formulaire_gr">
                <label for ="">Statut du groupe:</label>
                <select name="Statut_du_groupe">
                    <option value=""></option>
                    <?php foreach($Statut as $stat):?>
                        <option value="<?=$stat?>"><?=$stat?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="formulaire_gr">
                <label for ="">Nombre de membre du groupe:</label>
                <select name="Nombre_de_membre">
                    <option value=""></option>
                    <?php foreach($Nb_groupe as $nb):?>
                        <option value="<?=$nb?>"><?=$nb?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="formulaire_gr">
                <label for="">Description du groupe:</label>
                <input type="text" id="descrip" name="Description"placeholder="Bienvenue dans notre groupe ...">
            </div>
            <div class="formulaire_gr">
                <label for="">Centres d'intérêt:</label>
                <select name="Centres_intérêt">
                    <option value=""></option>
                    <?php foreach($Interet as $interet):?>
                        <option value="<?=$interet?>"><?=$interet?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="formulaire_gr">
                <button type="submit">Créer</button>
            </div>    
    </form>
    </body>
</html>