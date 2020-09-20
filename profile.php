<?php 
session_start();

if (isset($_SESSION['username']) AND $_SESSION['firstname'] AND $_SESSION['lastname'] AND $_SESSION['id'])
{
    require 'sql.php';

    $id = $_SESSION['id'];

    /* Modification du nom de compte */
    if(isset($_POST['modify-username-btn']))
    {
        $new_username = htmlspecialchars($_POST['new_username']);

        if(!empty($new_username))
        {
            $existingusername = getUserUsernamefExist($new_username);

            if($existingusername == 0)
            {    
                updateUsername($new_username, $id);
                $_SESSION['username'] = $new_username;
                header('Location: profile.php');
                exit();
            }
            else
            {
                $error = "nom de compte déjà utilisé.";
            }
        }
        else
        {
            $error = 'le champ relatif au nom du compte doit être complété.';
        }
    }

    /* Modification du mot de passe */
    if(isset($_POST['modify-pass-btn']))
    {
        $pass_hache = $_POST['new_password'];
        $pass_hache_conf = $_POST['new_password_conf'];
        $email = $_SESSION['email'];

        if(!empty($_POST['new_password']) AND !empty($_POST['new_password_conf']))
        {
            if($pass_hache == $pass_hache_conf)
            {
                $pass_hache = password_hash($pass_hache, PASSWORD_BCRYPT);

                updatePass($pass_hache, $email);
                header('Location: profile.php');
                exit();
            }
            else
            {
                $error = "Vos Mots de passe ne correspondent pas.";
            }
        }
        else
        {
            $error = 'les champs relatifs au mot de passe doivent être complétés.';
        }
    }

    /* Modification de l'email */
    if(isset($_POST['modify-email-btn']))
    {
        $new_email = htmlspecialchars($_POST['new_email']);

        if(!empty($new_email))
        {
            if(filter_var($new_email, FILTER_VALIDATE_EMAIL))
            {
                $existingemail = getUserEmailIfExist($new_email);

                if($existingemail == 0)
                {
                    updateEmail($new_email, $id);
                    $_SESSION['email'] = $new_email;
                    header('Location: profile.php');
                    exit();
                }
                else
                {
                    $error = "Adresse mail déjà utilisée.";
                }
            }
            else
            {
                $error = "Votre adresse mail n'est pas valide.";
            }
        }
        else
        {
            $error = 'le champ relatif au mail doit être complété.';
        }
    }

    /* Modification du prénom */
    if(isset($_POST['modify-firstname-btn']))
    {
        $new_firstname = htmlspecialchars($_POST['new_firstname']);

        if(!empty($new_firstname))
        {
            updateFirstname($new_firstname, $id);
            $_SESSION['firstname'] = $new_firstname;
            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au nom doit être complété.';
        }
    }

    /* Modification du nom */
    if(isset($_POST['modify-lastname-btn']))
    {
        $new_lastname = htmlspecialchars($_POST['new_lastname']);

        if(!empty($new_lastname))
        {
            updateLastname($new_lastname, $id);
            $_SESSION['lastname'] = $new_lastname;
            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au prénom doit être complété.';
        }
    }

    /* Modification de la question */
    if(isset($_POST['modify-question-btn']))
    {
        $new_question = htmlspecialchars($_POST['new_question']);

        if(!empty($new_question))
        {
            updateQuestion($new_question, $id);
            $_SESSION['question'] = $new_question;
            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif à la question doit être complété.';
        }
    }

    /* Modification de la réponse */
    if(isset($_POST['modify-answer-btn']))
    {
        $new_answer = htmlspecialchars($_POST['new_answer']);

        if(!empty($new_answer))
        {
            updateAnswer($new_answer, $id);
            $_SESSION['answer'] = $new_answer;
            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif à la réponse doit être complété.';
        }
    }

?>

<?php include("header.php"); ?>

<div class="modify">
    <h1 class="title">Votre profil</h1><br>
    <p>Nom du compte : <?php echo $_SESSION['username']; ?></p>
    <p>Adresse mail : <?php echo $_SESSION['email']; ?></p>
    <p>Prénom : <?php echo $_SESSION['firstname']; ?></p>
    <p>Nom : <?php echo $_SESSION['lastname']; ?></p>
    <p>Question secrète : <?php echo $_SESSION['question']; ?></p>
    <p>Réponse secrète : <?php echo $_SESSION['answer']; ?></p>
</div>

<div class="modify">
    <h1 class="title">Modifier vos informations</h1><br>

    <?php if(isset($error)) : ?>
        <div class="error"><p><?= $error ?></p></div>
    <?php endif; ?>

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_username" value="<?php if(isset($new_username)) { echo $new_username; } ?>" placeholder="Votre nouveau nom de compte">
            <button type="submit" class="button" name="modify-username-btn">Modifier</button>
        </form> 
    </div>

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="password" name="new_password" placeholder="Votre nouveau mot de passe">
            <input class="inputs" type="password" name="new_password_conf" placeholder="Confirmer votre mot de passe">
            <button type="submit" class="button" name="modify-pass-btn">Modifier</button>
        </form> 
    </div>

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_email" value="<?php if(isset($new_email)) { echo $new_email; } ?>" placeholder="Votre nouveau mail">
            <button type="submit" class="button" name="modify-email-btn">Modifier</button>
        </form> 
    </div>

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_firstname" value="<?php if(isset($new_firstname)) { echo $new_firstname; } ?>" placeholder="Votre prénom">
            <button type="submit" class="button" name="modify-firstname-btn">Modifier</button>
        </form>
    </div> 

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_lastname" value="<?php if(isset($new_lastname)) { echo $new_lastname; } ?>" placeholder="Votre nom">
            <button type="submit" class="button" name="modify-lastname-btn">Modifier</button>
        </form>
    </div>

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_question" value="<?php if(isset($new_question)) { echo $new_question; } ?>" placeholder="Votre nouvelle question secrète">
            <button type="submit" class="button" name="modify-question-btn">Modifier</button>
        </form>
    </div> 

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_answer" value="<?php if(isset($new_answer)) { echo $new_answer; } ?>" placeholder="Votre nouvelle réponse secrète">
            <button type="submit" class="button" name="modify-answer-btn">Modifier</button>
        </form> 
    </div>
</div>

<?php
}
?>

<?php include("footer.php"); ?>