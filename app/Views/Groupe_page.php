<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'un Groupe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    
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

        
        body {
            padding-top: 60px; 
            background-color: #f0f2f5;
            color: #333;
            padding-bottom: 20px;
            margin: 0;
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

        
        .post-container {
            background-color: #FFFFFF;
            border: 1px solid #CCC;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }


       
        .group-header {
            background-color: whitesmoke; 
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .group-header h2 {
            color: black;
            margin-bottom: 10px;
        }

        .group-header p {
            color: #666; 
            margin-bottom: 10px;
        }

        
        button, input[type="submit"] {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        button:hover, input[type="submit"]:hover {
            background-color: darkorange;
        }
        .button-group {
            display: flex; 
            align-items: center; 
            gap: 10px; 
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            border: none; 
            color: white; 
        }

        .btn-default {
            background-color: orange; 
        }

        .btn-default:hover {
            background-color: darkorange; 
        }

        .btn-danger {      
            background-color: #dc3545; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 5px;
            cursor: pointer; 
            transition: background-color 0.3s; 
        } 

        .btn-danger:hover {
            background-color: #c82333; 
        }


        
        .post-container {
            background-color: #FFFFFF;
            border: 1px solid #CCC;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .post-container h4, .post-container p, .comments-container h5, .comments-container p {
            margin-bottom: 10px;
        }

        
        .comments-container {
            background-color: #F8F9FA;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 10px 15px;
            margin-top: 20px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.06);
        }

        .comment {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            font-size: 0.9rem;
            color: #333;
        }
        .comment-author {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .comment-author a {
            color: black;
            text-decoration: none; 
        }
        .comment-author a:hover {
            color: orange; 
        }
        .comment-author .dropbtn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 20px;
            color: #333; 
            position: relative;
        }

       
        textarea, input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #CCC;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control {
            margin-bottom: 10px;
        }

    
        .show {
            display: block;
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

        .comment-form, .comments-container {
            margin-top: 10px;
        }

        .hidden {
            display: none;
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
        .posted-date {
            font-size: 0.8em; 
            color: #888; 
            font-style: italic; 
        }
        .post-author {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .post-author a {
            color: black;
            text-decoration: none; 
            font-weight: bold; 
        }
        .post-author a:hover {
            color: orange; 
        }

        .dropbtn {
            cursor: pointer;
            background: none;
            border: none;
            font-size: 20px;
            color: #333; 
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0; 
            background-color: #f9f9f9;
            min-width: 150px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
        }   
        .dropdown {
            position: relative;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

    </style>

</head>
<body>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadPub(<?= $group_id ?>);
            function loadPub(publicationId) {
                var site_url = '<?=site_url('/groupepage/'.$group_id)?>';
                var json_body = {'operation':'affiche_publication', 'id_pub': publicationId};

                fetch(site_url, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(json_body)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var postContainer = document.getElementById('post-area');
                        if (postContainer) {
                            postContainer.innerHTML = '';
                            data.publication.forEach(pub => {
                                const pubDiv = document.createElement('div');
                                pubDiv.className = 'post';
                                pubDiv.innerHTML = `
                                <div class="post-container">
                                    <div class="post-author">
                                        <h4><a href="<?= base_url() ?>profil/${pub.id}">${pub.nom_user}</a> a publié à <span class="posted-date">${new Date(pub.publie_at).toLocaleString()}</span></h4>
                                        <div class="dropdown">
                                            <span class="dropbtn">⋮</span>
                                            <div class="dropdown-content">
                                                <a onclick="makeEditable(${pub.id_pub})">Modifier</a>
                                                <a onclick="supprimerPost(${pub.id_pub})">Supprimer</a>
                                                <a onclick="signalerPost(${pub.id_pub})">Signaler</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-text" id="post-content">
                                        <p>${pub.text}</p>
                                    </div>

                                    <div id="comments${pub.id_pub}" class="comments-container hidden"></div>
                                    <div class="actions">
                                        <button onclick="loadComments(${pub.id_pub})" class="btn icon-button">
                                            <i class="fa fa-comments"></i> Voir des commentaires
                                        </button>
                                        <button onclick="writeComment(${pub.id_pub})" class="btn icon-button">
                                            <i class="fa fa-pencil-alt"></i> Écrire un commentaire
                                        </button>
                                    </div>
                                    <div id="commentForm${pub.id_pub}" class="comment-form hidden"></div>
                                </div>
                                `;
                                postContainer.appendChild(pubDiv);
                            });

                        }
                    } 
                    
                })
        .catch(error => {
            console.error("Erreur de chargement de publication", error);
            alert("Erreur de chargement de publication");
        });
    }

});
            
    </script>
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
        <a href=<?=site_url('/admin/'.$group_id)  ?> class="home-link" class="icon-link home-link" <?=$icon?> title="Gestion du groupe" <?=$icon?>>
            <i class="fas fa-users-cog"></i>
        </a>
        <a href=<?=site_url('/logout')  ?> class="home-link" class="icon-link home-link" title="Déconnexion">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </header>
    <div class="container">
    <div class="group-header">
        <h2> <?= $group_name ?> </h2>
        <p hidden>Group ID: <?= $group_id ?> </p>
        <p>Statut: <?= $group_status ?></p>
        <p>Nombre de membre: <?= $nb_mem .'/'. $group_max_mem ?></p>
        <p>À propos de ce groupe: <?=$description?></p>
        <p>Centres d'intérêt: <?= $interet?></p></p>
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
        <button id="toggleVoteForm" class="btn btn-danger dissolve-btn" <?=$quitter_show?>>Dissoudre le groupe</button>
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
            
            <input type="submit" class="btn btn-danger voter-btn" value="Voter">
        </form>
<script>
            document.addEventListener('DOMContentLoaded', function() {// Gestion de l'affichage du formulaire de vote
                document.getElementById('toggleVoteForm').addEventListener('click', function() {
                    var form = document.getElementById('voteForm');
                    form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
                });

                document.getElementById('voteForm').addEventListener('submit', function(event) {// Confirmation du vote
                    event.preventDefault();

                    var choice = document.querySelector('input[name="choix"]:checked').value;
                    var confirmMessage = `Êtes-vous sûr de vouloir voter '${choice}' pour dissoudre le groupe?`;

                    if (confirm(confirmMessage)) {
                        this.submit();
                    } else {
                        console.log('Vote annulé');
                    }
                });
            });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {// Gestion de l'affichage du menu déroulant
    document.body.addEventListener('click', function(event) {
        if (event.target.matches('.dropbtn')) {
            const dropdownContent = event.target.nextElementSibling;
            if (dropdownContent.style.display === 'none' || !dropdownContent.style.display) {
                dropdownContent.style.display = 'block';
            } else {
                dropdownContent.style.display = 'none';
            }
        } else {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(function(dropdown) {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            });
        }
    });
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
                <form action=<?=site_url('/groupepage/'.$group_id)  ?> method="post" >
                    <input hidden type="text" name="operation" value="ecrire_publication">
                    <input hidden type='text' name='id_gr' value=<?= $group_id ?>>
                    <textarea name="publication" class="form-control" rows="4" cols="50" maxlength="1000" placeholder="Quoi de neuf ?"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Publier</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function signalerPost(publicationId) {// Signaler une publication
            var site_url = '<?=site_url('/groupepage/'.$group_id)?>';
            var json_body = {'operation':'signaler_publication','id_pub': publicationId};
            if (confirm('Êtes-vous sûr de vouloir signaler cette publication?')) {
                fetch(site_url, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify(json_body)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                    } 
                    else {
                        alert("Vous ne pouvez pas signaler");
                    }
                })
                .catch(error => console.error("Erreur de signaler de publication", error));
            }
        }
    </script>
    <script>
        function supprimerCommentaire(commentId,pubId) {// Supprimer un commentaire
            var site_url = '<?=site_url('/groupepage/'.$group_id)?>';
            var json_body = {'operation':'supprimer_commentaire','id_com': commentId, 'id_pub': pubId };
            if (confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?')) {
                fetch(site_url, {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest"
                        },
                        body: JSON.stringify(json_body)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        loadComments(data.id_pub);
                    } 
                    else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Erreur de suppression de commentaire", error));
            }
        }
    </script>
    <script>
        function submitComment(event, postId) { // Ajouter un commentaire
            event.preventDefault(); // Empêcher le formulaire de soumettre les données

            const form = event.target;
            const formData = new FormData(form);
            formData.append('operation', 'ecrire_commentaire');
            const json = Object.fromEntries(formData.entries());
            var site_url = '<?=site_url('/groupepage/'.$group_id)?>';

            fetch(site_url, {// Envoi de la requête POST
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(json)
            })
            .then(response => response.json())// Récupération de la réponse JSON
            .then(data => {
                if (data.success) {// Si la requête a réussi
                    form.reset(); 
                    loadComments(postId);
                } 
            })
            .catch(error => console.error("Erreur d'ajouter un commentaire", error));
        }
        function writeComment(postId) {// Afficher le formulaire de commentaire
            var formContainer = document.getElementById('commentForm' + postId);// Récupérer le conteneur du formulaire
            if (formContainer.innerHTML === '') {// Si le formulaire n'est pas déjà affiché
                formContainer.innerHTML = `
                    <form onsubmit="submitComment(event, ${postId})">
                        <input type="hidden" name="id_pub" value="${postId}">
                        <input type="hidden" name="operation" value="ecrire_commentaire">
                        <textarea name="commentaire" class="form-control" rows="2" placeholder="Ajouter un commentaire..."></textarea>
                        <button type="submit" class="btn btn-secondary mt-2">Commenter</button>
                    </form>
                `;
            }
            formContainer.classList.toggle('hidden');// Afficher ou masquer le formulaire
        }

        function loadComments(postId) {// Charger les commentaires
            var site_url = '<?=site_url('/groupepage/'.$group_id)?>';// URL de la requête
            var json_body = {'operation':'fetch_commentaire','id_pub':postId};
            fetch(site_url, {// Envoi de la requête POST
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(json_body)
            })
            .then(response => response.json())// Récupération de la réponse JSON
            .then(data => {
                if (data.success) {// Si la requête a réussi
                    comments = data.comments
                    const commentsContainer = document.getElementById('comments' + postId);
                    
                    commentsContainer.innerHTML = '';

                    data.comments.forEach(comment => {
                        const commentDiv = document.createElement('div');
                        commentDiv.className = 'comment';

                        commentDiv.innerHTML = `
                            <div class="comment-author">
                                <h5><a href="<?= base_url() ?>profil/${comment.id}">${comment.nom_user}</a> a commenté à <span class="posted-date">${comment.publie_at}</span></h5>
                                <div class="dropdown">
                                            <span class="dropbtn">⋮</span>
                                            <div class="dropdown-content" onclick="supprimerCommentaire(${comment.id_com},${comment.id_pub})">
                                                <a>Supprimer</a>
                                            </div>
                                </div>
                            </div>
                            <p>${comment.text}</p>
                         `;

                        commentsContainer.appendChild(commentDiv);
                        commentsContainer.classList.remove('hidden');
                    });
                     
                } else {
                    alert(data.message); 
                }
            })
            .catch(error => console.error("Erreur d'ajouter un commentaire", error));
        }



    </script>
    
<script>
    function supprimerPost(publicationId) {// Supprimer une publication
        var site_url = '<?=site_url('/groupepage/'.$group_id)?>';
        var json_body = {'operation':'supprimer_publication','id_pub':publicationId};
        if (confirm('Êtes-vous sûr de vouloir supprimer cette publication?')) {
            fetch(site_url, {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(json_body)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    var postElement = document.getElementById('post-area');
                    if (postElement) {
                        window.location.reload();
                        loadPub(<?= $group_id ?>);
                        postElement.remove();
                    
                } 
                else {
                    alert(data.message);
                }
            }})
            .catch(error => console.error("Erreur de suppression de publication", error));
        }
    }
