<ul class="contacts_wrapper">
    <?php foreach($data as $contact):?>
        <li class="contacts_item">
            <span class="contacts_avatar">
                <img src="<?php echo($contact['avatar']);?>" alt="User avatar">
            </span>
            <span class="contacts_login"><strong><?php echo($contact['user_login']);?></strong></span>
        </li>
    <?php endforeach;?>
</ul>