<?php

define('CLI_SCRIPT', true);
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

print $course->id;
print "view.php?id=$cm->id";
print $acclaim->name;
print $cm->id;

add_to_log(1111, 'test_log', 'view', "test", "test", 101);

?>
