<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'graidy', language 'en'
 *
 * @package    local_graidy
 * @copyright  2024 onwards We Envision Ai
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'GRAiDY';
$string['privacy:metadata'] = 'The GRAiDY plugin provides extended functionality to access Moodle data via Web Services. It does not store any personal data.';

// Settings.
// admin_setting_custom_webservicesoverview.php.
$string['baseurl'] = 'Base URL';
$string['baseurl_desc'] = 'Enter the base URL of your GRAiDY instance. Example: https://portal.graidy.tech';
$string['baseurl_heading'] = 'GRAiDY Server Configuration';
$string['baseurl_heading_desc'] = 'Configure the GRAiDY server instance that this Moodle site will connect to.';
$string['organizationtoken'] = 'Organization API Key:';
$string['organizationtoken_desc'] = 'Enter the organization API Key of your GRAiDY instance. Example: trxYh-xxxx-xxxx-xxxx';
$string['organizationtoken_heading'] = 'GRAiDY organization API Key';
$string['organizationtoken_heading_desc'] = 'Configure the GRAiDY organization instance that this Moodle site will connect to.';
$string['graidy_settings'] = 'GRAiDY Settings';
$string['graidy_description'] = 'AI-Powered grading & analytics for Moodle';
$string['graidy_grading_button'] = 'GRAiDY Grading';
$string['graidy_tab'] = 'GRAiDY Grading';
$string['dashboard'] = 'GRAiDY Dashboard';
$string['reports'] = 'GRAiDY Reports';
$string['settings'] = 'GRAiDY Settings';
$string['iframesnotallowed'] = 'GRAiDY IFRAME NOT SUPPORTED';
$string['graidy_iframe_desc'] = 'AI-Powered Grading and Feedback';
$string['graidy_access_denied'] = 'You do not have permission to access GRAiDY';
$string['graidy_missing_role'] = 'You need the "graidy_webservice" role to access this feature';
$string['graidy_assignments'] = 'GRAiDY Assignment Grading';
$string['graidy_quizzes'] = 'GRAiDY Quiz Analytics';
$string['graidy_enable'] = 'Enable GRAiDY Integration';
$string['graidy_api_key'] = 'GRAiDY API Key';
$string['graidy_settings_desc'] = 'Configure GRAiDY integration settings for Moodle';
$string['graidy_no_data'] = 'No data available for this activity';
$string['graidy_sync_now'] = 'Sync with GRAiDY Now';
$string['graidyaccesstomoodle'] = 'Allow GRAiDY access to Moodle';
$string['graidyaccesstomoodledesc'] = 'The following steps help you to set up the Moodle web services to allow GRAiDY to interact with Moodle. This includes setting up a token (security key) authentication method.';
$string['step'] = 'Step';
$string['webservicestatus'] = 'Status';
$string['webservicedesc'] = 'Description';
$string['enablews'] = 'Enable web services';
$string['enablewsdesc'] = 'Web services must be enabled in Advanced features.';
$string['enableprotocols'] = 'Enable protocols';
$string['enableprotocolsdesc'] = 'At least one protocol should be enabled. For security reasons, only protocols that are to be used should be enabled.';
$string['createuser'] = 'Create a specific user';
$string['createuserdesc'] = 'A web services user is required to represent the system controlling Moodle.';
$string['assignroletouser'] = 'Assign role to user';
$string['assignroletouserdesc'] = 'Assign a role to the user created in the previous step. Download the role export file and upload it into the "Use role preset" area:';
$string['selectservice'] = 'Select a service';
$string['selectservicedesc'] = 'A service is a set of web service functions. You will allow the user to access to a new service. On the Add service page check \'Enable\' and \'Authorised users\' options.';
$string['selectspecificuser'] = 'Select a specific user';
$string['selectspecificuserdesc'] = 'Add the web services user as an authorised user.';
$string['createtokenforuser'] = 'Create a token for a user';
$string['createtokenforuserdesc'] = 'Create a token for the user created in the previous step. This token will be used by GRAiDY to authenticate with Moodle.';
$string['enabledocumentation'] = 'Enable developer documentation';
$string['enabledocumentationdesc'] = 'Detailed web services documentation is available for enabled protocols.';
$string['tab_assign'] = 'Graidy Module Overview';
$string['tab_quiz'] = 'Graidy Module Overview';
$string['tab_course'] = 'Graidy Course Overview';
