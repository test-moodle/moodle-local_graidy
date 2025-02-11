# Local GRAiDY

# Installation

## Downloading the plugin as a zipped folder
1. Unzip the plugin folder.
2. Copy the plugin folder into moodle/local/.
3. Navigate to the Moodle frontend and follow the installation instructions.
4. Once installed, navigate to /admin/settings.php?section=local_graidy_settings and follow the Web Service setup instructions.
5. Once the token is generated, provide the token to your GRAiDY representative.

## Cloning the plugin from the Git repo
1. cd into moodle/local/.
2. git clone https://github.com/CustomAppsSA-Team/GRAiDY-Plugins.git graidy.
3. Navigate to the Moodle frontend and follow the installation instructions.
4. Once installed, navigate to /admin/settings.php?section=local_graidy_settings and follow the Web Service setup instructions.
5. Once the token is generated, provide the token to your GRAiDY representative.

# Development

## Adding Web service functions

All the Web service functions are defined in graidy/db/services.php and the code is stored in graidy/classes/external/*.
The Web service functions have been broken into their "types" e.g. course or mod. There are some example files set up already.

In services.php, you will find two example functions defined:
1. local_graidy_get_course_info - this is the custom function which has the code stored in graidy/classes/external/course/get_course_info.php.
2. local_graidy_course_get_courses - this is utilising Moodle's Core Web service function course_get_courses.

These examples explain how to add a custom function into the GRAiDY plugin that might be needed or how to reference a Core Web service function without having to write all the code from scratch. It's up to the developer to choose which approach is best depending on the requirements.

The existing commented code can be uncommented and the corresponding Web service files updated when necessary.

See Moodle's documentation for guidance on making changes. For an example, see [Writing a service](https://moodledev.io/docs/4.1/apis/subsystems/external/writing-a-service).

## Updating the role export
1. Ensure the role is already uploaded in Site administration > Users > Permissions > Define roles.
2. Click on the settings cog to edit the role.
3. Once the role has been updated, click the Export button.
4. Copy the file into the local/graidy plugin.
5. If you update the role name, ensure that you change the linked reference to it (variable name $roledownloadurl) in classes/settings/admin_setting_custom_webservicesoverview.php.