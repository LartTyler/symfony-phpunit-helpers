<?php
	namespace DaybreakStudios\Utility\SymfonyPHPUntHelpers\DoctrineFixtures;

	use Doctrine\Common\DataFixtures\Executor\AbstractExecutor;
	use Doctrine\Common\DataFixtures\ReferenceRepository;

	trait FixturesTrait {
		/**
		 * @var ReferenceRepository|null
		 */
		private $fixtures = null;

		/**
		 * @param array $fixtures
		 */
		public function initFixtures(array $fixtures) {
			$method = (new \ReflectionClass(get_class()))->getMethod('loadFixtures');

			if (!$method)
				throw $this->createNotSupportedException();

			/** @var AbstractExecutor $executor */
			$executor = $method->invoke($this, $fixtures);

			$this->fixtures = $executor->getReferenceRepository();
		}

		/**
		 * @return object[]
		 */
		public function getReferences() {
			if (!$this->fixtures)
				throw $this->createNotInitializedException();

			return $this->fixtures->getReferences();
		}

		/**
		 * @param string $prefix
		 *
		 * @return object[]
		 */
		protected function getPrefixedReferences($prefix) {
			if (!$this->fixtures)
				throw $this->createNotInitializedException();

			// A prefix should be separated from the rest of the key by a period
			$prefix .= '.';

			$matched = [];

			foreach ($this->fixtures->getReferences() as $key => $fixture)
				if (strpos($key, $prefix) === 0)
					$matched[$key] = $fixture;

			return $matched;
		}

		/**
		 * @param string $name
		 *
		 * @return object
		 */
		public function getReference($name) {
			if (!$this->fixtures)
				throw $this->createNotInitializedException();

			return $this->fixtures->getReference($name);
		}

		/**
		 * @return \BadMethodCallException
		 */
		private function createNotSupportedException() {
			return new \BadMethodCallException(get_class() . ' does not support fixtures');
		}

		/**
		 * @return \BadMethodCallException
		 */
		private function createNotInitializedException() {
			return new \BadMethodCallException('Please call initFixtures before working with your fixtures');
		}
	}