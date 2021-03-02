<section id="log" class="chat_wrapper">
    <ul class="chat_log">
        <?php foreach($data as $message):?>
            <?php if ($_SESSION['user_id'] == $message['user_id']):?>
                <li class="message" data-message-id='<?php echo($message['id'])?>'>
                    <span class="miniature_wrapper">
                        <span class="message_miniature">
                            <img src="<?php echo($message['avatar'])?>" alt="User miniature">
                        </span>
                    </span>
                    <span class="message_body">
                        <span class="chat_message">
                            <span class="chat_message_author"><strong><?php echo($message['user_login'])?></strong></span>
                            <span class="chat_message_text" contenteditable='false'><?php echo($message['message_text'])?></span>
                            <span class="chat_message_time"><?php echo($message['message_time'])?></span>
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
            <?php else:?>
                <li class="message group_message">
                    <span class="miniature_wrapper">
                        <span class="message_miniature">
                            <img src="<?php echo($message['avatar'])?>" alt="User miniature">
                        </span>
                    </span>
                    <span class="message_body">
                        <span class="chat_message">
                            <span class="chat_message_author"><strong><?php echo($message['user_login'])?></strong></span>
                            <span class="chat_message_text"><?php echo($message['message_text'])?></span>
                            <span class="chat_message_time"><?php echo($message['message_time'])?></span>
                        </span>
                    </span>
                </li>
            <?php endif;?>
        <?php endforeach;?>
    </ul>
    <div class="chat_action">
        <form class="chat_form" >
            <div class="chat_text">
                <input type="text" name="message" class="form-control" id="input_message">
            </div>
            <div class="chat_send">
                <input type="button" value="send" class="btn bg-info bg-gradient" name="submit" id="btn_send">
            </div>
        </form>
    </div>
</section>
