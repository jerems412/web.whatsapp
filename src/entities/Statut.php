<?php
// src/entities/Statut.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="statuts")
 */

class Statut
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * One statut have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userStatut1")
     *@ORM\JoinColumn(name="idRecipient", referencedColumnName="id")
     */
    private $idRecipient;
    /**
     * One statut have One user. This is the owning side.
     *@ORM\ ManyToOne(targetEntity="User", inversedBy="userStatut2")
     *@ORM\JoinColumn(name="idSpeaker", referencedColumnName="id")
     */
    private $idSpeaker;
    
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