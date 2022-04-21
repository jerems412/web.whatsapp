<?php
// src/entities/Message.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 */

class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="date")
     */
    private $date;
    /**
     * @ORM\Column(type="string")
     */
    private $hour;
    /**
     * @ORM\Column(type="string")
     */
    private $messageMsg;
    /**
     * @ORM\Column(type="integer")
     */
    private $readMsg;
    /**
     * @ORM\Column(type="integer")
     */
    private $state;
    /**
     * @ORM\Column(type="integer")
     */
    private $deleteSpeaker;
    /**
     * @ORM\Column(type="integer")
     */
    private $deleteRecipient;
    /**
     * @ORM\Column(type="integer")
     */
    private $deleteEverybody;
    /**
     * One message have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userMessage1")
     *@ORM\JoinColumn(name="idRecipient", referencedColumnName="id")
     */
    private $idRecipient;
    /**
     * One message have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userMessage2")
     *@ORM\JoinColumn(name="idSpeaker", referencedColumnName="id")
     */
    private $idSpeaker;
    /**
     * One message have One discussion. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="Discussion", inversedBy="discussionMessage")
     *@ORM\JoinColumn(name="idDiscussion", referencedColumnName="id")
     */
    private $idDiscussion;

    //foreign keys

    /** One message have Many discussion.
     * @ORM\OneToMany(targetEntity="Discussion", mappedBy="messages")
     */
    private $messageDiscussion;
    /** One message have Many messageImportant.
     * @ORM\OneToMany(targetEntity="MessageImportant", mappedBy="messages")
     */
    private $messageMessageImportant;
    
    
    public function __construct(){
        $this -> idRecipient = new ArrayCollection();
        $this -> idSpeaker = new ArrayCollection();
        $this -> idDiscussion = new ArrayCollection();
    }

    //setters

    public function setId($id){
        $this ->id = $id; 
    }
    
    public function setDate($date){
        $this ->date = $date; 
    }

    public function setMessage($messageMsg){
        $this ->messageMsg = $messageMsg; 
    }

    public function setHour($hour){
        $this ->hour = $hour; 
    }

    public function setState($state){
        $this ->state = $state; 
    }

    public function setIdRecipient($idRecipient){
        $this ->idRecipient = $idRecipient; 
    }
    
    public function setIdSpeaker($idSpeaker){
        $this ->idSpeaker = $idSpeaker; 
    }

    public function setIdDiscussion($idDiscussion){
        $this ->idDiscussion = $idDiscussion; 
    }

    public function setRead($readMsg){
        $this ->readMsg = $readMsg; 
    }

    public function setDeleteSpeaker($deleteSpeaker){
        $this ->deleteSpeaker = $deleteSpeaker; 
    }

    public function setDeleteRecipient($deleteRecipient){
        $this ->deleteRecipient = $deleteRecipient; 
    }

    public function setDeleteEverybody($deleteEverybody){
        $this ->deleteEverybody = $deleteEverybody; 
    }

    //guetters

    public function getId(){
        return $this ->id; 
    }

}