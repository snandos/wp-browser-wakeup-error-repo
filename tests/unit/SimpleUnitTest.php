<?php

namespace tests\unit;

use UnitTester;

class SimpleUnitTest extends \lucatume\WPBrowser\TestCase\WPTestCase {

	protected UnitTester $tester;

	public function setUp(): void {
	}
	
	public function testOne() {
		$this->tester->assertTrue( true );
	}

}
