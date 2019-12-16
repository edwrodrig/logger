<?php
declare(strict_types=1);

namespace edwrodrig\logger;

/**
 * Class TemporaryLogger
 *
 * A Logger that saves their output in a temporary file.
 * It provides a method to {@see TemporaryLogger::getTargetData() get all data logged}
 * @package edwrodrig\logger
 * @api
 */
class TemporaryLogger extends Logger
{
    /**
     * TemporaryLogger constructor.
     * @api
     */
    public function __construct() {
        parent::__construct(
            fopen('php://temp', 'w+')
        );
    }

    /**
     * Always close the temporary target.
     *
     * @api
     */
    public function __destruct()
    {
        fclose($this->target);
    }

    /**
     * Get all the logs.
     *
     * @api
     * @return string
     */
    public function getTargetData() : string {
        rewind($this->target);
        return stream_get_contents($this->target);
    }
}
