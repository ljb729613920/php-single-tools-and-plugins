<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 28/12/16
 * Time: 15:07
 */

namespace PHPValidate\Test\Transform;


use JFernando\PHPValidate\Transform\FoneFormatTransformer;
use PHPUnit\Framework\TestCase;

class FoneTransformTest extends TestCase
{

    public function testFoneTransformation()
    {
        $fone1 = '69993010000';
        $fone2 = '6934210000';
        $fone3 = '(69) 3421-0000';

        $transformer = new FoneFormatTransformer();

        $fone1 = $transformer->transform($fone1);
        $fone2 = $transformer->transform($fone2);
        $fone3 = $transformer->transform($fone3);

        $this->assertEquals('(69) 99301-0000', $fone1);
        $this->assertEquals('(69) 3421-0000', $fone2);
        $this->assertEquals('(69) 3421-0000', $fone3);
    }

}