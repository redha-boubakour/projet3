<?php  

try
        {
	        $bdd = new PDO('mysql:host=localhost:3308;dbname=gbaf2;charset=utf8', 'root', '');
        }
            catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

// Vérification de la validité des informations

        $errors = array();

    if(isset($_POST['login']))
    {  
        if (!empty($_POST)) {
                
                if (empty($_POST['new_mail'])) {
                    $errors['new_email'] = "l'adresse email est vide";
                }/* elseif() {
                    $errors['new_mail'] = "l'adresse email ne correspond pas au format souhaité";
                } else() {
                    $errors['new_mail'] = "l'adresse email est déjà prise";
                }*/
                            } 
    }

// declaration - Hachage du mot de passe

$new_account = $_POST['new_account'];
$new_email = $_POST['new_email'];
$pass_hache = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
$pass_hache_conf = password_hash($_POST['new_pass_conf'], PASSWORD_DEFAULT);
$new_firstname = $_POST['new_firstname'];
$new_lastname = $_POST['new_lastname'];
$new_secret_question = $_POST['new_secret_question'];
$new_secret_answer = $_POST['new_secret_answer'];

// Erreurs

$errors = array();

if(empty($new_account)) {array_push($errors, "Nom du compte requis")};
if(empty($new_email)) {array_push($errors, "Mail requis")};
if(empty($new_pass)) {array_push($errors, "Nmot de passe requis")};
if(empty($new_pass_conf)) {array_push($errors, "Confirmation du mot de pass requise")};
if(empty($new_firstname)) {array_push($errors, "Nom requis")};
if(empty($new_lastname)) {array_push($errors, "Prénom requis")};
if(empty($new_secret_question)) {array_push($errors, "Question requise")};
if(empty($new_secret_answer)) {array_push($errors, "Réponse requise")};

if($new_pass != $new_pass_conf) {array_push($errors, "Mot de passe invalide")};


// Insertion
$req = $bdd->prepare('INSERT INTO user(username, email, password, password_confirmation, question, answer, firstname, lastname, created_at) VALUES(:new_account, :new_email, :new_pass, :new_pass_conf, :new_firstname, :new_lastname, :new_secret_question, :new_secret_answer, CURDATE())');

$req->execute(array(
    'username' => $new_account,
    'email' => $new_email,
    'password' => $pass_hache,
    'password_confirmation' => $pass_hache_conf,
    'firstname' => $new_firstname,
    'lastname' => $new_lastname,
    'new_secret_question' => $new_secret_question,
    'new_secret_answer' => $new_secret_answer
    ));

?>