<?php
	namespace DaybreakStudios\Utility\SymfonyPHPUntHelpers;

	use DaybreakStudios\Utility\SymfonyPHPUntHelpers\DoctrineEntities\EntitiesTrait;
	use DaybreakStudios\Utility\SymfonyPHPUntHelpers\DoctrineFixtures\FixturesTrait;
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