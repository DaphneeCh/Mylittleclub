<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'un Groupe</title>
    <style>

        /* Navbar styling (assuming you want it minimalistic) */
        .navbar {
            background-color: 00ffbf; /* Adjust color to fit your design */
            padding: 10px 20px;
            color: #00ffbf;
            margin-bottom: 20px; /* Adds space below the navbar */
        }

        /* Group header and information styling */
        .group-header {
            background-color:00ffbf;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px; /* Space between header and following content */
        }

        .group-header h2 {
            color: #007bff; /* Makes the group name stand out */
            margin-bottom: 10px; /* Adds a little space below the group name */
        }

        .group-header p {
            margin-bottom: 10px; /* Adds space between paragraphs for better readability */
        }

        /* Reset for common elements */
        body, h4, h5, p, form, input, textarea, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            padding: 20px;
        }

        /* Styling for the post container */
        .post-container {
            background-color: #FFFFFF;
            border: 1px solid #CCC;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px; /* Space between each post container */
        }

        /* Styling for post titles and text */
        .post-container h4, .post-container p {
            margin-bottom: 10px; /* Space between title/text elements */
        }

        /* Specific styling for comments within a post */
        .post-container h5, .post-container > p {
            background-color: #F8F9FA; /* Lighter background for comments */
            border-left: 4px solid #007BFF; /* A colored bar to indicate comment nesting */
            padding: 10px;
            margin-top: 15px;
            border-radius: 4px; /* Slightly rounded corners for comments */
            font-size: 0.9rem; /* Smaller font size for comments */
        }

        /* Styling for input fields and buttons for interaction */
        .post-container textarea, .post-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px; /* Space above elements */
            border: 1px solid #CCC;
            border-radius: 4px; /* Consistency in border radius */
        }
        .post-text {
            font-size: 20px; /* Optimal size for readability */
            line-height: 1.6; /* Spacing for better readability */
            color: #4a4a4a; /* A softer color than pure black to reduce eye strain */
            margin-bottom: 15px; /* Space after the post, before any comments or additional elements */
        }

        .post-author {
            font-size: 18px; /* Slightly larger than the body text for emphasis */
            font-weight: bold; /* Make the author's name stand out */
            color: #007bff; /* A distinct color (e.g., theme color or any color that stands out but is readable) */
            margin-bottom: 8px; /* Space between the author's name and the post text */
        }


        /* Button styling */
        .post-container button {
            background-color:#00ffbf;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Button hover effect for interactivity */
        .post-container button:hover {
            opacity: 0.9;
        }
        .comments-container {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #00ffbf; /* Slightly different background to distinguish from the post */
            border-radius: 8px;
            border: 1px solid #e1e1e1; /* Subtle border to define the comments area */
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.06); /* Soft inner shadow to give depth */
        }

        /* Individual comment styling */
        .comment {
            padding: 10px;
            margin-bottom: 15px; /* Space between comments */
            background-color: #ffffff; /* White background for each comment */
            border: 1px solid #ddd; /* Slight border to differentiate individual comments */
            border-radius: 4px; /* Rounded corners for a softer look */
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Outer shadow for more depth */
            font-size: 0.9rem; /* Slightly smaller font size for textual hierarchy */
            color: #333; /* Default text color for readability */
        }
        


        /* Comment author styling for emphasis */
        .comment-author {
            font-weight: bold;
            margin-bottom: 5px; /* Small gap between author name and comment text */
            color: #007bff; /* Optional: color to make author names stand out */
        }

        form input[type="submit"] {
            background-color: #00ffbf; /* Green background color for visibility and attractiveness */
            color: white; /* White text color for contrast */
            padding: 10px 20px; /* Padding to make the button larger and more clickable */
            border: none; /* Remove the default border */
            border-radius: 5px; /* Slightly rounded corners for a modern look */
            cursor: pointer; /* Change cursor to pointer to indicate it's clickable */
            font-size: 1rem; /* Increase font size for readability */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        /* Hover effect for the 'Rejoindre' button */
        form input[type="submit"]:hover {
            background-color: #00ffbf; /* Darker shade of green on hover for feedback */
        }

        .button-group {
            display: flex; /* Use Flexbox to align items in a row */
            justify-content: start; /* Align items at the start of the container */
            gap: 10px; /* Adds some space between the two buttons */
        }

        .action-btn, .dissolve-btn {
            padding: 10px 20px; /* Uniform padding for both buttons */
            border: none;
            border-radius: 5px; /* Rounded corners for a modern look */
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s; /* Smooth transition for visual feedback */
        }

        .dissolve-btn {
            background-color: #00ffbf; /* Green */
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dissolve-btn:hover {
            background-color: #45a049;
        }
        







    </style>

</head>
<body>
    <div class="navbar"> </div>
    <div class="group-header">
        <h2> <?= $group_name ?> </h2>
        <p>Group ID: <?= $group_id ?> </p>
        <p>Group member: <?= $nb_mem .'/'. $group_max_mem ?></p>
        <p>Statut: <?= $group_status ?></p>
        <p>Bienvenue dans notre groupe! N'hésitez pas à partager vos réflexions et à vous connecter avec les autres.</p>
        <div class="button-group">
        <form method="post" <?=$rejoindre_show?>>
            <input hidden name='operation' value="rejoint_gr">
            <input type="submit" value="Rejoindre">
        </form>
        <form method="post" <?=$quitter_show?>>
            <input hidden name="operation" value="quitter_gr">
            <input hidden type='text' name='id_gr' value=<?= $group_id ?>>
            <input type="submit" value="Quitter">
        </form> 
        <button id="toggleVoteForm" class="btn btn-primary dissolve-btn" <?=$quitter_show?>>Dissoudre le groupe</button>

        <form id="voteForm" method="post" action="" style="display: none;">
            <input hidden name="operation" value="dissolve_gr">
            <div class="radio-option">
                <input type="radio" id="dissolve_yes" name="choix" value="Oui">
                <label for="dissolve_yes">Oui</label>
            </div>
            
            <div class="radio-option">
                <input type="radio" id="dissolve_no" name="choix" value="Non" checked>
                <label for="dissolve_no">Non</label>
            </div>
            
            <input type="submit" value="Voter">
        </form>
        <script>
            document.getElementById('toggleVoteForm').addEventListener('click', function() {
                var form = document.getElementById('voteForm');
                if (form.style.display === 'none') {
                    form.style.display = 'block'; // Show the form
                } else {
                    form.style.display = 'none'; // Hide the form
                }
            });
        </script>
        </div>
        <?php if (isset($alertMessage) && !empty($alertMessage)): ?>
            <script type="text/javascript">
                alert('<?= esc($alertMessage, 'js') ?>');
            </script>
        <?php endif; ?>   
    </div>
    <div class="row justify-content-md-center" <?=$contenu_show?> >
        <div class="col-md-8">
        <!-- Zone de Publication -->
            <div class="post-container my-4 p-3">
                <h4>Créer une publication</h4>
                <?php if(isset($validation)) : ?>
                    <div class="text-danger">
                        <?=  $validation->listErrors()?>
                     </div>
                 <?php endif;?>
                <form action=<?=base_url('/groupepage/'.$group_id)  ?> method="post" >
                    <input hidden type="text" name="operation" value="ecrire_publication">
                    <input hidden type='text' name='id_gr' value=<?= $group_id ?>>
                    <textarea name="publication" class="form-control" rows="4" cols="50" maxlength="1000" placeholder="Quoi de neuf ?"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Publier</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5"<?=$contenu_show?>>
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <?php foreach($publication as $pub) { ?>
                <div class="post-container">
                <div class="post-author">
                <h4><?=$pub['nom_user']?> a publié</h4></div>
                    <div class="post-text">
                    <p><?=$pub['text']?></p></div>
                <?php foreach($pub['commentaire'] as $com) { ?> 
                    <div class ="comments-container">
                    <div class="comment-author">
                    <h5><?=$com['nom_user']?></h5>
                    </div>
                    <div class="comment">
                    <p><?=$com['text']?></p>
                    </div>
                    </div>
                <?php } ?>
                <div class="comment-form">
                    <form action="" method="post">
                        <input type="hidden" name="id_publication" value=<?=$pub['id_pub']?>>
                        <input type="hidden" name="operation" value="ecrire_commentaire">
                        <textarea name="commentaire" class="form-control" rows="2" placeholder="Ajouter un commentaire..."></textarea>
                        <div class="button-group">
                        <button type="submit" class="btn btn-secondary mt-2">Commenter</button>
                    </form>
                    <button class="btn btn-primary toggle-comments">Afficher plus commentaires</button>
                </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
</body>
</html>