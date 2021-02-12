window.addEventListener('DOMContentLoaded', ()=>{
    const settingsMenu = document.querySelector('.chat_settings');


    settingsMenu.addEventListener('click', ()=>{
        settingsMenu.firstElementChild.classList.toggle('display_block');
    })
});