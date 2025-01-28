<?php

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/local/graidy/lib.php');

class local_graidy_renderer extends plugin_renderer_base {
    
    /**
     * Render the "GRAiDY Grading" button inside assignments.
     */
    public function render_graidy_button($courseid) {
        global $CFG, $DB, $USER;
    
        // 1. Get the GRAiDY base URL from plugin settings.
        $graidyBaseUrl = get_config('local_graidy', 'baseurl');
    
        // 2. Retrieve the user’s token from the external service.
        //    (You must have an external service with shortname 'my_service_shortname'.)
        $service = $DB->get_record('external_services', ['shortname' => 'local_graidy'], '*', MUST_EXIST);
        $tokenrecord = $DB->get_record('external_tokens', [
            'userid' => $USER->id,
            'externalserviceid' => $service->id
        ], '*', IGNORE_MISSING);
    
        if ($tokenrecord) {
            $token = $tokenrecord->token;
        } else {
            // If no token is found, handle this gracefully.
            // For now, let's just define it as an empty string or show a notice.
            $token = local_graidy_get_or_create_token($USER->id);
        }
    
        // 3. Build the final URL string:
        //    https://baseurl/moodle/course/[courseid]/[token]
        $finalpath = '/moodle/course/' . $courseid . '/' . $token;
        $fullurl   = $graidyBaseUrl . $finalpath;
    
        // 4. Convert to a moodle_url if you like (or use string).
        $targetUrl = new moodle_url($fullurl);
    
        // 5. Render the HTML button that opens in a new tab.
        return html_writer::tag('a',
            get_string('graidy_grading_button', 'local_graidy'),
            [
                'href'   => $targetUrl,
                'class'  => 'btn btn-primary',
                'target' => '_blank',
                'style'  => 'margin-left: 10px;'
            ]
        );
    }

    public function render_iframe($url, $width = '100%', $height = '800px') {
        return html_writer::tag('iframe', '', [
            'src' => $url,
            'width' => $width,
            'height' => $height,
            'frameborder' => '0',
            'allowfullscreen' => 'allowfullscreen',
        ]);
    }
    
}
