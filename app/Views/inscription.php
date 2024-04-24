<!DOCTYPE html>
<html lang="fr">
    <head>
        <h1>Page d'inscription</h1>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            input[type="submit"] {
                width: 100%;
                padding: 10px;
                background-color: #00ffbf;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #00ffbf;
            }

            .text-danger {
                color: #721c24;
            }

            /* Lien "Vous avez déjà un compte?" */
            a {
                display: block;
                text-align: center;
                margin-top: 15px;
                color: #00ffbf;
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <?php if(isset($validation)) : ?>
            <div class="text-danger">
                <?=  $validation->listErrors()?>
            </div>
        <?php endif;?>
        <script src="test_inscription.js"></script>
        <form method="post">
            <label for="nom">Nom d'utilisateur :</label>
            <input type="text" id="nom" name="nom" size="25" maxlength="100" value="<?= old("nom")?>">
            <br>
            <label for="nom">Adresse email :</label>
            <input type="email" id="email" name="email" size="25" maxlength="100" value="<?= old("email")?>">
            <br>
            <label for="nom">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" size="25" maxlength="100">
            <br>
            <label for="nom">Confirmer le mot de passe :</label>
            <input type="password" id="confirmerMdp" name="confirmerMdp" size="25" maxlength="100">
            <br>
            <input type="submit" value="S'inscrire">
        </form>
        <div>
                <a href="/project-root/public/connexion">Vous avez déja un compte? </a>
        </div>

    </body>
</html>


