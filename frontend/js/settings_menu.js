window.addEventListener('DOMContentLoaded', ()=>{
    const settingsModalId = '#settingsModal';
    const modalWrapperId = '#modalWrapper';
    const settingsClass = 'settings';
    const settingsBtnClass = 'settings_button';
    const modalOpenClass = 'modal_open';
    const modalBackBtnClass = 'modals_back';
    const modalWrapperOpenClass = 'modal_wrapper_open';
    let currentModal;

    const modalEls = Array.from(document.querySelector(settingsModalId).children);
    const modalWrapperlEl = document.querySelector(modalWrapperId);
    const settingsEl = document.querySelector(`.${settingsClass}`);

    settingsEl.addEventListener('click', openModal);
    modalWrapperlEl.addEventListener('click', closeModal);

    function openModal(e){
        if(e.target.closest(`.${settingsBtnClass}`)){
            let modalType = e.target.closest(`.${settingsBtnClass}`).dataset.modal;

            modalEls.forEach((item)=>{
                if(item.classList.contains(modalType)){
                    currentModal = item;
                    modalWrapperlEl.classList.add(modalWrapperOpenClass);
                    item.classList.add(modalOpenClass);
                }
            });
        }
        if(e.target.contains(modalBackBtnClass)){
            closeModal();
        }
    }

    function closeModal(){
        currentModal.classList.remove(modalOpenClass);
        modalWrapperlEl.classList.remove(modalWrapperOpenClass);
    }
});