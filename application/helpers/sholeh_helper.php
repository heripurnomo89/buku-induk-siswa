<?php

function is_logged_in()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }
}

function stay()
{
    $ci = get_instance();
    if ($ci->session->userdata('username')) {
        if ($ci->session->userdata('role') == 1) {
            redirect('kepalasekolah/index');
        } else {
            redirect('admin/index');
        }
    }
}