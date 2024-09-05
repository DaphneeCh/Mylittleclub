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
            .form-group {
                margin-bottom: 1rem;
            }

            hr {
                margin-top: 0.5rem;
                margin-bottom: 1rem;
                border: 0;
                border-top: 1px solid rgba(255, 165, 0, 0.5);
            }
            h1.text-center {
                color: #E65100; 
                margin-bottom: 1.5rem;
            }
            .alert-success {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
                padding: 0.75rem 1.25rem;
                margin-bottom: 1rem;
                border-radius: 4px;
                font-size: 0.9rem;
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

            label {
                display: block;
                margin-bottom: .5rem;
                color: #E65100; 
            }

            .form-control {
                display: block;
                width: 100%; 
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
                line-height: 1.5;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            }

            .form-control:focus {
                border-color: #FF6D00; 
                outline: none;
                box-shadow: 0 0 0 2px #FFE0B2; 
            }

            .btn-primary {
                cursor: pointer;
                background-color: #FF9800; 
                color: white;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 4px;
                transition: background-color 0.2s;
            }

            .btn-primary:hover {
                background-color: #E65100; 
                border-color: #E65100;
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
            <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-3 pt-3 pb-3 bg-white from-wrapper">
                <div class="container">
                    <h1 class="text-center mb-4"> Se connecter</h1>
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
                        </div>
                    </form>
                            <div class="col-12 col-sm-8 text-right">
                                <a href=<?=site_url('/inscription')?>>Vous n'avez pas encore de compte? </a>
                            </div>
                        </div>
                </div>
            </div> 
        </div>
    </div>
    </div>
</body>