let menuLeft = document.getElementById("menuLeft");
let menuRight = document.getElementById("menuRight");
let right = document.getElementById("right");
let infos = document.getElementById("infos");
let infosContact = document.getElementById("infosContact");
let infosRight = document.getElementById("infosRight");
let addFriends = document.getElementById("addFriends");
let importantMessage = document.getElementById("importantMessage");
let addDiscussion = document.getElementById("addDiscussion");
let discussions = document.getElementById("discussions");
let parametres = document.getElementById("parametres");
let previewAddFriends = document.getElementById("previewAddFriends");
let previewinfosContact = document.getElementById("previewinfosContact");
let previewImportantMessage = document.getElementById("previewImportantMessage");
let listImportantMessage = document.getElementById("listImportantMessage");
let listParametres = document.getElementById("listParametres");
let writeMessage = document.getElementById("writeMessage");
let send = document.getElementById("send");
let messagesRight = document.getElementById("messagesRight");
let closeDiscussion = document.getElementById("closeDiscussion");
let pressInfosContact = document.getElementById("pressInfosContact");
let pressInfosContactIMG = document.getElementById("pressInfosContactIMG");
let searchMessageIC = document.getElementById("searchMessageIC");
let previewSearchMessageIC = document.getElementById("previewSearchMessageIC");
let pressSearchRight = document.getElementById("pressSearchRight");
let pressEmoji = document.getElementById("pressEmoji");
let emojis = document.getElementById("emojis");
let profil = document.getElementById("profil");
let writeSeachRigh = document.getElementById("writeSeachRigh");
let imgProfil = document.getElementById("imgProfil");
let inputSearchUser = document.getElementById("inputSearchUser");

//print menu left

infos.addEventListener("click", function(){
    if(menuLeft.style.display == "none"){
        menuLeft.style.display = "block";
    }else{
        menuLeft.style.display = "none";
    }
});

closeDiscussion.addEventListener("click", function(){
    if(right.style.display == "none"){
        right.style.display = "block";
    }else{
        right.style.display = "none";
    }
});

infosRight.addEventListener("click", function(){
    if(menuRight.style.display == "none"){
        menuRight.style.display = "block";
    }else{
        menuRight.style.display = "none";
    }
});

addDiscussion.addEventListener("click", function(){
    menuLeft.style.display = "none";
    discussions.style.display="none";
    addFriends.style.display="block";
});

listImportantMessage.addEventListener("click", function(){
    menuLeft.style.display = "none";
    discussions.style.display="none";
    importantMessage.style.display="block";
});

listParametres.addEventListener("click", function(){
    menuLeft.style.display = "none";
    discussions.style.display="none";
    parametres.style.display="block";
});

imgProfil.addEventListener("click", function(){
    menuLeft.style.display = "none";
    discussions.style.display="none";
    profil.style.display="block";
});

previewAddFriends.addEventListener("click", function(){
    discussions.style.display="block";
    addFriends.style.display="none";
    inputSearchUser.value="";
});

previewImportantMessage.addEventListener("click", function(){
    discussions.style.display="block";
    importantMessage.style.display="none";
});

previewParametres.addEventListener("click", function(){
    discussions.style.display="block";
    parametres.style.display="none";
});

previewProfil.addEventListener("click", function(){
    discussions.style.display="block";
    profil.style.display="none";
});

previewSearchMessageIC.addEventListener("click", function(){
    searchMessageIC.style.display="none";
    writeSeachRigh.value="";
});

previewinfosContact.addEventListener("click", function(){
    infosContact.style.display="none";
});

pressInfosContact.addEventListener("click", function(){
    infosContact.style.display="block";
    menuRight.style.display = "none";
});

pressInfosContactIMG.addEventListener("click", function(){
    infosContact.style.display="block";
    menuRight.style.display = "none";
});

pressSearchRight.addEventListener("click", function(){
    searchMessageIC.style.display="block";
    menuRight.style.display = "none";
    writeSeachRigh.value = "";
    document.getElementById("discussionSearchIC").innerHTML = "";
});

pressSearchRight.addEventListener("click", function(){
    searchMessageIC.style.display="block";
    menuRight.style.display = "none";
});

pressEmoji.addEventListener("click", function(){
    if(emojis.style.display == "none"){
        emojis.style.display = "block";
        writeMessage.focus();
    }else{
        emojis.style.display = "none";
        writeMessage.focus();
    }
});

//send message right

writeMessage.addEventListener("blur", function(){
    if(writeMessage.value != "" && writeMessage.value != " "){
        send.className = "fa fa-paper-plane";
    }else{
        send.className = "fa-solid fa-microphone";
    }
});

writeMessage.addEventListener("keyup", function(){
    if(writeMessage.value != "" && writeMessage.value != " "){
        send.className = "fa fa-paper-plane";
    }else{
        send.className = "fa-solid fa-microphone";
    }
});

messagesRight.scrollTo(0,messagesRight.scrollHeight);
writeMessage.focus();

//emoji
let emoji = document.getElementsByClassName("emoji");

for (let index = 0; index < emoji.length; index++) {
    emoji[index].addEventListener("click", function(){
        writeMessage.value += emoji[index].innerText;
        writeMessage.focus();
    });
}

//click message

let clickMessage = document.getElementsByClassName("send");
for (let i = 0; i < clickMessage.length; i++) {
    clickMessage[i].addEventListener("click", function(){
        if(document.getElementById("menuMessage"+i).style.display== "none"){
            document.getElementById("menuMessage"+i).style.display= "block";
        }else{
            document.getElementById("menuMessage"+i).style.display= "none";
        }
    });
}

let clickMessage1 = document.getElementsByClassName("receive");
for (let i = 0; i < clickMessage1.length; i++) {
    clickMessage1[i].addEventListener("click", function(){
        if(document.getElementById("menuMessagess"+i).style.display== "none"){
            document.getElementById("menuMessagess"+i).style.display= "block";
        }else{
            document.getElementById("menuMessagess"+i).style.display= "none";
        }
    });
}