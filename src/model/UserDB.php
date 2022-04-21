<?php
namespace src\model;
use libs\system\Model;
require_once "libs/system/Model.php";
use User;
use Statut;

class UserDB extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
  
    //ajout user
    public function addUser($name,$phone,$password,$actu,$profil)
    {
        $user = new User;
        $user -> setName($name);
        $user -> setPhoneNumber($phone);
        $user -> setPassword(md5($password));
        $user -> setActu($actu);
        $user -> setProfilPicture($profil);
        $user -> setTheme("dark");
        $user -> setState(0);
        $user -> setNbAlert(0);
        $user -> setActif(0);
        $this -> entityManager -> persist($user);
        $this -> entityManager -> flush();
    }

    public function deleteStatut($idUser,$idUser1) {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 0';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'DELETE FROM statuts WHERE idSpeaker = :idd AND idRecipient = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser, 'idd1' => $idUser1]);
        //ok
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SET FOREIGN_KEY_CHECKS = 1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery();
    }

    //ajout Statut
    public function addStatut($idUser,$idUser1)
    {
        $user1 = $this -> entityManager->getRepository(User::class)->find($idUser);
        $user2 = $this -> entityManager->getRepository(User::class)->find($idUser1);
        $statut = new Statut;
        $statut -> setIdSpeaker($user1);
        $statut -> setIdRecipient($user2);
        $this -> entityManager -> persist($statut);
        $this -> entityManager -> flush();
    }

    //statut exist
    public function statutExist($idUser,$idUser1)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM statuts WHERE idSpeaker = :idd AND idRecipient = :idd1';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser, 'idd1' => $idUser1]);
        $tab = $result -> fetchAllAssociative();
        if($tab)
        {
            return true;
        }else
        {
            return false;
        }
    }

    //statut exist
    public function statutExist1($idUser,$idUser1)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM statuts WHERE idSpeaker = :idd1 AND idRecipient = :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$idUser, 'idd1' => $idUser1]);
        $tab = $result -> fetchAllAssociative();
        if($tab)
        {
            return true;
        }else
        {
            return false;
        }
    }

    //modifier mot de passe
    public function updatemdp($id,$modif)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setPassword(md5($modif));
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update actif
    public function updateActif1($id)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setActif(1);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update actif
    public function updateActif2($id)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setActif(0);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update nbAlert
    public function updateNbAlert($id)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setNbAlert($user -> getNbAlert()+1);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update Name
    public function updateName($id,$name)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setName($name);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update Actu
    public function updateActu($id,$actu)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setActu($actu);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update Picture
    public function updatePicture($id,$Picture)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        $user->setProfilPicture($Picture);
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //update actif
    public function theme($id)
    {
        //update
        $user = $this -> entityManager->getRepository(User::class)->find($id);
        if($user -> getTheme() == "dark"){
            $user->setTheme("clair");
        }else{
            $user->setTheme("dark");
        }
        $this -> entityManager -> persist($user);
        $this -> entityManager->flush();
    }

    //user exist
    public function userExist($identifiant,$mdp)
    {
        $mdp = md5($mdp);
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM users WHERE phoneNumber=:idd AND password=:mdp AND nbAlert < 5';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$identifiant, 'mdp' => $mdp]);
        $tab = $result -> fetchAllAssociative();
        if($tab)
        {
            return $tab[0];
        }else
        {
            return false;
        }
    }

    //user exist id
    public function userExistId($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM users WHERE id=:idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        if($tab)
        {
            return $tab[0];
        }else
        {
            return false;
        }
    }

    //user exist1
    public function userExist1($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM users WHERE phoneNumber=:idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        if($tab)
        {
            return true;
        }else
        {
            return false;
        }
    }

    //list friends
    public function listFriends($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM users u,amis a WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=:idd OR a.idRecipient =:idd) AND u.id != :idd';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //list friends 
    public function listNoFriends($id)
    {
        $conn = $this -> entityManager -> getConnection();
        $sql = 'SELECT * FROM users WHERE id NOT IN (SELECT u.id FROM users u,amis a WHERE (a.idSpeaker=u.id OR a.idRecipient =u.id) AND (a.idSpeaker=:idd OR a.idRecipient =:idd) AND u.id != :idd) AND id != :idd;';
        $stmt = $conn -> prepare($sql);
        $result = $stmt -> executeQuery(['idd'=>$id]);
        $tab = $result -> fetchAllAssociative();
        return $tab;
    }

    //modifier user
    public function updateUser()
    {
        //update
        //$user = $this -> entityManager->getRepository(User::class)->find($id1);
    }
}




?>