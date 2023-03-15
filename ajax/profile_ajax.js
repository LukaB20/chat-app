const checkLastMessages = () => {
    const friendsDivs = document.querySelectorAll('.friends .friend');

    console.log(friendsDivs);

    setInterval(() => {
        friendsDivs.forEach((div) => {
            $.ajax({
                url: 'php/getLastMessage.php',
                type: 'POST',
                data: {uid: div.id},
                success: (response) => {
                    div.children[1].children[1].innerHTML = response;
                }
                })
        })
    },500);
}

const loadFriends = () => {
    $.ajax({
        url: 'php/showFriends.php',
        type: 'POST',
        success: (response) => {
            let data = JSON.parse(response);
            for(let i = 0; i < data.length; i++){
                $('.friends').append(`
                    <div class='friend' onclick='toggleChat(${data[i].user_id})' id='${data[i].user_id}'>
                        <div class='profile-image' style='background-image: url(${data[i].image.substring(1)});'></div>
                        <div>
                            <p class='user-name'>${data[i].firstname} ${data[i].lastname}</p>
                            <p class='last-msg'></p>
                        </div>
                     </div>
                `);
            }
        }
    })
}

$(document).ready(() => {
    // Add new friend btn opens add new friend window
    $('.toggleAddFriend').click(() => {
        $('#addFriendDiv').css("display", "block");
    });

    // On input change trigger ajax method to display suggested users
    $('#newFriendName').keyup(() => {
        let searchString = $('#newFriendName').val().trim();
        $.ajax({
            url: 'php/suggestFriend.php',
            type: 'POST',
            data: {inputString: searchString},
            success: (response) => {
                let data = JSON.parse(response);
                for(let i=0; i<data.length; i++){
                    let suggestedFriendDiv = `
                    <div class='flex-row'>
                            <div class="suggestedFriend">
                                <div class="profile-image" style='background-image: url(${data[i].image.substring(1)});'></div>
                                <div>
                                    <p class="user-name">${data[i].firstname} ${data[i].lastname}</p>
                                </div>
                            </div>
                            <button onclick='addFriend(this, ${data[i].user_id})'>Add friend</button>
                    </div>
                    `;
                    $('.suggestions').append(suggestedFriendDiv);
                }
            },
            beforeSend: () => {
                $('.suggestions').html(" ");
            }
        });
    })

    //Show friends in friend list and start looking for new messages
    loadFriends();
    setTimeout(() => {
        checkLastMessages();
    }, 10)
});


// Add friend handle
const addFriend = (e, id) => {
    e.remove();
    $.ajax({
        url: 'php/addFriend.php',
        type: 'POST',
        data: {friendId: id},
        success: (response) => {
            if(response == 'success'){
                alert("Dodat drug.");
                $('.friends').html("");
                $.ajax({
                    url: 'php/showFriends.php',
                    type: 'POST',
                    success: (response) => {
                        let data = JSON.parse(response);
                        for(let i = 0; i < data.length; i++){
                            $('.friends').append(`
                                <div class='friend' onclick='toggleChat(${data[i].user_id})'>
                                    <div class='profile-image' style='background-image: url(${data[i].image.substring(1)});'></div>
                                    <div>
                                        <p class='user-name'>${data[i].firstname} ${data[i].lastname}</p>
                                        <p class='last-msg'></p>
                                    </div>
                                 </div>
                            `);
                        }
                    }
                })
                $('.chat').html("");
            }
        }
    })
}

//Interval to check new messages in chat
let chatInterval;

//Toggle chat
function toggleChat(friend_id) {
    clearInterval(chatInterval);
    $.ajax({
        url: 'php/getUserChat.php',
        type: 'POST',
        data: {f_id: friend_id},
        success: (response) => {
            let data = JSON.parse(response);
            $('.chat').html(`
                    <header>
                        <i class="fa-solid fa-chevron-left" onclick="closeChat()"></i>
                        <div class="profile-image" style="background-image: url(${data.image.substring(1)})"></div>
                        <div>
                            <p class="user-name">${data.firstname} ${data.lastname}</p>
                            <p class="status">${data.status}</p>
                        </div>
                    </header>
                    <div class="messages">
                    </div>
                    <form action="#" method="POST" onsubmit="event.preventDefault(); sendMessage(this)">
                        <input type="text" name="receiverId" id="receiverId" value="${data.user_id}" hidden>
                        <input type="text" name="sentMessage" id="msg">
                        <input type="submit" value="Send" id="sendMessageBtn">
                    </div>
    `);
            chatInterval = setInterval(() => {
                $.ajax({
                    url: 'php/checkStatus.php',
                    type: 'POST',
                    data: {uid: data.user_id},
                    success: (response) => {
                        $('.status').html(response);
                    }
                })
                let numberOfMessages = 0;
                $.ajax({
                    url: 'php/checkMessages.php',
                    type: 'POST',
                    data: {friendId: data.user_id},
                    success: (response) => {
                        let messages = JSON.parse(response);
                        if(messages.length > numberOfMessages){
                            $('.messages').html('');
                            console.log(data.user_id);
                            for(let i = 0; i < messages.length; i++){
                                if(messages[i].sender_id == data.user_id){
                                    $('.messages').append(`
                                        <div class='msg'>
                                            ${messages[i].text}
                                        </div>
                                    `);
                                }else{
                                    $('.messages').append(`
                                        <div class='msg user-msg'>
                                            ${messages[i].text}
                                        </div>
                                    `);
                                }
                            }
                            numberOfMessages = messages.length;
                        }else{
                            // do nothing
                        }
                        checkLastMessages();
                    }
                });
            }, 500);
        }
    });
}

const sendMessage = (form) => {
    let receiver = form.receiverId.value;
    let text = form.sentMessage.value;

    $.ajax({
        url: 'php/sendMessage.php',
        type: 'POST',
        data: {receiverId: receiver, txt: text},
        success: (response) => {
            console.log(response);
        }

    });

    form.children[1].value = "";
}

const closeChat = () => {
    $('.chat').html('');
    clearInterval(chatInterval);
}