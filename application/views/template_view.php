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
                    <img src="" alt="User miniature">
                </div>
                <ul class="header_user_info">
                    <li class="header_user_name">User Name</li>
                    <li class="header_user_status">status</li>
                </ul>
            </div>
        </header>
        <main class="main">
            <nav class="main_nav">
                <ul class="main_nav_list">
                    <li class="main_nav_item"><a class="main_nav_link" href="#">Contacts</a></li>
                    <li class="main_nav_item"><a class="main_nav_link" href="#">Settings</a></li>
                    <li class="main_nav_item"><a class="main_nav_link" href="#">Exit</a></li>
                </ul>
            </nav>
            <section class="main_content">
                <?php include 'application/views/'.$content_view;?>
            </section>
        </main>
    </div>
    <div class="modal_wrapper" id="modalWrapper">
        <div class="cross_btn" id="crossBtn"></div>
    </div>
</body>
</html>
