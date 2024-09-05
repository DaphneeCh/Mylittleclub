<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: #f9f9f9; 
            color: #333; 
        }

        .search-results {
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

        .search-results ul {
            width: 100%; 
            padding: 0; 
            list-style: none; 
        }

        .search-results li {
            padding: 8px 0; 
            border-bottom: 1px solid #f60; 
        }

        .search-results li:last-child {
            border-bottom: none; 
        }

        .search-results li a {
            text-decoration: none;
            color: #f60; 
            font-weight: bold;
            display: block; 
        }

        .search-results li:hover {
            background-color: #ffe6cc; 
            cursor: pointer; 
        }

        .search-results .hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        p {
            color: #666; 
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
        h2 {
            color: #f60; 
            margin-bottom: 10px; 
        }

        body {
            font-family: 'Poppins', sans-serif; 
            background-color: #f9f9f9; 
            color: #333; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0;
        }

        .search-results {
            background-color: #fff;
            border: 1px solid #f60;
            padding: 10px 15px;
            width: 80%; 
            max-width: 600px; 
            margin: 20px auto; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
            flex-direction: column; 
            align-items: center; 
        }

        .search-results ul {
            width: 100%; 
            padding: 0; 
            list-style: none; 
            margin: 0; 
        }

        .search-results li {
            padding: 8px 0; 
            border-bottom: 1px solid #f60; 
            width: 100%; 
        }

        .search-results li:last-child {
            border-bottom: none; 
        }

        .search-results li a {
            text-decoration: none;
            color: #f60; 
            font-weight: bold; 
            display: block; 
        }

        .search-results li:hover {
            background-color: #ffe6cc; 
            cursor: pointer; 
        }

        p {
            color: #666; 
            text-align: center; 
        }
        
        .container {
            max-width: 800px; 
            margin: 20px auto; 
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto; 
            height: calc(100vh - 80px); 
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

<div class="search-results">
    <h2>Résultats de la recherche</h2>
    <?php if ((!empty($groups))||(!empty($users))): ?>
        <ul>
            <?php foreach ($groups as $group): ?>
                <li><a href="<?= site_url('/groupepage/' . esc($group['id_gr'], 'url')); ?>"><?= esc($group['nom_gr']); ?></a></li>
            <?php endforeach; ?>
            <?php foreach ($users as $user): ?>
                <li><a href="<?= site_url('/profil/' . esc($user['id'], 'url')); ?>"><?= esc($user['nom_user']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun résultat correspondant à votre recherche</p>
    <?php endif; ?>
</div>
</body>

