<?php

require_once('../../config.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('assign', $id);
if (!$cm) {
    print_error('Invalid Assignment ID');
}

$context = context_module::instance($cm->id);
require_login($cm->course, false, $cm);

$PAGE->set_url(new moodle_url('/local/graidy/index.php', ['id' => $id]));
$PAGE->set_context($context);
$PAGE->set_title('GRAiDY Grading Interface');
$PAGE->set_heading('GRAiDY Grading Interface');

echo $OUTPUT->header();
echo "<h2>Welcome to GRAiDY Grading</h2>";
echo "<p>This is a placeholder page for GRAiDY grading functionality.</p>";
echo $OUTPUT->footer();
