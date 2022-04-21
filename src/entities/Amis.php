<?php
// src/entities/Amis.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="amis")
 */

class Amis
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * One amis have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userAmis1")
     *@ORM\JoinColumn(name="idRecipient", referencedColumnName="id")
     */
    private $idRecipient;
    /**
     * One amis have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userAmis2")
     *@ORM\JoinColumn(name="idSpeaker", referencedColumnName="id")
     */
    private $idSpeaker;

    //foreig keys

    /** One Amis have Many Discussions.
     * @ORM\OneToMany(targetEntity="Discussion", mappedBy="amis")
     */
    private $amisDiscussion;
    
    public function __construct(){
        $this -> idRecipient = new ArrayCollection();
        $this -> idSpeaker = new ArrayCollection();
    }

    //setters

    public function setId($id){
        $this ->id = $id; 
    } 

    public function setIdRecipient($idRecipient){
        $this ->idRecipient = $idRecipient; 
    }
    
    public function setIdSpeaker($idSpeaker){
        $this ->idSpeaker = $idSpeaker; 
    }
    
    //guetters

    public function getId(){
        return $this ->id; 
    }

}