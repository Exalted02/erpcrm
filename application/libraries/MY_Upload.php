<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Upload extends CI_Upload {

    public function is_allowed_filetype($ignore_mime = FALSE)
    {
        $ext = strtolower($this->file_ext);

        // ✅ Allow WEBP manually
        if ($ext === '.webp') {
            return TRUE;
        }

        // ✅ Let CI handle other types normally
        return parent::is_allowed_filetype($ignore_mime);
    }
}

