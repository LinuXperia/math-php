<?php
namespace MathPHP\Tests\LinearAlgebra;

use MathPHP\LinearAlgebra\VandermondeSquareMatrix;
use MathPHP\LinearAlgebra\Matrix;
use MathPHP\Exception;

class VandermondeSquareMatrixTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderForTestConstructor
     */
    public function testConstructor($M, int $n, $V)
    {
        $M = new VandermondeSquareMatrix($M, $n);
        $V = new Matrix($V);

        $this->assertInstanceOf('MathPHP\LinearAlgebra\VandermondeSquareMatrix', $M);
        $this->assertInstanceOf('MathPHP\LinearAlgebra\Matrix', $M);
        
        $m = $V->getM();
        for ($i = 0; $i < $m; $i++) {
            $this->assertEquals($V[$i], $M[$i]);
        }
        $m = $M->getM();
        for ($i = 0; $i < $m; $i++) {
            $this->assertEquals($V[$i], $M[$i]);
        }
    }

    public function dataProviderForTestConstructor()
    {
        return [
            [
                [1, 2, 3, 4], 4,
                [
                    [1, 1, 1, 1],
                    [1, 2, 4, 8],
                    [1, 3, 9, 27],
                    [1, 4, 16, 64],
                ],
            ],
            [
                [10, 5, 4], 3,
                [
                    [1, 10, 100],
                    [1, 5, 25],
                    [1, 4, 16],
                ],
            ],
        ];
    }

    public function testConstructorException()
    {
        $A = [
            [1, 2, 3],
            [2, 3, 4],
        ];

        $this->setExpectedException(Exception\MatrixException::class);
        $A = new VandermondeSquareMatrix($A, 1);
    }
}