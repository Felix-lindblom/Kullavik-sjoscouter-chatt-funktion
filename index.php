

var myName = prompt("Enter Your Name");
    var message = document.getElementById("messaage").value;

    firebase.database().ref("messages").push().set({
        "sender": myName,
        "message": message
    });

    return false;

    firebase.database().ref("messages").on("child:added", function (snapshot) {
        var html = "";

        html += "<li id='message-" + snapshot.key + "'>";
            if (snapshot.val().sender == myName){
                html += "<button data-id='" + snapshot.key + "'onclick='deleteMessage(this);'>"
                    html += "Delete"
                html += "</button>";
            }

            html += snapshot.val().sender + ": " + snapshot.val().message;
        html += "<li>";

        document.getElementById("messages").innerHTML += html;

    });

    function deleteMessage(self);
    var messageId = self.getAttribute("data-id");
    firebase.database().ref("message").child(messageId).remove();
    firebase.database().ref("message").on("child_removed", funtion (snapshot) {

        document.getElementById("message-" + snapshot.key).innet = "Detta meddelande har tagits bort"; 

    });

    });
</script>

<form>
    <input id="messaage" placeholder="Enter Message" autocomplete="off">

    <input type="submit">
</form>

    <!-- create a list -->
    <ul id="messages"></ul>