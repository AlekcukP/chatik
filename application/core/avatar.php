<?php
    class Avatar
    {
        private $max_avatar_size = 5*1024*1024;
        private $allowed_extensions = array(
            'jpg',
            'JPG',
            'jpeg',
            'gif',
            'bmp',
            'png'
        );
        private $relative_folder_path = '/avatar/';
        private $absolute_folder_path;

        public function __construct()
        {
            $this->absolute_folder_path = $_SERVER['DOCUMENT_ROOT'] . $this->relative_folder_path;
        }

        public function checkConformity($image)
        {
            $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);

            if ($image['size']>$this->max_avatar_size) {
                return 'Image size can not be over 5 mb.';
            } elseif (!in_array($image_extension, $this->allowed_extensions)) {
                return 'Image is not image';
            } else {
                return NULL;
            }
        }

        public function setAvatar($image, $user_id)
        {
            $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $image_name = 'user_' . $user_id . '.' . $image_extension;

            move_uploaded_file($image['tmp_name'], $this->absolute_folder_path . $image['name']);
            rename($this->absolute_folder_path . $image['name'], $this->absolute_folder_path . $image_name);

            return $this->relative_folder_path . $image_name;

        }
    }