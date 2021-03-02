<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/dist/app.js"></script>
    <title>Chatiks</title>
</head>
<body>
    <div class="application_wrapper">
        <header class="header">
            <div class="header_user">
                <div class="header_user_image">
                    <img src="<?php echo($user_data['avatar']);?>" alt="User miniature">
                </div>
                <ul class="header_user_info">
                    <li class="header_user_name"><?php echo($user_data['user_login']);?></li>
                    <li class="header_user_status">status</li>
                </ul>
            </div>
        </header>
        <main class="main">
            <nav class="main_nav">
                <ul class="main_nav_list">
                    <li class="main_nav_item"><a class="main_nav_link main_nav_link_chat" href="/chat">Chat</a></li>
                    <li class="main_nav_item"><a class="main_nav_link main_nav_link_contact" href="/contacts">Contacts</a></li>
                    <li class="main_nav_item"><a class="main_nav_link main_nav_link_settings" href="/settings">Settings</a></li>
                    <li class="main_nav_item"><a class="main_nav_link main_nav_link_exit" href="/login/logout">Exit</a></li>
                </ul>
            </nav>
            <section class="main_content">
                <?php include 'application/views/'.$content_view;?>
            </section>
        </main>
    </div>
    <div class="modal_wrapper" id="modalWrapper">
        <div class="modal_wrapper_cross" id="crossBtn"></div>
    </div>
    <script type="text/template" id="messageGroupTemplate">
    <li class="message group_message">
        <span class="miniature_wrapper">
            <span class="message_miniature">
                <img src="{{avatar_src}}" alt="User miniature">
            </span>
        </span>
        <span class="message_body">
            <span class="chat_message">
                <span class="chat_message_author"><strong>{{login}}</strong></span>
                <span class="chat_message_text">{{text}}</span>
                <span class="chat_message_time">{{time}}</span>
            </span>
        </span>
    </li>
    </script>
    <script type="text/template" id="messageTemplate">
        <li class="message" data-message-id='{{message_id}}'>
            <span class="miniature_wrapper">
                <span class="message_miniature">
                    <img src="{{avatar_src}}" alt="User miniature">
                </span>
            </span>
            <span class="message_body">
                <span class="chat_message">
                    <span class="chat_message_author"><strong>{{login}}</strong></span>
                    <span class="chat_message_text" contenteditable='false'>{{text}}</span>
                    <span class="chat_message_time">{{time}}</span>
                    <span class="chat_message_extra">
                        <span class="chat_message_dots"></span>
                    </span>
                    <span class="chat_message_extra_btns">
                        <span class="chat_message_edit chat_message_extra_btn"></span>
                        <span class="chat_message_delete chat_message_extra_btn"></span>
                        <span class="chat_message_deny chat_message_extra_btn"></span>
                    </span>
                    <span class="chat_message_action">
                        <span class="chat_message_done chat_message_btn"></span>
                        <span class="chat_message_canel chat_message_btn"></span>
                    </span>
                </span>
            </span>
        </li>
    </script>
</body>
</html>
