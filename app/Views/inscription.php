<!DOCTYPE html>
<html lang="fr">
    <head>
    <style>
        .container {
            max-width: 960px;
            margin: 3rem auto;
            padding: 2rem;
            background-color: #FFF3E0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }

        .flex-container {
            display: flex;
            align-items: center; 
            justify-content: start; 
        }

        .logo-container {
            flex: 0 0 auto; 
            margin-right: 20px; 
        }

        .form-container {
            flex: 1; 
        }
        hr {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(255, 165, 0, 0.5);
            }
        h1 {
            color: #E65100;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            color: #E65100;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #CCC;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="submit"] {
            cursor: pointer;
            background-color: #FF9800;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #E65100;
            border-color: #E65100;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        a {
            color: #FF9800;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logo {
            height: auto;
            max-width: 100%; 
        }

    </style>

    </head>
    <body>
        <div class="container">
            <div class="flex-container"> 
                <div class="logo-container">
                    <img src="<?= base_url('/image/logo.jpg') ?>" alt="Logo" class="logo">
                </div>
                <div class="form-container">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-3 pt-3 pb-3 bg-white from-wrapper">
                    <div class="container">
                        <h1 class="text-center mb-4"> S'inscrire</h1>
                        <hr>
                        <?php if(isset($validation)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?=  $validation->listErrors()?>
                            </div>
                        <?php endif;?>
                        <form method="post">
                            <div class="form-group">
                                <label for="nom">Nom d'utilisateur :</label>
                                <input type="text" id="nom" name="nom" value="<?= old("nom")?>">
                            </div>
                            <div class="form-group">
                                <label for="nom">Adresse email :</label>
                                <input type="email" id="email" name="email" value="<?= old("email")?>">
                            </div>
                            <div class="form-group">
                                <label for="nom">Mot de passe :</label>
                                <input type="password" id="mdp" name="mdp" >
                            </div>
                            <div class="form-group">
                                <label for="nom">Confirmer le mot de passe :</label>
                                <input type="password" id="confirmerMdp" name="confirmerMdp" >
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <input type="submit" class="btn btn-primary"value="S'inscrire">
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <a href=<?=site_url('/connexion')?>>Vous avez déjà un compte? </a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


