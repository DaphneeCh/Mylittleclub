<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un nouveau groupe</title>
    <style>
        
        /* General container and form styling, with a subtle green touch */
        .container {
            max-width: 600px; 
            margin: 5rem auto;
            padding: 2rem;
            background-color: #f0f6f0; /* Light green background for the form area */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 100, 0, 0.1); /* Green shadow for depth */
        }

        /* Title styling */
        h1.text-center {
            color: #004d00; /* Darker green for contrast */
            margin-bottom: 1.5rem;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Styling for form groups */
        .formulaire_gr {
            margin-bottom: 1rem;
            width: 100%;
        }

        .formulaire_gr label {
            display: block;
            margin-bottom: .5rem;
            color: #006600; /* Slightly muted green */
            font-weight: bold;
        }

        /* Input and Select styling with a focus on green accents */
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
            border-color: #004d00; /* Dark green border for focus */
            outline: none; /* Removing default focus outline */
            box-shadow: 0 0 0 2px #ccffcc; /* Soft green glow */
        }

        /* Button styling with green color */
        button {
            cursor: pointer;
            background-color: #008000; /* Standard green */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #005600; /* Darker green on hover */
        }

        /* Error message styling */
        .text-danger {
            color: #dc3545; /* Keeping error messages in red for clarity and contrast */
            margin-top: 0.5rem;
            text-align: center;
        }

    </style>
</head>
    <body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Créer un nouveau groupe</h1>
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
            <br>
            <div class="formulaire_gr">
                <label for ="">Statut du groupe:</label>
                <select name="Statut_du_groupe">
                    <option value=""></option>
                    <?php foreach($Statut as $stat):?>
                        <option value="<?=$stat?>"><?=$stat?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <br>
            <div class="formulaire_gr">
                <label for ="">Nombre de membre du groupe:</label>
                <select name="Nombre_de_membre">
                    <option value=""></option>
                    <?php foreach($Nb_groupe as $nb):?>
                        <option value="<?=$nb?>"><?=$nb?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <br>
            <div class="formulaire_gr">
                <button type="submit">Créer</button>
            </div>    
        </form>
    </body>
</html>
