<section class="settings">
    <div class="settings_buttons">
        <div class="settings_button" data-modal="modals_avatar">
            <span class="settings_button_sign settings_button_sign_avatar">Avatar</span>
        </div>
        <div class="settings_button" data-modal="modals_login">
            <span class="settings_button_sign settings_button_sign_login">Login</span>
        </div>
        <div class="settings_button" data-modal="modals_password">
            <span class="settings_button_sign settings_button_sign_password">Password</span>
        </div>
        <div class="settings_button">
            <span class="settings_button_sign settings_button_sign_back">Back</span>
        </div>
    </div>

    <div id="settingsModal">
        <div class="modals modals_avatar">
            <form action="/settings/avatar" method="post" class="modals_form">
                <div class="modals_avatar_picture modals_section">
                    <img src="/avatar/default.png" alt="User avatar">
                </div>
                <div class="modals_avatar_change modals_section">
                    <span class="modals_avatar_sign">Pick avatar:</span>
                    <label class="modals_avatar_label" for="inputAvatar"></label>
                    <input type="file" name="avatar" id="inputAvatar">
                </div>
                <div class="modals_avatar_btns modals_btns modals_section">
                    <input type="button" value="Save" class="btn btn-primary">
                    <a href="/settings" class="modals_back btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
        <div class="modals modals_password">
            <form action="/settings/password" method="post" class="modals_form">
                <div class="modals_password_firstinput modals_section">
                    <label class="form-label" for="modalPasswordFirst">Enter new password:</label>
                    <input class="form-control" type="text" name="" id="modalPasswordFirst">
                </div>
                <div class="modals_password_secondinpt modals_section modals_border">
                    <label class="form-label" for="modalPasswordSecond">Re-enter new password:</label>
                    <input class="form-control" type="text" name="" id="modalPasswordSecond">
                </div>
                <div class="modals_password_btns modals_btns modals_section">
                    <input type="button" value="Save" class="btn btn-primary">
                    <a href="/settings" class="modals_back btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
        <div class="modals modals_login">
            <form action="/settings/login" method="post" class="modals_form">
                <div class="modals_login_current modals_section modals_border">
                    <span>Your current login: <strong>User name</strong></span>
                </div>
                <div class="modals_login_input modals_section modals_border">
                    <label class="form-label" for="modalLoginInput">Enter new login:</label>
                    <input class="form-control" type="text" id="modalLoginInput">
                </div>
                <div class="modals_login_btns modals_btns modals_section">
                    <input type="button" value="Save" class="btn btn-primary">
                    <a href="/settings" class="modals_back btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</section>
