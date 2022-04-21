<?php

// Les parametres de connexions
define("SERVEUR","localhost");
define("DB_NAME","whatsapp");
define("USER","root");
define("PASSWORD",'');

// Definir le Domain Server Name(DSN)
$dsn = 'mysql:host='.SERVEUR.';dbname='.DB_NAME.';charset=utf8';
// Options de PDO pour la gestion des erreurs
$tabOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

// Création de l'instance PDO
try{
    $ds = new PDO($dsn,USER,PASSWORD);
}catch (PDOException $ex){
    die($ex ->getMessage());
}

if(isset($_GET['idSearchMessage'])){
    $msg = $_GET['idSearchMessage'];
    $id = $_GET['idDiscussion'];
    $sql = "SELECT * FROM messages WHERE idDiscussion = $id AND messageMsg LIKE '%".$msg."%'";
    $exe = $ds->query($sql);
    $tab = $exe->fetchAll();
    if (empty($tab)) {
        echo json_encode("0");
    } else {
        echo json_encode($tab);
    }
}

if(isset($_GET['idSearchUser'])){
    $user = $_GET['idSearchUser'];
    $id = $_GET['idUserConnect'];
    $sql = "SELECT * FROM users WHERE id NOT IN (SELECT u.id FROM users u,amis a WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=$id OR a.idRecipient =$id) AND u.id != $id) AND id != $id AND name LIKE '%".$user."%'";
    $exe = $ds->query($sql);
    $tab = $exe->fetchAll();
    if (empty($tab)) {
        echo json_encode("0");
    } else {
        echo json_encode($tab);
    }
}

if(isset($_GET['idSearchDiscussion'])){
    $discussion = $_GET['idSearchDiscussion'];
    $id = $_GET['idUserConnectD'];
    $sql = "SELECT d.id idDiscussion,d.idAmis,u.id idUser,u.name,u.profilPicture,m.id idMessage,m.idSpeaker,m.date,m.hour,m.readMsg,m.messageMsg FROM discussions d,amis a,users u,messages m WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=$id OR a.idRecipient =$id) AND u.id != $id AND d.idAmis = a.id AND m.id = d.idLastMessage AND u.name LIKE '%".$discussion."%' ORDER BY m.date DESC";
    $exe = $ds->query($sql);
    $tab = $exe->fetchAll();
    if (empty($tab)) {
        echo json_encode("0");
    } else {
        echo json_encode($tab);
    }
}

?>