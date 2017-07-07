<?php
	namespace DaybreakStudios\Utility\SymfonyPHPUnitHelpers;

	use DaybreakStudios\Utility\SymfonyPHPUnitHelpers\DoctrineEntities\EntitiesTrait;
	use DaybreakStudios\Utility\SymfonyPHPUnitHelpers\DoctrineFixtures\FixturesTrait;
	use Liip\FunctionalTestBundle\Test\WebTestCase as LiipWebTestCase;
	use Symfony\Component\HttpKernel\Client;

	class WebTestCase extends LiipWebTestCase {
		use FixturesTrait;
		use EntitiesTrait;

		/**
		 * @var Client
		 */
		protected $client;

		/**
		 * @param array $fixtures
		 */
		protected function setUp(array $fixtures = []) {
			if ($fixtures)
				$this->initFixtures($fixtures);

			$this->client = $this->makeClient();
		}
	}