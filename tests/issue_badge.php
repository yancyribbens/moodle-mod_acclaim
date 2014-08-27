<?php
/**
 * Unit tests for (some of) mod/acclaim.
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package question
 */
 
global $CFG;
global $DB;
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); //  It must be included from a Moodle page
} 
require_once($CFG->dirroot . '/mod/acclaim/lib.php'); // Include the code to test
interface HttpRequest{
    public function setOption($name, $value);
    public function execute();
    public function getInfo($name);
    public function close();
}
 class CurlRequest implements HttpRequest{
    private $handle = null;

    public function __construct($url) {
        $this->handle = curl_init($url);
    }

    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }

    public function execute() {
        return curl_exec($this->handle);
    }

    public function getInfo($name) {
        return curl_getinfo($this->handle, $name);
    }

    public function close() {
        curl_close($this->handle);
    }
} 
class badge_issuing_test extends advanced_testcase {
	protected $badgeid;
	protected $course;
	protected $user; 

    protected function setup(){
	global $CFG;
	global $DB;
	$this->resetAfterTest(true);
	$CFG->enablecompletion = true;
        $user = $this->getDataGenerator()->create_user();
	$setup= new stdClass();
	$setup->api ="https://jefferson-staging.herokuapp.com/api/v1/organizations/6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c/badges";
	$setup->badge_template_id="badge_template_id";
	$setup->issued_to_first_name="Hai";
	$setup->issued_to_last_name="Ribbens";
	$setup->recipient_email="leehigh0316@Hotmail.com";
	$setup->issued_at="2014-04-01 09:41:00 -0500";
	$setup->expires_at="2018-04-01 09:41:00 -0500";
	$setup->token="FZ1QZ4sDtEwNR7Tcv-Yi";
	$setup->org_id="6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c";
	$this->badgeid = $DB->insert_record('acclaim', $setup);

	//Course created with activity and auto completion tracking 
	$this->course = $this->getDataGenerator()->create_course(array('enablecompletion' => true));
        $this->user = $this->getDataGenerator()->create_user();
        $studentrole = $DB->get_record('role', array('shortname' => 'student'));
        $this->assertNotEmpty($studentrole);

	// Get manual enrolment plugin and enrol user.
        require_once($CFG->dirroot.'/enrol/manual/locallib.php');
        $manplugin = enrol_get_plugin('manual');
        $maninstance = $DB->get_record('enrol', array('courseid' => $this->course->id, 'enrol' => 'manual'), '*', MUST_EXIST);
        $manplugin->enrol_user($maninstance, $this->user->id, $studentrole->id);
        $this->assertEquals(1, $DB->count_records('user_enrolments'));
	$completionauto = array('completion' => COMPLETION_TRACKING_AUTOMATIC);
        $this->module = $this->getDataGenerator()->create_module('forum', array('course' => $this->course->id), $completionauto);
	}
	
    public function test_create_badge() {
        $badge = new stdclass();
        $this->assertInstanceOf('config', $badge);
        $this->assertEquals($this->badgeid, $badge->id);
    }
public function testGetThrowsWhenContentTypeIsNotJson() {
    $http = $this->getMock('HttpRequest');
    $http->expects($this->any())
         ->method('getInfo')
         ->will($this->returnValue('not JSON'));
    $this->setExpectedException('HttpResponseException');
    // create class under test using $http instead of a real CurlRequest
    $fixture = new ClassUnderTest($http);
    $fixture->get();
}

}
?>

