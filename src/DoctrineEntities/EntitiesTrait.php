<?php
	namespace DaybreakStudios\Utility\SymfonyPHPUnitHelpers\DoctrineEntities;

	use DaybreakStudios\Utility\DoctrineEntities\EntityInterface;
	use Doctrine\Common\Collections\Collection;

	trait EntitiesTrait {
		/**
		 * @param EntityInterface $expected
		 * @param object          $actual
		 */
		protected function assertEntityEqualsJsonObject(EntityInterface $expected, $actual) {
			$methods = (new \ReflectionClass($expected))->getMethods(\ReflectionMethod::IS_PUBLIC);

			foreach ($methods as $method) {
				if (strpos($method->getName(), 'get') !== 0 || $method->getNumberOfRequiredParameters() > 0)
					continue;

				$attribute = lcfirst(substr($method->getName(), 3));
				$value = $method->invoke($expected);

				if ($value instanceof Collection) {
					$array = [];

					foreach ($value as $key => $item) {
						if ($item instanceof EntityInterface)
							$item = $item->getId();

						$array[$key] = $item;
					}

					$value = $array;
				} else if ($value instanceof EntityInterface)
					$value = $value->getId();

				$this->assertAttributeEquals($value, $attribute, $actual);
			}
		}
	}