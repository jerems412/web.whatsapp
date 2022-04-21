<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title>Whatsapp <?php if($_SESSION['nbReadAll'] !=0){echo "(".$_SESSION['nbReadAll'].")";} ?></title>
    <!-- links -->
    <link rel="icon" href="<?php echo $url; ?>public/icon.ico" type="image/icon ico">
    <link rel="stylesheet" href="<?php echo $url; ?>public/SpaceUser/css/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo $url; ?>public/SpaceUser/css/<?php echo $_SESSION['userConnect']['theme']; ?>.css">
</head>

<body>
    <div class="container">
        <!-- discussion -->
        <div class="left" id="discussions">
            <div class="menu" id="menuLeft" style="display:none;margin-left: 15.5%;margin-top: 4%;position: fixed;">
                <a>Nouveau groupe</a>
                <a id="listImportantMessage">Messages important</a>
                <a id="listParametres">Parametres</a>
                <a href="<?php echo $url; ?>">Deconnexion</a>
            </div>
            <div class="top">
                <div class="leftTop">
                    <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $_SESSION['userConnect']['profilPicture']; ?>" alt="" id="imgProfil">
                </div>
                <div class="rightTop">
                    <i class="fa-solid fa-circle-notch"></i>
                    <i class="fa-solid fa-message" id="addDiscussion"></i>
                    <i class="fa fa-ellipsis-v" id="infos"></i>
                </div>
            </div>
            <div class="search">
                <div class="inputSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Rechercher ou demarrer une nouvelle discussion" onkeyup="SearchDiscussion(this,<?php echo $_SESSION['userConnect']['id']; ?>)">
                </div>
            </div>
            <div class="discussion" id="discussion">
                <?php
                foreach ($_SESSION['listDiscussions'] as $value) {
                ?>
                    <a onclick="printDiscussion(<?php echo $value['idDiscussion']; ?>)">
                        <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $value['profilPicture']; ?>" alt="">
                        <ul style="margin-left:-6%;">
                            <li style="<?php if($value['idSpeaker'] != $_SESSION['userConnect']['id']){if($value['readMsg']==0){echo "font-weight:bold;";}}?>"><?php echo $value['name']; ?></li>
                            <li style="<?php if($value['idSpeaker'] != $_SESSION['userConnect']['id']){if($value['readMsg']==0){echo "font-weight:bold;";}}?>"><?php if($value['idMessage'] != 1){if($value['idSpeaker']== $_SESSION['userConnect']['id']){if($value['readMsg'] == 0){echo'<i class="fa fa-check-double"></i>&nbsp&nbsp';}else{echo'<i class="fa fa-check-double" style="color:#49b1d7;"></i>&nbsp&nbsp';}}} ?><?php if(strlen($value['messageMsg']) >18){echo substr($value['messageMsg'],0,18)."...";}else{echo $value['messageMsg'];} ?></li>
                        </ul>
                        <ul style="margin-left: auto;margin-right:2%;text-align:right">
                            <li style="font-size:13px;<?php if($value['idSpeaker'] != $_SESSION['userConnect']['id']){if($value['readMsg']==0){echo "color:#00a884;";}}?>"><?php if($value['idMessage'] != 1){if($value['date'] == date("Y-m-d")){ echo $value['hour'];}else{echo $value['date'];}} ?></li>
                            <li style="font-size:12px;margin-top: 8%;<?php if($value['idSpeaker'] != $_SESSION['userConnect']['id']){if($value['readMsg'] == 0 && $value['idMessage'] != 1){echo "display:block;";}else{echo "display:none;";}}else{echo"display:none;";} ?>"><span class="noRead"><?php require_once "src/controller/SpaceUserController.php";$home = new SpaceUserController();echo $home -> listMessagesNoRead($_SESSION['userConnect']['id'],$value['idDiscussion']); ?></span></li>
                        </ul>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="discussion" id="discussion1" style="display:none;">
                
            </div>
        </div>
        <!-- add Friends -->
        <div class="left" id="addFriends" style="display: none;">
            <div class="topAddFriends">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa-solid fa-arrow-left" id="previewAddFriends"></i>
                &nbsp&nbsp&nbsp&nbsp
                <h3>Nouvelle discussion</h3>
            </div>
            <div class="searchAddFriends">
                <div class="inputSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Chercher des contacts" id="inputSearchUser" onkeyup="SearchUser(this,<?php echo $_SESSION['userConnect']['id']; ?>)">
                </div>
            </div>
            <div class="discussionAddFriends" id="discussionAddFriends">
                <?php
                foreach ($_SESSION['listNoFriends'] as $value) {
                ?>
                    <a onclick="addAmis(<?php echo $value['id'] ?>,'<?php echo $value['name']; ?>')">
                        <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $value['profilPicture']; ?>" alt="">
                        <ul style="margin-left:-6%;">
                            <li><?php echo $value['name']; ?></li>
                            <li><?php echo $value['actu']; ?></li>
                        </ul>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="discussionAddFriends" id="discussionAddFriends1" style="display:none;">
                
            </div>
        </div>
        <!-- important message -->
        <div class="left" id="importantMessage" style="display: none;">
            <div class="topImportantMessage">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa-solid fa-arrow-left" id="previewImportantMessage"></i>
                &nbsp&nbsp&nbsp&nbsp
                <h3>Messages importants</h3>
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa fa-ellipsis-v" style="margin-left: 25%;"></i>
            </div>
            <div class="discussionImportantMessage">
                <?php
                foreach ($_SESSION['listAllMessagesImportant'] as $value) {
                ?>
                    <div class="part1" onclick="deleteMessageImportant(<?php echo $value['idImportant']; ?>)" style="<?php if($value['idSpeaker'] == $_SESSION['userConnect']['id']){if($value['deleteSpeaker'] == 1){echo "display:none;";}}else{if($value['deleteRecipient'] == 1){echo "display:none;";}} ?>">
                        <div>
                            <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $value['profilPicture']; ?>" alt="">
                            <p><?php echo $value['name']; ?></p>
                        </div>
                        <div>
                            <a class="<?php if ($value['idSpeaker'] == $_SESSION['userConnect']['id']) {
                                    echo "sendIM";
                                } else {
                                    echo "receiveIM";
                                } ?>" style="<?php if($value['idSpeaker'] == $_SESSION['userConnect']['id']){if($value['deleteSpeaker'] == 1){echo "display:none;";}}else{if($value['deleteRecipient'] == 1){echo "display:none;";}} ?>">
                            <?php if($value['deleteEverybody'] == 1){echo "<i>Ce message a ete supprime</i>";}else{echo $value['messageMsg'];} ?>
                            <br><span><?php if($value['date'] == date("Y-m-d")){ echo $value['hour'];}else{echo $value['date'];} ?>&nbsp<?php if($value['idSpeaker']== $_SESSION['userConnect']['id']){if($value['readMsg'] == 0){echo'<i class="fa fa-check-double"></i>';}else{echo'<i class="fa fa-check-double" style="color:#49b1d7;"></i>';}} ?></span>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <!-- profil -->
        <div class="left" id="profil" style="display:none">
            <div class="topParametres">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa-solid fa-arrow-left" id="previewProfil"></i>
                &nbsp&nbsp&nbsp&nbsp
                <h3>Profil</h3>
            </div>
            <div class="searchProfil">
                <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $_SESSION['userConnect']['profilPicture']; ?>" alt="">
                <input type="file" name="" id="" accept=".jpg,.jpeg,.png" onchange="updatePicture(this)">
            </div>
            <div class="discussion1Profil">
                <label for="">Votre Nom</label><i class="fa-solid fa-pen" style="margin-left: 66.4%;"></i>
                <input type="text" name="" id="" maxlength="10" minlength="4" value="<?php echo $_SESSION['userConnect']['name']; ?>" onblur="updateName(this)">
            </div>
            <div class="discussion1Profil">
                <label for="">Actu</label><i class="fa-solid fa-pen" style="margin-left: 75%;"></i>
                <input type="text" name="" id="" value="<?php echo $_SESSION['userConnect']['actu']; ?>" onblur="updateActu(this)">
            </div>
        </div>
        <!-- parametres -->
        <div class="left" id="parametres" style="display: none;">
            <div class="topParametres">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa-solid fa-arrow-left" id="previewParametres"></i>
                &nbsp&nbsp&nbsp&nbsp
                <h3>Parametres</h3>
            </div>
            <div class="searchParametres">
                <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $_SESSION['userConnect']['profilPicture']; ?>" alt="">
                <ul>
                    <li><?php echo $_SESSION['userConnect']['name']; ?></li>
                    <li><?php echo $_SESSION['userConnect']['actu']; ?></li>
                </ul>
            </div>
            <div class="discussionParametres">
                <a>
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <ul>
                        <li>Notifications</li>
                    </ul>
                </a>
                <a>
                    <i class="fa-solid fa-lock"></i>
                    <ul>
                        <li>Confidentialite</li>
                    </ul>
                </a>
                <a>
                    <i class="fa fa-shield" aria-hidden="true"></i>
                    <ul>
                        <li>Securite</li>
                    </ul>
                </a>
                <a onclick="changeTheme()">
                    <i class="fa-solid fa-sun"></i>
                    <ul>
                        <li>Theme</li>
                    </ul>
                </a>
                <a>
                    <i class="fa-regular fa-image"></i>
                    <ul>
                        <li>Fond d'ecran de la discussion</li>
                    </ul>
                </a>
                <a>
                    <i class="fa-solid fa-sun"></i>
                    <ul>
                        <li>Raccourcis clavier</li>
                    </ul>
                </a>
                <a>
                    <i class="fa-solid fa-circle-question"></i>
                    <ul>
                        <li>Aide</li>
                    </ul>
                </a>
            </div>
        </div>
        <!-- right -->
        <div class="right" id="right" style="<?php if($_SESSION['nbConnect'] == -2 || $_SESSION['userDiscussions'] == null){echo "display: none;"; } ?>">
            <div class="menu" id="menuRight" style="display: none;margin-left: 46%;margin-top: 4%;position: fixed;">
                <a id="pressInfosContact">Infos du contact</a>
                <a>Selectionner des messages</a>
                <a id="closeDiscussion">Fermer la discussion</a>
                <a>Notification en mode silencieux</a>
                <a onclick="deleteAllForMe(1)">Effacer les messages</a>
                <a onclick="deleteAmis('<?php echo $_SESSION['userDiscussions']['name']; ?>')">Supprimer la discussion</a>
            </div>
            <div class="top">
                <div class="leftTop">
                    <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $_SESSION['userDiscussions']['profilPicture']; ?>" alt="" id="pressInfosContactIMG">
                    <ul>
                        <li style="width: 150px;"><?php echo $_SESSION['userDiscussions']['name']; ?></li>
                        <li style="font-size: 12px;width: 50px;<?php if($_SESSION['blockYesNo'] ==true || $_SESSION['blockYesNo1'] ==true){echo "display:none;"; } ?>"><?php if($_SESSION['userDiscussions']['actif'] == 1){echo"En ligne";} ?></li>
                    </ul>
                </div>
                <div class="rightTop">
                    <i class="fa-solid fa-magnifying-glass" id="pressSearchRight"></i>
                    <i class="fa fa-ellipsis-v" id="infosRight"></i>
                </div>
            </div>
            <div class="messages" id="messagesRight" style="<?php if($_SESSION['blockYesNo'] ==true){echo "display:none;"; } ?>">
                <?php
                $cpt = -1;
                $cpt1 = -1;
                    foreach ($_SESSION['messageDiscussion'] as $value) {
                ?>
                    <a class="<?php if ($value['idSpeaker'] == $_SESSION['userConnect']['id']) {
                                    echo "send";
                                    $cpt++;
                                } else {
                                    echo "receive";
                                    $cpt1++;
                                } ?>" style="<?php if($value['idSpeaker'] == $_SESSION['userConnect']['id']){if($value['deleteSpeaker'] == 1){echo "display:none;";}}else{if($value['deleteRecipient'] == 1){echo "display:none;";}} ?>">
                        <?php if($value['deleteEverybody'] == 1){echo "<i>Ce message a ete supprime</i>";}else{echo $value['messageMsg'];} ?>
                        <br><span><?php if($value['date'] == date("Y-m-d")){ echo $value['hour'];}else{echo $value['date'];} ?>&nbsp<?php if($value['idSpeaker']== $_SESSION['userConnect']['id']){if($value['readMsg'] == 0){echo'<i class="fa fa-check-double"></i>';}else{echo'<i class="fa fa-check-double" style="color:#49b1d7;"></i>';}} ?></span>
                    </a>
                    <?php
                        if($value['idSpeaker'] == $_SESSION['userConnect']['id']){
                    ?>
                    <div class="menu" id="menuMessage<?php echo $cpt; ?>" style="display: none;margin-left: 10%;margin-top: 10%;">
                        <a <?php if($value['deleteEverybody'] == 0){ ?> onclick="markImportantMessage(<?php echo $value['id']; ?>)" <?php } ?>>Marquer comme important</a>
                        <a onclick="deleteForMe1(<?php echo $value['id']; ?>)">Supprimer message pour moi</a>
                        <a onclick="deleteForEverybody(<?php echo $value['id']; ?>)">Supprimer message pour tous</a>
                    </div>
                    <?php
                        }else{
                    ?>
                    <div class="menu" id="menuMessagess<?php echo $cpt1; ?>" style="display: none;margin-left: 10%;margin-top: 10%;">
                        <a <?php if($value['deleteEverybody'] == 0){ ?> onclick="markImportantMessage(<?php echo $value['id']; ?>)" <?php } ?>>Marquer comme important</a>
                        <a onclick="deleteForMe2(<?php echo $value['id']; ?>)">Supprimer message pour moi</a>
                    </div>
                    <?php
                        }
                    ?>
                <?php
                }
                ?>
            </div>
            <!-- emoji -->
            <div class="emojis" id="emojis" style="display:none;">
                <?php
                for ($i = 127757; $i < 128721; $i++) {
                ?>
                    <button class="emoji"><?php echo "&#" . $i; ?></button>
                <?php
                }
                ?>
            </div>
            <div class="bottom">
                <i class="fa-solid fa-face-smile" id="pressEmoji"></i>
                <input type="text" name="message" id="writeMessage" placeholder="Taper un message">
                <i class="fa-solid fa-microphone" id="send" <?php if($_SESSION['blockYesNo'] != true){echo 'onclick="addMessage('.$_SESSION['userDiscussions']['id'].',writeMessage)"'; } ?>></i>
            </div>
        </div>
        <!-- infos contact -->
        <div class="infosContact" id="infosContact" style="display:none;">
            <div class="topinfosContact">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa fa-times" id="previewinfosContact"></i>
                &nbsp&nbsp&nbsp&nbsp
                <p>Infos du contact</p>
            </div>
            <div class="contentIC">
                <div class="part1">
                    <img src="<?php echo $url; ?>public/SpaceUser/img/<?php echo $_SESSION['userDiscussions']['profilPicture']; ?>" alt="">
                    <ul>
                        <li><?php echo $_SESSION['userDiscussions']['name']; ?></li>
                        <li>+221 <?php echo $_SESSION['userDiscussions']['phoneNumber']; ?></li>
                    </ul>
                </div>
                <div class="part2">
                    <ul>
                        <li>Actu</li>
                        <li style="font-size: 15px;"><?php echo $_SESSION['userDiscussions']['actu']; ?></li>
                    </ul>
                </div>
                <div class="part3">
                    <ul>
                        <li>Medias, liens et documents</li>
                        <li style="font-size: 15px;">Mes documents...</li>
                    </ul>
                </div>
                <div class="part4">
                    <ul>
                        <li><i class="fa-solid fa-star"></i> Messages importants</li>
                    </ul>
                </div><br>
                <div class="part5">
                    <ul>
                        <li><i class="fa fa-bell" aria-hidden="true"></i> Notifications en mode silencieux</li>
                    </ul>
                </div>
                <div class="part5">
                    <ul>
                        <li><i class="fa fa-shield" aria-hidden="true"></i> Messages ephemeres</li>
                        <li>Desactives</li>
                    </ul>
                </div>
                <div class="part5">
                    <ul>
                        <li><i class="fa-solid fa-lock"></i> Chiffrement</li>
                        <li>Les messages sont chiffres de bout en bout. Cliquez pour confirmer.</li>
                    </ul>
                </div><br>
                <div class="part6" onclick="blockUser('<?php if($_SESSION['blockYesNo1'] ==true){echo ' debloquer '.$_SESSION['userDiscussions']['name']; }else{echo ' bloquer '.$_SESSION['userDiscussions']['name'];} ?>',<?php echo $_SESSION['userDiscussions']['id']; ?>)">
                    <ul>
                        <li><i class="fa-solid fa-ban"></i><?php if($_SESSION['blockYesNo1'] ==true){echo " Debloquer"; }else{echo " Bloquer";} ?> <?php echo $_SESSION['userDiscussions']['name']; ?></li>
                    </ul>
                </div>
                <div class="part6" onclick="addNbAlert('<?php echo $_SESSION['userDiscussions']['name']; ?>')">
                    <ul>
                        <li><i class="fa-solid fa-thumbs-down"></i> Signaler <?php echo $_SESSION['userDiscussions']['name']; ?></li>
                    </ul>
                </div>
                <div class="part7" onclick="deleteAmis('<?php echo $_SESSION['userDiscussions']['name']; ?>')">
                    <ul>
                        <li><i class="fa-solid fa-trash"></i> Supprimer <?php echo $_SESSION['userDiscussions']['name']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Search message -->
        <div class="searchMessageIC" id="searchMessageIC" style="display:none;">
            <div class="topSearchMessageIC">
                &nbsp&nbsp&nbsp&nbsp
                <i class="fa fa-times" id="previewSearchMessageIC"></i>
                &nbsp&nbsp&nbsp&nbsp
                <p>Rechercher des messages</p>
            </div>
            <div class="searchIC">
                <div class="inputSearchIC">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="writeSeachRigh" placeholder="Recherche..." onkeyup="SearchMessage(this,<?php echo $_SESSION['idDiscussionInProccess']; ?>)">
                </div>
            </div>
            <div class="discussionSearchIC" id="discussionSearchIC">
                    <a>
                        <ul style="margin-left:-6%;">
                            <li>Name</li>
                            <li style="font-size:14px;">message...</li>
                        </ul>
                        <ul style="margin-left: auto;margin-right:2%;text-align:right">
                            <li style="font-size:12px;">Hier</li>
                        </ul>
                    </a>
            </div>
        </div>
    </div>
    <script src="<?php echo $url; ?>public/SpaceUser/js/SpaceUser.js"></script>
    <script src="<?php echo $url; ?>public/ajax/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $url; ?>public/ajax/discussion.js"></script>
    <?php require_once "src/ajax/discussion.php"; ?>
    <?php require_once "src/ajax/searchMsg.php"; ?>
</body>

</html>