</script>
<script>
    function makeEditable(postId) {// Rendre le texte de la publication éditable
        let contentDiv = document.getElementById('post-content');
        let currentText = contentDiv.innerText.trim(); 
        event.preventDefault();
        event.stopPropagation();
    
        //Verifier si le texte est déjà en mode édition
        if (contentDiv.querySelector('textarea')) {
            return; 
            
        }

        // Remplacer le texte par un textarea pour l'édition
        contentDiv.innerHTML = `
            <textarea id="edit-content-${postId}" class="form-control">${currentText}</textarea>
            <button onclick="saveChanges(${postId}); event.stopPropagation();" class="btn btn-primary mt-2">Save Changes</button>
        `;

        // Focus sur le textarea
        document.getElementById(`edit-content-${postId}`).focus();
            contentDiv.innerHTML = `
                <textarea id="edit-content-${postId}" class="form-control">${currentText}</textarea>
                <button onclick="sauvegardChanges(${postId})" class="btn btn-primary mt-2">Sauvegarder</button>
            `;
        }
        //Sauegarder les modifications
        function sauvegardChanges(postId) {
            let textarea = document.getElementById(`edit-content-${postId}`);
            let updatedContent = textarea.value;
            var site_url = '<?=site_url('/groupepage/'.$group_id)?>';
            var json_body = {'operation':'modifier_publication', 'id_pub': postId, 'text': updatedContent};
            fetch(site_url, {
                method: 'post',
                headers: {
                    "Content-Type": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                    },
                    body: JSON.stringify(json_body)
            })  
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    document.getElementById('post-content').innerHTML = `<p>${updatedContent}</p>`;
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            }).catch(error => console.error("Erreur de sauvegerder de publication", error));
        }

</script>
    <div class="row justify-content-md-center"<?=$contenu_show?>>
        <div id='post-area' class="col-md-auto">
             
        </div>
</div>
</div>
</body>
</html>