window.addEventListener('DOMContentLoaded', ()=>{
    const inputEl = document.querySelector('#inputAvatar');
    // let defaultSrc = inputEl.src;

    inputEl.addEventListener('change', previewAvatar);

    function previewAvatar(){
        const avatarEl = document.getElementById('settingsUserAvatar');
        const file = inputEl.files[0];

        const reader = new FileReader;

        const types = ['image/jpeg','image/png','image/webp','image/bmp'];

        reader.onloadend = () => avatarEl.src = reader.result;

        if(file && types.includes(file.type, 0)){
            reader.readAsDataURL(file);
        }
    }
});