<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Upload extends CI_Upload {

    public function is_allowed_filetype($ignore_mime = FALSE)
    {
        // 🔥 FORCE ALLOW WEBP
        if (strtolower($this->file_ext) === '.webp') {
            return TRUE;
        }

        return parent::is_allowed_filetype($ignore_mime);
    }
}

