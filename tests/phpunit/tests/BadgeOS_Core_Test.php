<?php

class BadgeOS_Core_Test extends WP_UnitTestCase {

	public function testBadgeOSHasVersionNumber() {
		$this->assertNotNull( BadgeOS::$version );
	}

	public function testBadgeOSDirectoryPathMatches() {
		$this->assertSame( trailingslashit( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ), badgeos_get_directory_path() );
	}

	public function testBadgeOSDirectoryURLMatches() {
		$this->assertSame( trailingslashit( plugins_url( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) ), badgeos_get_directory_url() );
	}

	public function testBadgeOSIsNotInDebugMode() {
		$this->assertFalse( badgeos_is_debug_mode() );
	}

}
