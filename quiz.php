<style>

    .activity-header{
        display: none !important;
    }
</style>

<?php
/**
 * Displays Graidy portal in an iframe, tied to a specific course ID.
 *
 * URL format: /local/graidy/course.php?id=COURSEID
 *
 * @package    local_graidy
 */

require_once(__DIR__ . '/../../config.php');

// Get the course ID from the URL.
$courseid = required_param('courseid', PARAM_INT); // Required course ID.
$sectionid = required_param('sectionid', PARAM_INT);
$contentid = required_param('contentid', PARAM_INT);
$moduleid = required_param('moduleid', PARAM_INT); // Required module ID.
$type = required_param('type', PARAM_TEXT);

// Load the course object.
$course = get_course($courseid);
require_login($course);

// Setup the context for this course.
$context = context_module::instance($moduleid);
$PAGE->set_context($context);

// Setup the page URL, title, and heading.
$PAGE->set_url('/local/graidy/quiz.php', ['courseid' => $courseid]);
// Example: You could use $course->fullname as the page heading/title.
$PAGE->set_title(get_string('pluginname', 'local_graidy'));
$PAGE->set_heading($course->fullname);

// Get base portal URL from plugin settings, or fallback.
$baseurl = get_config('local_graidy', 'baseurl');
if (empty($baseurl)) {
    // Fallback or handle error.
    $baseurl = 'https:/portal.graidy.tech';
}

// Determine which path to load in the iframe (dashboard, etc.).
$path = optional_param('path', 'dashboard', PARAM_ALPHANUMEXT);

// Construct the full iframe URL.
$iframeurl = rtrim($baseurl, '/') . '/' . $path;

// Output the page header.
echo $OUTPUT->header();

// Embed your iframe or content here.
// 1. Get the GRAiDY base URL from plugin settings.

$graidyBaseUrl = get_config('local_graidy', 'baseurl');
$organizationToken = get_config('local_graidy', 'organizationtoken');
$token = local_graidy_get_or_create_token($USER->id);
$iframeurl = $graidyBaseUrl . '/moodle/plugin/quiz/' . $courseid . '/' . $contentid . '/' .  $moduleid . '/' . $sectionid . '/' . $USER->id . '/' . $token . '/' . $organizationToken;

$output = $PAGE->get_renderer('local_graidy');
echo $output->render_iframe($iframeurl);

// Finish the page.
echo $OUTPUT->footer();
