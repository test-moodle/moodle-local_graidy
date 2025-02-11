<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/webservice/lib.php');
require_once($CFG->libdir . '/externallib.php');
require_once($CFG->dirroot . '/course/externallib.php');

function local_graidy_get_or_create_token($userid) {
    global $DB;

    // 1. Get the external service record by shortname.
    $service = $DB->get_record('external_services', [
        'shortname' => 'local_graidy',  // <-- Change to your actual service shortname
        'enabled'   => 1
    ], '*', MUST_EXIST);

    // 2. Check if the user already has a token for this service.
    $existingtoken = $DB->get_record('external_tokens', [
        'userid'            => $userid,
        'externalserviceid' => $service->id,
    ]);

    if ($existingtoken) {
        // Reuse existing token.
        return $existingtoken->token;
    }

    // 3. Generate a new token if none exists.
    $token = external_generate_token(
        EXTERNAL_TOKEN_PERMANENT, // constant from webservice/lib.php
        $service->id,
        $userid,
        null
    );
    return $token;
}

function local_graidy_extend_settings_navigation(settings_navigation $settingsnav, context $context) {
    global $PAGE;
    global $DB;
    global $USER;

    // Check if the user has access to the external service.
    $service = $DB->get_record('external_services', [
        'shortname' => 'local_graidy',  // <-- Change to your actual service shortname
        'enabled'   => 1
    ], '*', MUST_EXIST);

    
    if (!$service) {
        return; // Service does not exist.
    }

    $user_has_access = $DB->record_exists('external_services_users', [
        'externalserviceid' => $service->id,
        'userid' => $USER->id
    ]);

    if (!$user_has_access) {
        return; // User does not have access to the external service.
    }


    // Check if the context is module-level.
    if ($context->contextlevel === CONTEXT_MODULE) {
        debugging("Context is module-level.");
        if (!$PAGE->cm) {
            // Use $PAGE->set_cm() to set the course module context.
            $cm = get_coursemodule_from_id(null, $context->instanceid, 0, false, MUST_EXIST);
            $PAGE->set_cm($cm);
            debugging("Course Module set using PAGE->set_cm(): " . $PAGE->cm->modname);

        }
    } else {
        debugging("Context is not module-level.");
        return; // Exit if not module-level context.
    }

    if ($PAGE->cm->modname === 'assign' || $PAGE->cm->modname === 'quiz') {
        // Get the settings navigation node (More menu).
        $modulenode = $settingsnav->get('modulesettings');
        $cm = $DB->get_record('course_modules', ['id' => $PAGE->cm->id], 'id, section');


        $quizcmid = $PAGE->cm->id; // Current Quiz Module ID
        $courseid = $PAGE->course->id; // Course ID
        
        // Fetch course sections and modules directly from the database
        $sections = $DB->get_records_sql("
        SELECT cs.id AS sectionid, cs.name AS sectionname, cm.id AS moduleid
        FROM {course_sections} cs
        LEFT JOIN {course_modules} cm ON cm.section = cs.id
        WHERE cs.course = :courseid
        ", ['courseid' => $courseid]);

        // Match the Quiz Module ID with Course Sections
        $matching_section_id = null;
        foreach ($sections as $section) {
        if ($section->moduleid == $quizcmid) { // Match Module ID
            $matching_section_id = $section->sectionid;
            break;
        }
        }


        if ($modulenode) {
            // Add a custom node under the "More" tab.
            $modulenode->add(
                get_string('tab_' . $PAGE->cm->modname, 'local_graidy'), // Tab label
                new moodle_url('/local/graidy/' . $PAGE->cm->modname . '.php', [
                    'courseid' => $PAGE->course->id, // Correct course ID
                    'sectionid' => $PAGE->cm->section, // Correct section ID
                    'moduleid' => $PAGE->cm->id, // Correct module ID
                    'contentid' => $matching_section_id,
                    'type' => $PAGE->cm->modname,
                ]),
                navigation_node::TYPE_CUSTOM,
                null,
                'local_graidy_tab_' . $PAGE->cm->modname
            );
        }
    }
}

function local_graidy_extend_navigation_course(navigation_node $parentnode, stdClass $course, context_course $context) {
    global $DB;
    global $USER;

    // Check if the user has access to the external service.
    $service = $DB->get_record('external_services', [
        'shortname' => 'local_graidy',  // <-- Change to your actual service shortname
        'enabled'   => 1
    ], '*', MUST_EXIST);

    
    if (!$service) {
        return; // Service does not exist.
    }

    $user_has_access = $DB->record_exists('external_services_users', [
        'externalserviceid' => $service->id,
        'userid' => $USER->id
    ]);

    if (!$user_has_access) {
        return; // User does not have access to the external service.
    }

    // Create the URL with the "id" param set to the course's ID.
    $url = new moodle_url('/local/graidy/course.php', ['courseid' => $course->id]);

    // Add a navigation node.
    $parentnode->add(
        get_string('tab_course', 'local_graidy'),
        $url,
        navigation_node::TYPE_CUSTOM
    );
}


function local_graidy_inject_button_in_assignment(\mod_assign\event\course_module_viewed $event) {
    global $PAGE, $OUTPUT, $DB;

    debugging('[GRAiDY] Injecting button into assignment page.', DEBUG_DEVELOPER);

    // Get course module details from the event.
    $cmid = $event->contextinstanceid;
    $cm = get_coursemodule_from_id('assign', $cmid);

    if (!$cm) {
        debugging('[GRAiDY] ERROR - Could not fetch course module.', DEBUG_DEVELOPER);
        return;
    }

    // Get course details.
    $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);

    // Load the renderer.
    $renderer = $PAGE->get_renderer('local_graidy');

    // Output the button.
    echo $renderer->render_graidy_button($course->id);
}