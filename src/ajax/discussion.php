<?php

if(isset($_GET['idPrintDiscussion'])){
    $_SESSION['nbConnect'] =0;
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $_SESSION['messageDiscussion'] = $home -> listMessages($_GET['idPrintDiscussion']);
    $home -> ReadMessage($_GET['idPrintDiscussion'],$_SESSION['userConnect']['id']);
    $_SESSION['userDiscussions'] = $home -> UserDiscussions($_SESSION['userConnect']['id'],$_GET['idPrintDiscussion']);
    $_SESSION['idDiscussionInProccess'] = $_GET['idPrintDiscussion'];
}

if(isset($_GET['idChangeTheme'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home -> theme($_SESSION['userConnect']['id']);
    $_SESSION['userConnect'] = $home -> userExistId($_SESSION['userConnect']['id']);
}


if(isset($_GET['idaddAmis'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home -> addAmis($_SESSION['userConnect']['id'],$_GET['idaddAmis']);
    $home -> addDiscussion();
}

if(isset($_GET['idaddMessage'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home -> addMessage($_SESSION['userConnect']['id'],$_GET['idaddMessage'],$_SESSION['idDiscussionInProccess'],$_GET['message']);
    $home -> addDiscussionLastMSG($_SESSION['idDiscussionInProccess']);
    $home -> ReadMessage($_SESSION['idDiscussionInProccess'],$_SESSION['userConnect']['id']);
}

if(isset($_GET['idaddNbAlert'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home -> updateNbAlert($_SESSION['userDiscussions']['id']);
}

if(isset($_GET['iddeleteAmis'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteDiscussionAndAmis($_SESSION['userConnect']['id'],$_SESSION['userDiscussions']['id'],$_SESSION['idDiscussionInProccess']);
    $_SESSION['nbConnect'] =-2;
}

if(isset($_GET['iddeleteAmis'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteDiscussionAndAmis($_SESSION['userConnect']['id'],$_SESSION['userDiscussions']['id'],$_SESSION['idDiscussionInProccess']);
    $_SESSION['nbConnect'] =-2;
}

if(isset($_GET['idUpdateName'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->updateName($_SESSION['userConnect']['id'],$_GET['idUpdateName']);
}

if(isset($_GET['idUpdateActu'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->updateActu($_SESSION['userConnect']['id'],$_GET['idUpdateActu']);
}

if(isset($_GET['idUpdatePicture'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->updatePicture($_SESSION['userConnect']['id'],$_GET['idUpdatePicture']);
    $_SESSION['userConnect']['profilPicture'] = $_GET['idUpdatePicture'];
}

if(isset($_GET['iddeleteForMe1'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteForMe1($_GET['iddeleteForMe1']);
}

if(isset($_GET['iddeleteForMe2'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteForMe2($_GET['iddeleteForMe2']);
}

if(isset($_GET['iddeleteForEverybody'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteForEverybody($_GET['iddeleteForEverybody']);
}

if(isset($_GET['iddeleteAllForMe'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteAllForMe($_SESSION['idDiscussionInProccess'],$_SESSION['userConnect']['id']);
}

if(isset($_GET['idImportantMessage'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    if($home -> existImportantMessage($_SESSION['userConnect']['id'],$_GET['idImportantMessage']) == false){
        $home -> addImportantMessage($_SESSION['userConnect']['id'],$_GET['idImportantMessage']);
    }
}

if(isset($_GET['idMessageImportant'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    $home ->deleteMessageImportant($_GET['idMessageImportant']);
}

if(isset($_GET['idblockUser'])){
    require_once "src/controller/SpaceUserController.php";
    $home = new SpaceUserController();
    if($home -> statutExist($_SESSION['userConnect']['id'],$_GET['idblockUser']) == false){
        $home -> addStatut($_SESSION['userConnect']['id'],$_GET['idblockUser']);
    }else{
        $home -> deleteStatut($_SESSION['userConnect']['id'],$_GET['idblockUser']);
    }
}

?>