# Acclaim Integration for Moodle 

## Description 
The Accliam plugin allows to integrate with the Acclaim platform. Badges will be
issued to student who have completed specific courses on moodle. 

## Test Environment Setup 
More detailed description of PHPUnit and writing PHPunit test can be found under moodle documentation 
https://docs.moodle.org/dev/PHPUnit
https://docs.moodle.org/dev/Writing_PHPUnit_tests 

### Composer installation
Composer is a dependency manager for PHP projects. It installs PHP libraries into /vendor/ subdirectory inside your moodle dirroot.

install Composer - http://getcomposer.org/doc/00-intro.md
install PHUnit and dependencies - go to your Moodle dirroot and execute php composer.phar install --dev
## Configure your server
You need to create a new dataroot directory and specify a separate database prefix for the test environment, see config-dist.php for more information.

add $CFG->phpunit_prefix = 'phpu_'; to your config.php file
and $CFG->phpunit_dataroot = '/path/to/phpunitdataroot'; to your config.php file
### Initialise the test environment
Before first execution and after every upgrade the PHPUnit test environment needs to be initialised, this command also builds the phpunit.xml configuration files.

execute php admin/tool/phpunit/cli/init.php
### Execute tests
execute vendor/bin/phpunit from dirroot directory
you can execute a single test case class using class name followed by path to test file vendor/bin/phpunit core_phpunit_basic_testcase lib/tests/phpunit_test.php
it is also possible to create custom configuration files in xml format and use vendor/bin/phpunit -c mytestsuites.xml
### How to add more tests?
create tests/ directory in your add-on
add test file, for example local/mytest/tests/my_test.php file with local_my_test case class that extends basic_testcase or advanced_testcase
add some test_*() methods
execute your new test case vendor/bin/phpunit local_my_testcase local/mytest/tests/my_test.php
execute php admin/tool/phpunit/cli/init.php to get the plugin tests included in main phpunit.xml configuration file
### Windows support
use \ instead of / in paths in examples above
 
