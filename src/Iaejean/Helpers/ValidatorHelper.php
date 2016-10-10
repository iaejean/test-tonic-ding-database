<?php
declare(strict_types=1);

namespace Iaejean\Helpers;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Validator\Validation;

/**
 * Class ValidatorHelper
 * @package Iaejean\Helpers
 */
class ValidatorHelper
{
    /**
     * @param $instance
     * @param null $groups
     * @param null $constraints
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function validate($instance, $groups = null, $constraints = null)
    {
        $reader = new AnnotationReader();

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping($reader)
            ->getValidator();

        $violations = $validator->validate($instance, $constraints, $groups);

        if ($violations->count() > 0) {
            $msg = [];
            foreach ($violations as $error) {
                $msg[$error->getpropertyPath()] = $error->getMessage();
            }
            throw new \InvalidArgumentException(json_encode($msg), 400);
        }
        return true;
    }
}
