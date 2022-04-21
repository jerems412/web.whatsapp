//press discussion
function printDiscussion(Element) {
    $.ajax({
        type: "get",
        data: {
            idPrintDiscussion: Element
        },
        dataType: "html",
        success: function(data) {
            window.location.reload(true);
        },
    });
}

//press discussion
function changeTheme() {
    let proceed = confirm("Voulez vous vraiment changer de theme ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idChangeTheme: 1
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//press add friend
function addAmis(Element,name) {
    let proceed = confirm("Voulez vous vraiment ajouter "+name+" ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idaddAmis: Element
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//press add friend
function addMessage(idUser2,msg) {
    if(msg.value != "" && msg.value !=" "){
        $.ajax({
            type: "get",
            data: {
                idaddMessage: idUser2,
                message: msg.value
            },
            dataType: "html",
            success: function(data) {
                msg.value = "";
                window.location.reload(true);
            },
        });
    }
}

//press add friend
function addNbAlert(Element) {
    let proceed = confirm("Voulez vous vraiment signaler "+Element+" ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idaddNbAlert: Element        
            },
            dataType: "html",
            success: function(data) {
                alert(Element+" a bien ete signale");
            },
        });
    } 
}

//press add friend
function deleteAmis(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer "+Element+" ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                iddeleteAmis: Element    
            },
            dataType: "html",
            success: function(data) {
                alert(Element+" a bien ete supprime de vos amis.");
                window.location.reload(true);
            },
        });
    } 
}

//update Actu
function updateActu(Element) {
    $.ajax({
        type: "get",
        data: {
            idUpdateActu: Element.value     
        },
        dataType: "html",
        success: function(data) {

        },
    });
}

//update Name
function updateName(Element) {
    if(Element.value.length >= 4 && Element.value.length <=10){
        $.ajax({
            type: "get",
            data: {
                idUpdateName: Element.value        
            },
            dataType: "html",
            success: function(data) {
    
            },
        });
    }else{
        alert("Entrer au moins 4 carateres et maximum 10 caracteres");
        Element.focus();
    }
}

//update Actu
function updatePicture(Element) {
    $.ajax({
        type: "get",
        data: {
            idUpdatePicture: Element.value.substr(12)  
        },
        dataType: "html",
        success: function(data) {
            window.location.reload(true);
        },
    });
}

//delete for me
function deleteForMe1(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer ce message ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                iddeleteForMe1: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    } 
}

//delete for me
function deleteForMe2(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer ce message ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                iddeleteForMe2: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//delete for evrery body
function deleteForEverybody(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer ce message ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                iddeleteForEverybody: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//delete for evrery body
function deleteAllForMe(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer tous les messages de cette discussion ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                iddeleteAllForMe: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//search message
function SearchMessage(Element,idDiscussion) {
    if(Element.value != "" && Element.value != " "){
        $.ajax({
            url: "http://localhost/mes_projets/web.whatsapp/src/ajax/searchMsg.php",
            type: "get",
            data: {
                idSearchMessage: Element.value,
                idDiscussion: idDiscussion
            },
            dataType: "json",
            success: function(data) {
                if(data != "0"){
                    let div = document.getElementById("discussionSearchIC");
                    div.innerHTML = "";
                    data.forEach(element => {
                        div.innerHTML += '<a><ul style="margin-left:-6%;"><li style="font-size:12px;">' + element['date'] + '</li><li style="font-size:14px;">' + (element["messageMsg"].length > 18 ? element["messageMsg"].substr(0, 15) + "..." : element["messageMsg"]) + '</li></ul></a>';
                    });
                }
            },
            error: function(){
                alert("erreur");
            }
        });
    }
}

//search user
function SearchUser(Element,idUser) {
    if(Element.value != "" && Element.value != " "){
        $.ajax({
            url: "http://localhost/mes_projets/web.whatsapp/src/ajax/searchMsg.php",
            type: "get",
            data: {
                idSearchUser: Element.value,
                idUserConnect: idUser
            },
            dataType: "json",
            success: function(data) {
                if(data != "0"){
                    let div1 = document.getElementById("discussionAddFriends");
                    div1.style.display = "none";
                    let div = document.getElementById("discussionAddFriends1");
                    div.style.display = "block";
                    div.innerHTML = "";
                    data.forEach(element => {
                        div.innerHTML += '<a onclick="addAmis(' + element['id'] + ')"><img src="http://localhost/mes_projets/web.whatsapp/public/SpaceUser/img/' + element['profilPicture'] + '" alt=""><ul style="margin-left:-6%;"><li>' + element['name'] + '</li><li>' + element['actu'] + '</li></ul></a>';
                    });
                }
            },
            error: function(){
                alert("erreur");
            }
        });
    }else{
        let div1 = document.getElementById("discussionAddFriends");
        div1.style.display = "block";
        let div = document.getElementById("discussionAddFriends1");
        div.style.display = "none";
        div.innerHTML = "";
    }
}

//search discussion
function SearchDiscussion(Element,idUser) {
    if(Element.value != "" && Element.value != " "){
        $.ajax({
            url: "http://localhost/mes_projets/web.whatsapp/src/ajax/searchMsg.php",
            type: "get",
            data: {
                idSearchDiscussion: Element.value,
                idUserConnectD: idUser
            },
            dataType: "json",
            success: function(data) {
                if(data != "0"){
                    let div1 = document.getElementById("discussion");
                    div1.style.display = "none";
                    let div = document.getElementById("discussion1");
                    div.style.display = "block";
                    div.innerHTML = "";
                    data.forEach(element => {
                        div.innerHTML += '<a onclick="printDiscussion('+element['idDiscussion']+')"><img src="http://localhost/mes_projets/web.whatsapp/public/SpaceUser/img/'+element['profilPicture']+'" alt=""><ul style="margin-left:-6%;"><li>'+element['name']+'</li></ul><ul style="margin-left: auto;margin-right:2%;text-align:right"><li style="font-size:13px;">'+element['date']+'</li></ul></a>';
                    });
                }
            },
            error: function(){
                alert("erreur");
            }
        });
    }else{
        let div1 = document.getElementById("discussion");
        div1.style.display = "block";
        let div = document.getElementById("discussion1");
        div.style.display = "none";
        div.innerHTML = "";
    }
}

//delete for evrery body
function markImportantMessage(Element) {
    let proceed = confirm("Voulez le marquer comme important ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idImportantMessage: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//delete for evrery body
function deleteMessageImportant(Element) {
    let proceed = confirm("Voulez vous vraiment supprimer ce message ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idMessageImportant: Element  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}

//delete for evrery body
function blockUser(Element,idUser) {
    let proceed = confirm("Voulez vous vraiment"+Element+" ?");
    if (proceed) {
        $.ajax({
            type: "get",
            data: {
                idblockUser: idUser  
            },
            dataType: "html",
            success: function(data) {
                window.location.reload(true);
            },
        });
    }
}