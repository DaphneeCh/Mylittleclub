<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion du groupe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin-top: 20px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
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
        .show {
            display: block;
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px; 
            height: 40px; 
            border-radius: 20px; 
            background-color: #f60; 
            color: white; 
            text-decoration: none;
            margin: 5px;
        }

        .icon-link:hover {
            background-color: #e55a00; 
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
        .list-item {
            background-color: #fff;
            border: 1px solid #ddd; 
            padding: 10px 15px; 
            margin-bottom: 10px; 
            border-radius: 5px; 
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: box-shadow 0.3s ease-in-out, transform 0.2s ease; 
        }

        .list-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15); 
            transform: translateY(-2px); 
        }

        
        .list-item .btn-supprimer {
            background-color: #f44336; 
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .list-item .btn-supprimer:hover {
            background-color: #d32f2f; 
        }
        .list-item .btn-accepter {
            background-color: #4CAF50; 
            color: white; 
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background-color 0.3s; 
            text-decoration: none; 
            display: inline-block; 
        }

        .list-item .btn-accepter:hover {
            background-color: #45a049; 
        }


        .actions button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #0056b3;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            margin: 0; 
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%; 
            max-width: 800px; 
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px; 
        }
        h2 {
            font-size: 24px; 
            font-weight: bold; 
            color: #f60;
            margin-top: 20px; 
            margin-bottom: 10px; 
            text-align: center; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); 
        }
        @media (max-width: 768px) {
            h2 {
                font-size: 20px; 
            }
}

        a {
            color: #f60; 
            text-decoration: none;
        }

        a:hover {
            color: #e55a00;
        }


        .btn-custom, .btn-primary {
            background-color: #f60; 
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover, .btn-primary:hover {
            background-color: #e55a00; 
        }

        .actions button {
            background-color: #f60;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .actions button:hover {
            background-color: #e55a00;
        }
        html, body {
            height: 100%;
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
        <a href=<?=site_url('/admin')  ?> class="home-link" class="icon-link home-link" title="Gestion du groupe">
            <i class="fas fa-users-cog"></i>
        </a>
        <a href=<?=site_url('/logout')  ?> class="home-link" class="icon-link home-link" title="Déconnexion">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </header>
    <div class="container">
    <a href="<?=site_url('groupepage/'.$group_id )?>" class="icon-link" title="Voir le groupe">
        <i class="fas fa-eye"></i>
    </a>
        <h2>Membre du groupe <?= $group_name ?></h2>
        <div id="listeMembre" class="list">
        <?php foreach ($liste_membre as $row) { ?>
                <div class="list-item">
                    <?= $row['nom_user'] ?>
                    <form method="post" id="post_refuse">
                        <input hidden type="text" name="decision" value="refuse">
                        <input hidden type="text" name="id_user" value=<?=$row['id']?>>
                    </form>
                    <?php if($id_admin != $row['id']){ ?>
                         <button type="submit" form="post_refuse" value="Submit" class="btn-supprimer">Supprimer</button>
                    <?php } ?>
                </div>    
            <?php } ?>
        </div>
        
        <h2>Liste d'attente</h2>
        <div id="liste_attente" class="list">
            <?php foreach ($liste_attente as $item) { ?>
                <div class="list-item">
                    <?= $item['nom_user'] ?>
                    <form method="post" id="post_approve">
                        <input hidden type="text" name="decision" value="accept">
                        <input hidden type="text" name="id_user" value=<?=$item['id']?>>
                    </form>
                    <button type="submit" form="post_approve" value="Submit" class="btn-accepter">Accepter</button>
                    <form method="post" id="post_refuse">
                        <input hidden type="text" name="decision" value="refuse">
                        <input hidden type="text" name="id_user" value=<?=$item['id']?>>
                    </form>
                    <button type="submit" form="post_refuse" value="Submit" class="btn-supprimer">Refuser</button>
                    
                </div>    
            <?php } ?>
        </div>
    </div>

</body>
</html>
