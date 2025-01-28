<?php

defined('MOODLE_INTERNAL') || die();

$observers = [
    [
        'eventname'   => '\mod_assign\event\course_module_viewed',
        'callback'    => 'local_graidy_inject_button_in_assignment',
        'includefile' => '/local/graidy/lib.php', // IMPORTANT
        'priority'    => 100,
        'internal'    => false,
    ]
];