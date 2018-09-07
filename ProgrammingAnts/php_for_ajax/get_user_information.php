<?php

    require "../php_for_all/log_function.php";

    $file_log_path = "../log_server.txt";

    if(!isset($_POST['username']) || !isset($_POST['information_needed'])){
        exit;
    }

    $username = $_POST['username'];
    $information_needed = explode(",", $_POST['information_needed']);

    try{
        //On initialise une connexion avec la bdd
        $bdd = new PDO('mysql:host=programmpkroot.mysql.db;dbname=programmpkroot;charset=utf8', 'programmpkroot', 'BddProgAnts15');

    }catch(Exception $e){
        die('Erreur : ' . $e);

    }

    //Partie a renvoyer sous format xml
    header ("Content-Type: text/xml");

    //BDD RECUP FORUM INFORMATION
    if($information_needed[0] == 'true'){

         $query = $bdd->prepare("SELECT last_activity, registered_date, like_received, number_message_sent FROM users WHERE username=?");
         if(!$query->execute(array($username))){
             log_server(("Erreur requête mysql pour recuperer la date de la dernière activité de l'utilisateur : "+$username), $file_log_path);
         }

         $user_forum_information= $query->fetch(PDO::FETCH_ASSOC);
    }

    //BDD RECUP RANK INFORMATION
    if($information_needed[1] == 'true'){
        $query = $bdd->prepare("SELECT rank FROM users WHERE username=?");
        if(!$query->execute(array($username))){
            log_server(("Erreur requête mysql pour recuperer la date de la dernière activité de l'utilisateur : "+$username), $file_log_path);
        }

        $user_rank_information = $query->fetch(PDO::FETCH_ASSOC);
    }

    //BDD RECUP FRIEND INFORMATION
    if($information_needed[2] == "true"){
        $query = $bdd->prepare("SELECT number_friend FROM users WHERE username=?");
        if(!$query->execute(array($username))){
            log_server(("Erreur requête mysql pour recuperer les informations sur les amis l'utilisateur : "+$username), $file_log_path);
        }

        $user_friend_information = $query->fetch(PDO::FETCH_ASSOC);
    }

    echo "<?xml version =\"1.0\" encoding=\"utf-8\"?>";
        echo "<information>";

            //XML FOR FORUM
            if($information_needed[0] == 'true'){

                echo "<last_activity>";
                    echo $user_forum_information['last_activity'];
                echo "</last_activity>";
                echo "<registered_date>";
                    echo $user_forum_information['registered_date'];
                echo "</registered_date>";
                echo "<number_message_sent>";
                    echo $user_forum_information["number_message_sent"];
                echo "</number_message_sent>";
                echo "<like_received >";
                    echo $user_forum_information["like_received"];
                echo "</like_received >";
            }

            if($information_needed[1] == 'true'){
                echo "<rank>";
                    echo $user_rank_information['rank'];
                echo "</rank>";
            }

            if($information_needed[2] == "true"){
                echo "<number_friend>";
                    echo $user_friend_information['number_friend'];
                echo "</number_friend>";
                echo "<friend>";

                echo "</friend>";
            }
        echo "</information>";
?>
