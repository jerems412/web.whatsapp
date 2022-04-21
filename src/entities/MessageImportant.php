<?php
// src/entities/MessageImportant.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="messageImportants")
 */

class MessageImportant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * One messageImportant have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userMessageImportant")
     *@ORM\JoinColumn(name="idSpeaker", referencedColumnName="id")
     */
    private $idSpeaker;
    /**
     * One messageImportant have One message. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="Message", inversedBy="messageMessageImportant")
     *@ORM\JoinColumn(name="idMessage", referencedColumnName="id")
     */
    private $idMessage;
    
    public function __construct(){
        $this -> idSpeaker = new ArrayCollection();
        $this -> idMessage = new ArrayCollection();
    }

    //setters

    public function setId($id){
        $this ->id = $id; 
    } 
    
    public function setIdSpeaker($idSpeaker){
        $this ->idSpeaker = $idSpeaker; 
    }

    public function setIdMessage($idMessage){
        $this ->idMessage = $idMessage; 
    }

    
    //guetters

    public function getId(){
        return $this ->id; 
    }

}