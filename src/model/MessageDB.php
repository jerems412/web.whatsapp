<?php
namespace src\model;
use libs\system\Model;
require_once "libs/system/Model.php";
use Message;
use MessageImportant;
use User;
use Discussion;

class MessageDB extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //added message
    public function addMessage($idUser1,$idUser2,$idDiscussion,$msg)
    {
        $user1 = $this -> entityManager->getRepository(User::class)->find($idUser1);
        $user2 = $this -> entityManager->getRepository(User::class)->find($idUser2);
        $discussion = $this -> entityManager->getRepository(Discussion::class)->find($idDiscussion);
        $date = date('d-m-Y');
        $hour = date('H:i');
        $date = new \DateTime($date);
        $message = new Message();
        $message -> setDate($date);
        $message -> setHour($hour);
        $message -> setState(0);
        $message -> setIdRecipient($user2);
        $message -> setIdSpeaker($user1);
        $message -> setIdDiscussion($discussion);
        $message -> setRead(0);
        $message -> setdeleteSpeaker(0);
        $message -> setdeleteRecipient(0);
        $message -> setdeleteEverybody(0);
        $message -> setRead(0);
        $message -> setRead(0);
        $message -> setMessage($msg);
        $this -> entityManager -> persist($message);
        $this -> entityManager -> flush();
    }

    //added important message
    public function addImportantMessage($idUser,$idMessage)
    {
        $user = $this -> entityManager->getRepository(User::class)->find($idUser);
        $msg = $this -> entityManager->getRepository(Message::class)->find($idMessage);
        $message = new MessageImportant();
        $message -> setIdSpeaker($user);
        $message -> setIdMessage($msg);
        $this -> entityManager -> persist($message);
        $this -> entityManager -> flush();
    }

    //added message read
    public function ReadMessage($id,$idUser)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'UPDATE messages m SET m.readMsg = 1 WHERE m.idDiscussion = :idd AND m.idRecipient=:idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id,'idd1'=>$idUser]);
    }

    //list message 
    public function listMessages($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM messages WHERE idDiscussion = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //exist important message 
    public function existImportantMessage($idUser,$idMessage)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM messageImportants WHERE idSpeaker = :idd AND idMessage = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser,'idd1'=>$idMessage]);
        $tab = $result -> fetchAllAssociative();
        if($tab[0]){
            return true;
        }else{
            return false;
        }
    }

    //list message 
    public function listAllMessagesImportant($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT DISTINCT m.id,m.date,m.hour,m.idRecipient,m.idSpeaker,m.idDiscussion,m.messageMsg,m.deleteRecipient,m.deleteSpeaker,m.deleteEverybody,m.readMsg,mi.id idImportant,u.name,u.profilPicture FROM messages m,messageImportants mi,users u WHERE m.id = mi.idMessage AND (u.id = m.idSpeaker OR m.idRecipient = u.id AND m.idRecipient != :idd AND m.idSpeaker != :idd) AND mi.idSpeaker = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //list message 
    public function listMessagesSearch($id,$msg)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = "SELECT * FROM messages WHERE idDiscussion = :idd AND messageMsg LIKE '%".$msg."%'";
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //list all messages no read 
    public function listAllMessagesNoRead($idUser)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT count(id) nb FROM messages m WHERE m.idRecipient = :idd AND m.readMsg = 0';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser]);
        $tab = $result -> fetchAllAssociative();
        return $tab[0]['nb'];
    }

    //list messages no read 
    public function listMessagesNoRead($idUser,$idDiscussion)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT count(id) nb FROM messages m WHERE idRecipient = :idd AND m.readMsg = 0 AND m.idDiscussion = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser,'idd1'=>$idDiscussion]);
        $tab = $result -> fetchAllAssociative();
        return $tab[0]['nb'];
    }

    //delete for me 1 
    public function deleteForMe1($id)
    {
        $msg = $this -> entityManager->getRepository(Message::class)->find($id);
        $msg -> setDeleteSpeaker(1);
        $this -> entityManager -> persist($msg);
        $this -> entityManager -> flush();
    }

    //delete for me 2 
    public function deleteForMe2($id)
    {
        $msg = $this -> entityManager->getRepository(Message::class)->find($id);
        $msg -> setDeleteRecipient(1);
        $this -> entityManager -> persist($msg);
        $this -> entityManager -> flush();
    }

    //delete for everybody
    public function deleteForEverybody($id)
    {
        $msg = $this -> entityManager->getRepository(Message::class)->find($id);
        $msg -> setDeleteEverybody(1);
        $this -> entityManager -> persist($msg);
        $this -> entityManager -> flush();
    }

    //delete all for me
    public function deleteAllForMe($idDiscussion,$idUser)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 0';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'UPDATE messages SET deleteSpeaker = 1 WHERE idDiscussion = :idd AND idSpeaker = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $idDiscussion,'idd1' => $idUser]);
        $conn = $this -> entityManager -> getConnection();
        $sql = 'UPDATE messages SET deleteRecipient = 1 WHERE idDiscussion = :idd AND idRecipient = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $idDiscussion,'idd1' => $idUser]);
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
    }

    public function deleteMessageImportant($id) {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 0';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'DELETE FROM messageImportants WHERE id = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $id,]);
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
    }

}
?>