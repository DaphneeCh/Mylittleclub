<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion du groupe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin-top: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .list-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-custom {
            cursor: pointer;
            font-size: 14px;
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href=<?=base_url('groupepage/'.$group_id )?> class="btn btn-primary">Voir le groupe</a>
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
                         <button type="submit" form="post_refuse" value="Submit" >Supprimer</button>
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
                    <button type="submit" form="post_approve" value="Submit">Accepter</button>
                    <form method="post" id="post_refuse">
                        <input hidden type="text" name="decision" value="refuse">
                        <input hidden type="text" name="id_user" value=<?=$item['id']?>>
                    </form>
                    <button type="submit" form="post_refuse" value="Submit" >Refuser</button>
                    
                </div>    
            <?php } ?>
        </div>
    </div>

</body>
</html>
