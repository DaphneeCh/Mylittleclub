function inscription_rempli(){
    if ((document.getElementById("nom") != null) && (document.getElementById("email") != null) && (document.getElementById("mdp") != null) && (document.getElementById("confirmerMdp") != null)){
        return true;
    } else{
    return false;
    }
}
email = document.getElementById("email");
function validation_email(email){
    if (inscription_rempli() == true){
        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return re.test(email);
    }
}
function validation(){
    var $result = $("#result");
        var email = $("#email").val();
        $result.text("");
      
        if (validation_email(email)) {
          $result.text(email + " is valid");
          $result.css("color", "blue");
          return true;
        } else {
          $result.text(email + " is not valid");
          $result.css("color", "red");
        }
        return false;
}
function motDePasse(){
    if (validation() == true){
        if(document.getElementById("mdp") == document.getElementById("confirmerMdp")){
            return true;
        }
    } else{
        return false;
    }
}
function message(){
    if(motDePasse() == true){
        alert("L'inscription est validée");
    }
}