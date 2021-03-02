window.addEventListener('DOMContentLoaded', ()=>{

    const socket = new WebSocket('ws://localhost:8080');

    const messageGroupTemplate = document.querySelector('#messageGroupTemplate').innerHTML;
    const messageTemplate = document.querySelector('#messageTemplate').innerHTML;
    const chatLogEl = document.querySelector('.chat_log');
    const inputEl = document.querySelector('#input_message');
    const sendBtnEl = document.querySelector('#btn_send');
    let userId;
    init();

    sendBtnEl.addEventListener('click', onBtnClick);

    function onBtnClick(e){
        e.preventDefault();

        let message = {};
        message.message_text = inputEl.value;

        sendMessage(message);

        inputEl.value = '';
    }

    async function init(){
        await fetch('chat/userId').then((res)=>res.json()).then((id)=>userId = id);
    }

    function sendMessage(message){
        fetch(`chat/send`, {
            credentials: 'include',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(message),
        });
    }

    function createMessageElement(template, messageValues){
        let newMessage = template.replace('{{avatar_src}}', messageValues.avatar)
                                        .replace('{{login}}', messageValues.user_login)
                                        .replace('{{text}}', messageValues.message_text)
                                        .replace('{{time}}', messageValues.message_time)
                                        .replace('{{message_id}}', messageValues.id);

        return newMessage;
    }

    socket.onmessage = function(e){
        let messageValues = JSON.parse(e.data);

        let newMessageEl;
        if(userId == messageValues.user_id){
            newMessageEl = createMessageElement(messageTemplate, messageValues);
        } else {
            newMessageEl = createMessageElement(messageGroupTemplate, messageValues);
        }

        chatLogEl.insertAdjacentHTML('beforeend', newMessageEl);
        chatLogEl.scrollTo(0, chatLogEl.scrollHeight);
    }

});
