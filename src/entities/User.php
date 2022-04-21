<?php
// src/entities/User.php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="users", uniqueConstraints={@UniqueConstraint(name="search_idx", columns={"phoneNumber"})})
 */

class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     */
    private $phoneNumber;
    /**
     * @ORM\Column(type="string")
     */
    private $theme;
    /**
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string")
     */
    private $actu;
    /**
     * @ORM\Column(type="integer")
     */
    private $actif;
    /**
     * @ORM\Column(type="string")
     */
    private $state;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbAlert;
    /**
     * @ORM\Column(type="string")
     */
    private $profilPicture;
    
    //foreign keys

    /** One user have Many Amis.
     * @ORM\OneToMany(targetEntity="Amis", mappedBy="users")
     */
    private $userAmis1;
    /** One user have Many Amis.
     * @ORM\OneToMany(targetEntity="Amis", mappedBy="users")
     */
    private $userAmis2;
    /** One user have Many message.
     * @ORM\OneToMany(targetEntity="Message", mappedBy="users")
     */
    private $userMessage1;
    /** One user have Many message.
     * @ORM\OneToMany(targetEntity="Message", mappedBy="users")
     */
    private $userMessage2;
    /** One user have Many statut.
     * @ORM\OneToMany(targetEntity="Statut", mappedBy="users")
     */
    private $userStatut1;
    /** One user have Many statut.
     * @ORM\OneToMany(targetEntity="Statut", mappedBy="users")
     */
    private $userStatut2;
    /** One user have Many messageImportant.
     * @ORM\OneToMany(targetEntity="MessageImportant", mappedBy="users")
     */
    private $userMessageImportant;
    
    public function __construct(){

    }

    //setters

    public function setId($id){
        $this ->id = $id; 
    } 

    public function setActif($actif){
        $this ->actif = $actif; 
    } 

    public function setName($name){
        $this ->name = $name; 
    } 

    public function setPhoneNumber($phoneNumber){
        $this ->phoneNumber = $phoneNumber; 
    } 

    public function setTheme($theme){
        $this ->theme = $theme; 
    } 

    public function setPassword($password){
        $this ->password = $password; 
    } 

    public function setActu($actu){
        $this ->actu = $actu; 
    } 

    public function setState($state){
        $this ->state = $state; 
    } 

    public function setNbAlert($nbAlert){
        $this ->nbAlert = $nbAlert; 
    } 

    public function setProfilPicture($profilPicture){
        $this ->profilPicture = $profilPicture; 
    } 

    
    //guetters

    public function getId(){
        return $this ->id; 
    }

    public function getTheme(){
        return $this ->theme; 
    }

    public function getNbAlert(){
        return $this ->nbAlert; 
    }

    public function getActu(){
        return $this ->actu; 
    }

    public function getName(){
        return $this ->name; 
    }

}