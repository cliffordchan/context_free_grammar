<?php

require __DIR__ . '/../vendor/autoload.php';

use Library\BalancedParenthesis;
use PHPUnit\Framework\TestCase;

/**
 * Class balancedParenthesisTest
 */
final class balancedParenthesisTest extends TestCase
{
    /**
     * @return array
     */
    public function stringProvider()
    {
        return [
            ['', true],
            ['()()[][]{}{}', true],
            ['{{(())}}', true],
            ['{[()]}', true],
            ['{{[[(())]]}}', true],
            ['(())', true],
            ['{[(])}', false],
            ['{{[[(())]}]}', false],
            ['()()())()()', false],
            [')()()', false],
        ];
    }

    /**
     * @return array
     */
    public function unbalancedStringProvider()
    {
        return [
            ['()()('],
            ['((())'],
        ];
    }

    /**
     * @dataProvider stringProvider
     * @param string $subject
     * @param bool $expected
     */
    public function testBalancedParenthesis($subject, $expected)
    {
        $checker = new BalancedParenthesis($subject);
        $this->assertSame($expected, $checker->isValid());
    }

    /**
     * @dataProvider unbalancedStringProvider
     * @expectedException \UnexpectedValueException
     * @param string $subject
     */
    public function testUnbalancedParenthesis($subject)
    {
        $checker = new BalancedParenthesis($subject);
        $checker->isValid();
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testInvalidCharacters()
    {
        $checker = new BalancedParenthesis('aaaaaaa');
        $checker->isValid();
    }
}

