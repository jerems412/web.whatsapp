<?php
// src/entities/Discussion.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="discussions")
 */

class Discussion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * One discussion have One amis. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="Amis", inversedBy="amisDiscussion")
     *@ORM\JoinColumn(name="idAmis", referencedColumnName="id")
     */
    private $idAmis;
    /**
     * One discussion have One message. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="Message", inversedBy="messageDiscussion")
     *@ORM\JoinColumn(name="idLastMessage", referencedColumnName="id")
     */
    private $idLastMessage;

    //foreign keys

    /** One user have Many message.
     * @ORM\OneToMany(targetEntity="Message", mappedBy="discussions")
     */
    private $discussionMessage;
    
    public function __construct(){
        $this -> idAmis = new ArrayCollection();
        $this -> idLastMessage = new ArrayCollection();
    }

    //setters

    public function setId($id){
        $this ->id = $id; 
    }
    
    public function setIdAmis($idAmis){
        $this ->idAmis = $idAmis; 
    }

    public function setIdLastMessage($idLastMessage){
        $this ->idLastMessage = $idLastMessage; 
    }

    
    //guetters

    public function getId(){
        return $this ->id; 
    }

}