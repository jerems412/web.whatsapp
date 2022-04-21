<?php
use libs\system\Controller;
use src\model\UserDB;
use src\model\AmisDB;
use src\model\MessageDB;

require_once "libs/system/Controller.php";

class SpaceUserController extends Controller
{
    private $user;
    private $amis;
    private $message;
    public function __construct() {
        parent::__construct();
        $this -> user = new UserDB();
        $this -> amis = new AmisDB();
        $this -> message = new MessageDB();
    }

    //page SpaceUser
    public function SpaceUser () {
        $_SESSION['nbReadAll'] = $this -> message -> listAllMessagesNoRead($_SESSION['userConnect']['id']);
        $_SESSION['listNoFriends'] = $this -> user -> listNoFriends($_SESSION['userConnect']['id']);
        $_SESSION['listDiscussions'] = $this -> amis -> listDiscussions($_SESSION['userConnect']['id']);
        $_SESSION['listAllMessagesImportant'] = $this->message-> listAllMessagesImportant($_SESSION['userConnect']['id']);
        if($_SESSION['nbConnect'] ==0){
            $_SESSION['messageDiscussion'] = $this->listMessages($_SESSION['idDiscussionInProccess']);
            $_SESSION['userDiscussions'] = $this->UserDiscussions($_SESSION['userConnect']['id'], $_SESSION['idDiscussionInProccess']);
            $_SESSION['blockYesNo'] = $this -> user -> statutExist1($_SESSION['userConnect']['id'],$_SESSION['userDiscussions']['id']);
            $_SESSION['blockYesNo1'] = $this -> user -> statutExist($_SESSION['userConnect']['id'],$_SESSION['userDiscussions']['id']);
        }
        return $this->view->load("SpaceUser/SpaceUser");
    }

    //messages
    public function listMessages ($id) {
        return $this->message-> listMessages($id);
    }

    //UserDiscussions
    public function UserDiscussions ($id,$id2) {
        return $this->amis-> UserDiscussions($id,$id2);
    }

    //theme
    public function theme ($id) {
        return $this->user-> theme($id);
    }

    //userExistId
    public function userExistId ($id) {
        return $this->user-> userExistId($id);
    }

    //addAmis
    public function addAmis($idUser1,$idUser2) {
        return $this->amis-> addAmis($idUser1,$idUser2);
    }

    //addDiscussion
    public function addDiscussion() {
        return $this->amis-> addDiscussion();
    }

    //ReadMessage
    public function ReadMessage($id,$idUser) {
        return $this->message-> ReadMessage($id,$idUser);
    }

    //listMessagesNoRead
    public function listMessagesNoRead($idUser,$idDiscussion) {
        return $this->message-> listMessagesNoRead($idUser,$idDiscussion);
    }

    //added discussion last messagge
    public function addDiscussionLastMSG($idDiscussion)
    {
        return $this->amis-> addDiscussionLastMSG($idDiscussion);
    }

    //added message
    public function addMessage($idUser1,$idUser2,$idDiscussion,$msg)
    {
        return $this->message->addMessage($idUser1,$idUser2,$idDiscussion,$msg);
    }

    //update nbAlert
    public function updateNbAlert($id)
    {
        return $this->user-> updateNbAlert($id);
    }

    //deleteDiscussionAndAmis
    public function deleteDiscussionAndAmis($idUser1,$idUser2,$idDiscussion)
    {
        return $this->amis-> deleteDiscussionAndAmis($idUser1,$idUser2,$idDiscussion);
    }

    //updateName
    public function updateName($id,$name)
    {
        return $this->user-> updateName($id,$name);
    }

    //updateActu
    public function updateActu($id,$actu)
    {
        return $this->user-> updateActu($id,$actu);
    }

    //updatePicture
    public function updatePicture($id,$picture)
    {
        return $this->user-> updatePicture($id,$picture);
    }

    //delete for me 1 
    public function deleteForMe1($id)
    {
        return $this->message-> deleteForMe1($id);
    }

    //delete for me 2 
    public function deleteForMe2($id)
    {
        return $this->message-> deleteForMe2($id);
    }

    //delete for everybody
    public function deleteForEverybody($id)
    {
        return $this->message-> deleteForEverybody($id);
    }

    //delete all for me
    public function deleteAllForMe($idDiscussion,$idUser)
    {
        return $this->message-> deleteAllForMe($idDiscussion,$idUser);
    }

    //list message 
    public function listMessagesSearch($id,$msg)
    {
        return $this->message-> listMessagesSearch($id,$msg);
    }

    //added important message
    public function addImportantMessage($idUser,$idMessage)
    {
        return $this->message-> addImportantMessage($idUser,$idMessage);
    }

    //added important message
    public function deleteMessageImportant($id)
    {
        return $this-> message-> deleteMessageImportant($id);
    }

    //exist important message 
    public function existImportantMessage($idUser,$idMessage)
    {
        return $this-> message-> existImportantMessage($idUser,$idMessage);
    }

    //ajout Statut
    public function addStatut($idUser,$idUser1)
    {
        return $this->user-> addStatut($idUser,$idUser1);
    }

    //user exist
    public function statutExist($idUser,$idUser1)
    {
        return $this->user-> statutExist($idUser,$idUser1);
    }

    //user exist
    public function statutExist1($idUser,$idUser1)
    {
        return $this->user-> statutExist1($idUser,$idUser1);
    }

    //delete statut
    public function deleteStatut($idUser,$idUser1)
    {
        return $this->user-> deleteStatut($idUser,$idUser1);
    }
}