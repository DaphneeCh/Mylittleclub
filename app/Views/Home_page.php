<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page d'Accueil du Réseau Social</title>
    <!-- Intégration de Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1>My Little Club</h1>
    </div>
    
<div class="d-flex justify-content-center align-items-center mb-4">
    <!-- Barre de recherche -->
    <div class="flex-grow-1 mr-2">
    <form method="post" id="recherche" action=<?=base_url('/homepage/recherche') ?>>
        <div class="input-group">
            <input type="text" name='inputName'class="form-control" placeholder="Rechercher des groupes...">
    </form>
            <div class="input-group-append">
                <button class="btn btn-primary" form="recherche" type="submit" value="Submit">Recherche</button>
            </div>
        </div>
    </div>

    <!-- Bouton créer un groupe -->
    <a href="groupe" class="btn btn-success mr-2" >Créer un groupe</a>

    <!-- Bouton profil -->
    <a href="mon-profil" class="btn btn-info mr-2">Mon Profil</a>

    <!-- Bouton déconnexion -->
    <form method="post" action=<?=base_url('logout')?>>
    <button type="submit" class="btn btn-warning">Déconnexion</button>
    </form>

</div>

    
    <!-- Groupes Suggérés -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Vous vous intéressez?</h2>
            <ul class="list-group">
            <?php foreach ($liste_suggest as $item) { ?>
                <li class="list-group-item"><a href="groupepage/<?= $item['id_groupe'] ?>"><?= $item['nom_gr'] ?></a></li>
            <?php } ?>
            </ul>
        </div>
    
        <!-- Groupes Rejoint -->
        <div class="col-md-6">
            <h2>Mes groupes</h2>
            <ul class="list-group">
            <?php foreach ($liste_rejoint as $row) { ?>
                <li class="list-group-item"><a href="groupepage/<?= $row['id_groupe'] ?>"><?= $row['nom_gr'] ?></a></li>
            </ul>
            <?php } ?>
        </div>
    </div>

</div>

</body>
</html>
