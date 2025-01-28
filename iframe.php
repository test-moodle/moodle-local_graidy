<?php
require_once('../../config.php');

$id = required_param('id', PARAM_INT); // Get the module ID.
$context = context_module::instance($id);
require_login();

$PAGE->set_url('/local/graidy/iframe.php', ['id' => $id]);
$PAGE->set_context($context);
$PAGE->set_pagelayout('standard');

$baseurl = get_config('local_graidy', 'baseurl'); // Get GRAiDY Base URL
if (!$baseurl) {
    echo $OUTPUT->header();
    echo "<div class='alert alert-danger'>GRAiDY Base URL is not configured.</div>";
    echo $OUTPUT->footer();
    exit;
}

$iframe_url = $baseurl . "/grading?id=" . $id;

echo $OUTPUT->header();
echo "<h2>GRAiDY Grading</h2>";
echo "<iframe src='$iframe_url' width='100%' height='800px' style='border: none;'></iframe>";
echo $OUTPUT->footer();
