window.addEventListener('DOMContentLoaded', ()=>{
    const editClass = 'chat_message_edit';
    const actionClass = 'chat_message_action';
    const textClass = 'chat_message_text';
    const flexClass = 'display_flex';
    const displayClass = 'display_block';
    const noneClass = 'display_none';
    const canelClass = 'chat_message_canel';
    const doneClass = 'chat_message_done';
    const messageClass = '.chat_message';
    const extraClass = 'chat_message_extra';
    const denyClass = 'chat_message_deny';
    const deleteClass = 'chat_message_delete';
    const extraBtnClass = 'chat_message_extra_btns';
    const btnClass = 'chat_message_extra_btn';
    const hideDotsClass = 'hideDots';
    const dotsClass = 'chat_message_dots';
    const opacityClass = 'opacity_1';
    const animtionSpeed = 150;
    const buttonsOpenSpeed = 100;
    const buttonsOpenStep = 100;
    const buttonsHideSpeed = 0;
    const buttonsHideStep = 50;
    let  currentTarget;

    const chatWrapper = document.getElementById('log');

    chatWrapper.addEventListener('click', onChatWrapperClick);

    function onChatWrapperClick(e){
        if(e.target.classList.contains(editClass)){
            const messageBlock = e.target.closest(messageClass);

            editEl(messageBlock);
        }

        if(e.target.classList.contains(canelClass)){
            const messageBlock = e.target.closest(messageClass);

            canelEditon(messageBlock);
            setStartPosition(messageBlock);
        }

        if(e.target.classList.contains(doneClass)){
            const messageBlock = e.target.closest(messageClass);
            const text = messageBlock.querySelector(`.${textClass}`).innerText;
            let id = messageBlock.dataset.messageId;

            fetchEl(text, id, 'update');
            setStartPosition(messageBlock);
            canelEditon(messageBlock);
        }

        if(e.target.classList.contains(extraClass) || e.target.classList.contains(dotsClass)){
            const messageBlock = e.target.closest(messageClass);
            const dotsBlock = messageBlock.querySelector(`.${extraClass}`);
            const extraBtnsEl = Array.from(messageBlock.querySelectorAll(`.${btnClass}`));
            let time = buttonsOpenSpeed;

            if(currentTarget && currentTarget !== messageBlock){
                canelEditon(currentTarget);
                setStartPosition(currentTarget);
                currentTarget = messageBlock;
            } else if(currentTarget !== messageBlock){
                currentTarget = messageBlock;
            }

            dotsBlock.classList.add(hideDotsClass);

            timeOutClass(dotsBlock, noneClass, animtionSpeed, 'add')

            messageBlock.querySelector(`.${extraBtnClass}`).classList.add(displayClass);

            extraBtnsEl.forEach((item)=>{
                timeOutClass(item, opacityClass, time, 'add');

                time+=buttonsOpenStep;
            });
        }

        if(e.target.classList.contains(denyClass)){
            const messageBlock = e.target.closest(messageClass);
            const btnBlock = messageBlock.querySelector(`.${extraBtnClass}`);

            setStartPosition(messageBlock);
            timeOutClass(btnBlock, displayClass, animtionSpeed, 'remove');
        }

        if(e.target.classList.contains(deleteClass)){
            const messageBlock = e.target.closest(messageClass);
            let id = messageBlock.dataset.messageId;

            fetchEl('', id, 'delete');
            messageBlock.remove();
        }
    }

    function timeOutClass(el, cssClass, time, action){
        if(action === 'add'){
            setTimeout(()=>el.classList.add(cssClass), time);
        } else if(action === 'remove'){
            setTimeout(()=>el.classList.remove(cssClass), time);
        }
    }

    function canelEditon(el){
        el.querySelector(`.${textClass}`).attributes.contenteditable.value = 'false';
        el.querySelector(`.${actionClass}`).classList.remove(flexClass);
    }

    function setStartPosition(el){
        const dotsBlock = el.querySelector(`.${extraClass}`);
        const btnBlock = el.querySelector(`.${extraBtnClass}`);
        const extraBtnsEl = Array.from(el.querySelectorAll(`.${btnClass}`));
        extraBtnsEl.reverse();
        let time = buttonsHideSpeed;

        extraBtnsEl.forEach((item)=>{
            timeOutClass(item, opacityClass, time, 'remove');

            time+=buttonsHideStep;
        });

        timeOutClass(btnBlock, displayClass, animtionSpeed, 'remove');
        dotsBlock.classList.remove(noneClass);
        timeOutClass(dotsBlock, hideDotsClass, animtionSpeed, 'remove');
    }

    function editEl(el){
        const textBlock = el.querySelector(`.${textClass}`);

        textBlock.attributes.contenteditable.value = 'true';
        textBlock.focus();

        el.querySelector(`.${extraBtnClass}`).classList.remove(displayClass);
        el.querySelector(`.${actionClass}`).classList.add(flexClass);
    }

    function fetchEl(text, id, action){
        let data = {
            newMessage: text,
            messageId: id,
            action: action,
        }

        fetch(`/index.php?page=chat_ajax`, {
            credentials: 'include',
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
        });
    }
});
