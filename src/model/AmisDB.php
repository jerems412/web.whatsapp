<?php
namespace src\model;
use libs\system\Model;
require_once "libs/system/Model.php";
use Amis;
use Message;
use Discussion;
use User;

class AmisDB extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //added Friends
    public function addAmis($idUser1,$idUser2)
    {
        $user1 = $this -> entityManager->getRepository(User::class)->find($idUser1);
        $user2 = $this -> entityManager->getRepository(User::class)->find($idUser2);
        $amis = new Amis();
        $amis -> setIdSpeaker($user1);
        $amis -> setIdRecipient($user2);
        $this -> entityManager -> persist($amis);
        $this -> entityManager -> flush();
    }

    //added discussion
    public function addDiscussion()
    {
        $amis = $this -> entityManager->getRepository(Amis::class)->find($this->maxAmis());
        $msg = $this -> entityManager->getRepository(Message::class)->find(1);
        $discussion = new Discussion();
        $discussion -> setIdLastMessage($msg);
        $discussion -> setIdAmis($amis);
        $this -> entityManager -> persist($discussion);
        $this -> entityManager -> flush();
    }

    public function maxMessage()
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT id FROM messages WHERE id = (SELECT MAX(id) FROM messages)';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        $tab = $result -> fetchAllAssociative();
        return $tab[0]['id'];
    }

    //added discussion last messagge
    public function addDiscussionLastMSG($idDiscussion)
    {
        $msg = $this -> entityManager->getRepository(Message::class)->find($this -> maxMessage());
        $discussion =  $this -> entityManager->getRepository(Discussion::class)->find($idDiscussion);
        $discussion -> setIdLastMessage($msg);
        $this -> entityManager -> persist($discussion);
        $this -> entityManager -> flush();
    }

    //delete discussion and amis
    public function deleteDiscussionAndAmis($idUser1,$idUser2,$idDiscussion)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 0';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'DELETE FROM discussions WHERE id = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $idDiscussion]);
        $conn = $this -> entityManager -> getConnection();
        $sql = 'DELETE FROM messages WHERE idDiscussion = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $idDiscussion]);
        $conn = $this -> entityManager -> getConnection();
        $sql = 'DELETE FROM amis WHERE (idSpeaker = :idd AND idRecipient = :idd1) OR (idSpeaker = :idd1 AND idRecipient = :idd)';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd' => $idUser1,'idd1'=> $idUser2]);
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
    }

    public function maxAmis()
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT id FROM amis WHERE id = (SELECT MAX(id) FROM amis)';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        $tab = $result -> fetchAllAssociative();
        return $tab[0]['id'];
    }

    //list discussion 
    public function listDiscussions($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT d.id idDiscussion,d.idAmis,u.id idUser,u.name,u.profilPicture,m.id idMessage,m.idSpeaker,m.date,m.hour,m.readMsg,m.messageMsg FROM discussions d,amis a,users u,messages m WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=:idd OR a.idRecipient =:idd) AND u.id != :idd AND d.idAmis = a.id AND m.id = d.idLastMessage ORDER BY m.date DESC';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //list user discussion 
    public function UserDiscussions($idUser,$idDiscussion)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT u.id,u.name,u.phoneNumber,u.actu,u.profilPicture,u.actif FROM users u,discussions d,amis a WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=:idd OR a.idRecipient =:idd) AND u.id != :idd AND d.idAmis = a.id AND d.id=:idd1 AND u.id != :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser,'idd1'=>$idDiscussion]);
        $tab = $result -> fetchAllAssociative();
        if(isset($tab[0])){
            return $tab[0];
        }else {
            return array();
        }
    }
}




?>