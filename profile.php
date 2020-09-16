<?php 
session_start();

if (isset($_SESSION['id']))
{
    require 'sql.php';

    $id = $_SESSION['id'];

    if(isset($_POST['modify-username-btn']))
    {
        $new_username = $_POST['new_username'];

        if(!empty($new_username))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET username = '$new_username'
                WHERE id = '$id'
            ");
            $req->execute();

            $_SESSION['username'] = $new_username;

            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au nom du compte doit être complété.';
        }
    }

    if(isset($_POST['modify-pass-btn']))
    {
        $pass_hache = $_POST['new_password'];
        $pass_hache_conf = $_POST['new_password_conf'];

        if(!empty($_POST['new_password']) AND !empty($_POST['new_password_conf']))
        {
            if($pass_hache == $pass_hache_conf)
            {
                $pass_hache = password_hash($pass_hache, PASSWORD_BCRYPT);
                $req = $bdd->prepare("
                            UPDATE user
                            SET password = '$pass_hache'
                            WHERE id = '$id'
                        ");
                $req->execute();

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

    if(isset($_POST['modify-email-btn']))
    {
        $new_email = $_POST['new_email'];

        if(!empty($new_email))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET email = '$new_email'
                WHERE id = '$id'
            ");
            $req->execute();

            $_SESSION['email'] = $new_email;

            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au mail doit être complété.';
        }
    }

    if(isset($_POST['modify-firstname-btn']))
    {
        $new_firstname = $_POST['new_firstname'];

        if(!empty($new_firstname))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET firstname = '$new_firstname'
                WHERE id = '$id'
            ");
            $req->execute();

            $_SESSION['firstname'] = $new_firstname;

            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au nom doit être complété.';
        }
    }

        if(isset($_POST['modify-lastname-btn']))
    {
        $new_lastname = $_POST['new_lastname'];

        if(!empty($new_lastname))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET lastname = '$new_lastname'
                WHERE id = '$id'
            ");
            $req->execute();

            $_SESSION['lastname'] = $new_lastname;

            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif au prénom doit être complété.';
        }
    }

    if(isset($_POST['modify-question-btn']))
    {
        $new_question = $_POST['new_question'];

        if(!empty($new_question))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET question = '$new_question'
                WHERE id = '$id'
            ");
            $req->execute();

            $_SESSION['question'] = $new_question;

            header('Location: profile.php');
            exit();
        }
        else
        {
            $error = 'le champ relatif à la question doit être complété.';
        }
    }

    if(isset($_POST['modify-answer-btn']))
    {
        $new_answer = $_POST['new_answer'];

        if(!empty($new_answer))
        {
            $req = $bdd->prepare("
                UPDATE user
                SET answer = '$new_answer'
                WHERE id = '$id'
            ");
            $req->execute();

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

<div class="main">
    <h1 class="title">Votre profil</h1>

    <p>Nom du compte : <?php echo $_SESSION['username']; ?></p>
    <p>Adresse mail : <?php echo $_SESSION['email']; ?></p>
    <p>Nom : <?php echo $_SESSION['firstname']; ?></p>
    <p>Prénom : <?php echo $_SESSION['lastname']; ?></p>
    <p>Question secrète : <?php echo $_SESSION['question']; ?></p>
    <p>Réponse secrète : <?php echo $_SESSION['answer']; ?></p>
</div>

<div class="modify">
    <h1 class="title">Modifier vos informations</h1>

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
            <input class="inputs" type="password" name="new_password_conf" placeholder="Confirmer votre nouveau mot de passe">
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
            <input class="inputs" type="text" name="new_firstname" value="<?php if(isset($new_firstname)) { echo $new_firstname; } ?>" placeholder="Votre nom">
            <button type="submit" class="button" name="modify-firstname-btn">Modifier</button>
        </form>
    </div> 

    <div class="modify_info">
        <form method="post" class="form">
            <input class="inputs" type="text" name="new_lastname" value="<?php if(isset($new_lastname)) { echo $new_lastname; } ?>" placeholder="Votre prénom">
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