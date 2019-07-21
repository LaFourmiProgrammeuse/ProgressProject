<?php

header("Content-Type: plain/text");

try{
    $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');
}
catch(Exception $e){
    die('Erreur : ' . $e->getMessage());
}

$author_reaction = $_POST['author'];
$object_type = $_POST['object_type'];
$action_type = $_POST['action_type'];


//En fonction du type d'objet sur lequel l'utilisateur a régis on traite pas de la même façon
if($object_type == "post"){

    $post_id = $_POST["post_id"];

    $qprepare = $bdd->prepare("SELECT n_like, n_dislike, author FROM posts WHERE id=?");
    $qprepare->execute(array($post_id));

    $qrep = $qprepare->fetch();

    $author_post = $qrep["author"];

    $n_like = intval($qrep["n_like"]);
    $n_dislike = intval($qrep["n_dislike"]);

    //On regarde si l'utilisateur a déja réagis à ce post
    $qprepare = $bdd->prepare("SELECT type FROM reactions WHERE author=? && object=? && object_id=?");
    $qprepare->execute(array($author_reaction, $object_type, $post_id));

    if($qrep = $qprepare->fetch()){

        if($action_type == "like"){

            if($qrep["type"] == "like"){
                $post_liked = "true";
                $post_disliked = "false";
            }
            else if($qrep["type"] == "dislike"){
                $post_liked = "true";
                $post_disliked = "false";

                $n_like++;
                if(!($n_dislike-1 < 0)){
                    $n_dislike--;
                }

                //Si le post a été liké et ne l'était pas déjà, on ajoute 1 like à l'utilisateur qui a vu son post liké
                $qprepare = $bdd->prepare("UPDATE users SET like_received=like_received+1 WHERE username=?");
                $qprepare->execute(array($author_post));
            }
        }
        else if($action_type == "dislike"){

            if($qrep["type"] == "like"){
                $post_liked = "false";
                $post_disliked = "true";

                $n_dislike++;
                if(!($n_like-1 < 0)){
                    $n_like--;
                }

                //On retire 1 like à l'utilisateur qui avait son post liké
                $qprepare = $bdd->prepare("UPDATE users SET like_received=like_received-1 WHERE username=?");
                $qprepare->execute(array($author_post));
            }
            else if($qrep["type"] == "dislike"){
                $post_liked = "false";
                $post_disliked = "true";
            }
        }

        //On modifie la réaction de l'utilisateur sur ce post
        $qprepare = $bdd->prepare("UPDATE reactions SET type=? WHERE object=? && object_id=? && author=?");
        $qprepare->execute(array($action_type, $object_type, $post_id, $author_reaction));

    }
    else{

        if($action_type == "like"){
            $post_liked = "true";
            $post_disliked = "false";

            $n_like++;

            //On ajoute 1 like à l'utilisateur qui a vu son post liké
            $qprepare = $bdd->prepare("UPDATE users SET n_like=n_like+1 WHERE username=?");
            $qprepare->execute(array($author_post));
        }
        else if($action_type == "dislike"){
            $post_liked = "false";
            $post_disliked = "true";

            $n_dislike++;
        }

        //On ajoute la réaction à ce post de l'utilisateur
        $qprepare = $bdd->prepare("INSERT INTO reactions (type, object, object_id, author) VALUES (?, 'post', ?, ?)");
        $qprepare->execute(array($action_type, $post_id, $author_reaction));
    }


    //On actualise le nombre de réaction qu'a reçu ce post
    $qprepare = $bdd->prepare("UPDATE posts SET n_like=?, n_dislike=? WHERE id=?");
    $qprepare->execute(array($n_like, $n_dislike, $post_id));


    //Réponse pour les posts (XML)
    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>";
    echo "<reaction_informations>";
        echo "<post_liked>" . $post_liked . "</post_liked>";
        echo "<post_disliked>" . $post_disliked . "</post_disliked>";
        echo "<n_like>" . $n_like . "</n_like>";
        echo "<n_dislike>" . $n_dislike . "</n_dislike>";
    echo "</reaction_informations>";
}


?>
