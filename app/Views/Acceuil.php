<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <script src="https://kit.fontawesome.com/ba57058827.js" crossorigin="anonymous"></script>
    <!-- Styles CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header>
        
        <div class="logo">
            <img src="<?=base_url('/image/logo_final.png')?>" alt="logo" height="60">
            <h1>My Little Club</h1></div>
    <div class="buttons">
    <form method="post" action="<?= site_url('connexion') ?>">
        <button type="submit" class="btn btn-login" title="Connexion" ><i class="fas fa-sign-in-alt"></i></button>
    </form>
    <form method="post" action="<?= site_url('inscription') ?>">
        <button type="submit" class="btn btn-signup" title="Inscription" ><i class="fas fa-user-plus"></i></button>
    </form>
    </div>
    </header>
    <section class="text">
        <span>Bienvenue sur My Little Club!</span>
        <p>Tissez des liens solides avec d'autres membres et cultivez des relations sociales de qualité.</p>
    <div class="overlay">
</div>
<style>
   
    *, *::before, *::after{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    } 
    body{
        font-family:'Poppins';
        font-size: 14px;
    }
    .overlay{
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100vh;
    background-image: url(<?=base_url('/image/image_final.png')?>);
    background-size: cover;  
    background-position: center;
    z-index: -100;
    }
    header{
    max-width: 80%;
    margin-right:auto;
    margin-left: auto;
    }
    .logo {
    display: flex;
    align-items: center;
    }
   .logo h1 {
        margin-left: 10px;
        font-size: 24px;
        color: white;
    }
    .buttons {
        position: absolute;
        top: 20px;
        right: 20px;
    }
    .btn-login,
    .btn-signup {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-login {
        background-color: orange; /* Couleur de fond pour le bouton de connexion */
        color: white; /* Couleur du texte pour le bouton de connexion */
    }
    .btn-signup {
        background-color: orange; /* Couleur de fond pour le bouton d'inscription */
        color: white; /* Couleur du texte pour le bouton d'inscription */
    }
    .btn-login:hover,
    .btn-signup:hover {
        background-color: #FFA500; /* Changement de couleur au survol pour les deux boutons */
    }
    .text {
            text-align: center; /* Centrer tout le contenu à l'intérieur de la section */
            margin-top:150px;
            background-color: transparent;
            font-size: 36px;
            font-weight: 600;
            padding: 30px 20px; /* Ajout d'un espace padding */
            color: white;
        }
        .text h1 {
            font-size: 50px;
            padding: 20px 0; /* Ajout d'un espace padding */
        }
        .text p {
            font-size: 20px;
            padding: 20px 0; /* Ajout d'un espace padding */
        }
        .buttons {
            display: flex; 
            justify-content: space-between; 
        }

        .buttons form {
            margin-right: 10px; 
        }

</style>
</body>
</html>