<!DOCTYPE html>
<html lang="fr">
    <head>
        <h1>Se connecter</h1>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
            }
            h3 {
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
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-3 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">
                    <hr>
                    <?php if (session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <form class="" method="post">
                        <div class="form-group">
                            <label for="email">Adresse mail</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control" name="mdp" id="password" value="">
                        </div>
                        <?php if (isset($validation)): ?>
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation -> listErrors() ?>
                                </div>
                            </div>  
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                            <div class="col-12 col-sm-8 text-right">
                                <a href="/project-root/public/inscription">Vous n'avez pas encore de compte? </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</body>