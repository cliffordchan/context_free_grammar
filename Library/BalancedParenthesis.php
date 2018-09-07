<?php

namespace Library;

/**
 * Class BalancedParenthesis
 * @package Library
 */
class BalancedParenthesis
{
    /**
     * @var string
     */
    private $string;

    /**
     * BalancedParenthesis constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if (empty($this->string)) {
            return true;
        }

        $parenthesisMap = ['}' => '{', ')' => '(', ']' => '['];
        $stack = [];

        foreach (str_split($this->string) as $character) {
            switch ($character) {
                case '{':
                case '(':
                case '[':
                    $stack[] = $character;
                    break;

                case '}':
                case ')':
                case ']':
                    $element = array_pop($stack);
                    if (is_null($element) || $element !== $parenthesisMap[$character]) {
                        return false;
                    };
                    break;

                default:
                    throw new \OutOfBoundsException('String contains invalid character');
            }
        }

        if (count($stack) !== 0) {
            throw new \UnexpectedValueException('Elements remain in stack');
        }

        return true;
    }
}
