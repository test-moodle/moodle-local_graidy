<?php

require_once('../../config.php');

global $PAGE, $OUTPUT, $USER, $CFG;

$cmid = required_param('id', PARAM_INT);
$courseid = optional_param('courseid', 0, PARAM_INT);
$userid = required_param('userid', PARAM_INT);
$type = required_param('type', PARAM_TEXT);

require_login($courseid);

// Set up page context.
$context = context_module::instance($cmid);
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/graidy/grading.php', ['id' => $cmid]));
$PAGE->set_title('GRAiDY Grading');
$PAGE->set_heading('GRAiDY Grading Page');

debugging('[GRAiDY] Rendering grading page for CM ID: ' . $cmid, DEBUG_DEVELOPER);

// Render page.
echo $OUTPUT->header();
echo html_writer::tag('h2', 'Welcome to GRAiDY Grading');
echo html_writer::tag('p', 'This is a placeholder for GRAiDY grading functionality.');
echo $OUTPUT->footer();
