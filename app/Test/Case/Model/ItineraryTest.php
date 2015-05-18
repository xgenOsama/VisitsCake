<?php
App::uses('Itinerary', 'Model');

/**
 * Itinerary Test Case
 *
 */
class ItineraryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.itinerary',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Itinerary = ClassRegistry::init('Itinerary');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Itinerary);

		parent::tearDown();
	}

}
