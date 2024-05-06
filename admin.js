function sendmessage(mail, ad) {
    //alert(ad);
    var email = mail;
    var msgtxt = document.getElementById("msgtxt").value;
    document.getElementById("msgtxt").value = "";



    var f = new FormData();
    f.append("e", email);
    f.append("t", msgtxt);
    var ad = ad;
    if (ad != null) {
        f.append("ad", ad);
        //alert(ad);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {

                alert("Message Sent Successfully");

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(f);

}


// refresher

function refresher(email, ad) {

    setInterval(function() {
        refreshmsgare(email, ad);
        refreshrecentarea();
        var elem = document.getElementById('chatrow');
        // elem.scrollTop = elem.scrollHeight;
    }, 500);

}



// refres msg view area

function refreshmsgare(mail, ad) {
    //alert();
    var chatrow = document.getElementById("chatrow");

    var f = new FormData();
    f.append("e", mail);
    if (ad != null) {
        f.append("ad", ad);
        //alert(ad);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            //alert(t);
            chatrow.innerHTML = t;
        }
    }

    r.open("POST", "refreshmsgareaprocessA.php", true);
    r.send(f);

}

// refreshrecentarea

function refreshrecentarea() {

    var rcv = document.getElementById("rcv");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            rcv.innerHTML = t;
            //alert(t);
        }
    }

    r.open("POST", "refreshrecentareaprocessA.php", true);
    r.send();

}