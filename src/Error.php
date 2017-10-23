<?php
namespace LeaseCloud;

use Exception;

/**
 * Class Error
 *
 * @package LeaseCloud
 */
class Error extends Exception
{
    /**
     * Error constructor.
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * Stringify error info
     *
     * @return string
     */
    public function __toString()
    {
        $message = explode("\n", parent::__toString());
        return implode("\n", $message);
    }
}