<?php
declare(strict_types=1);

namespace edwrodrig\logger;

/**
 * Class Logger
 * Logger class to log messages with nesting levels.
 * @api
 * @package edwrodrig\logger
 */
class Logger
{
    /**
     * @var resource
     */
    protected $target = STDOUT;

    /**
     * The current nesting level
     * @see Logger::printIndentation()
     * @var int
     */
    private int $current_nesting_level = 0;

    /**
     * The nesting level of the last log.
     *
     * Useful to handle indentation correctly
     * @see Logger::log()
     * @var int
     */
    private int $last_nesting_level = 0;

    /**
     * When anything is written, the last char is considered a new line
     *
     * @return string
     */
    private string $last_character_written = "\n";

    /**
     * Logger constructor.
     *
     * Construct a new logger.
     * @param null|resource $target
     * @uses Logger::setTarget() to set the target
     */
    public function __construct($target = null)
    {
        $this->setTarget($target);
    }

    /**
     * The default
     * @return resource
     */
    public function getDefaultTarget() {
        return STDOUT;
    }

    /**
     * Set the target resource of the logger.
     *
     * Where the logs will be printed.
     * @api
     * @param null|resource $target If is null then the target is set to {@see STDOUT}
     */
    public function setTarget($target) {
        if ( is_resource($target) ) {
            $this->target = $target;
        }
    }

    /**
     * Use this when the message starts a new nesting level.
     *
     * The behaviour is like a opening bracket, the contents are in a superior indentatation than the bracket
     * This message is always indented.
     * ```
     * begin_log
     *      further contents
     *      ...
     * end_log
     * ```
     * @api
     * @param string $message
     * @see Logger:end() log to close a nesting level
     * @return Logger
     */
    public function begin(string $message) : Logger {
        $this->log($message);

        $this->current_nesting_level++;

        return $this;
    }

    /**
     * Use this when the message finishes a nesting level.
     *
     * The behaviour is like a closing bracket, the contents are in a superior indentatation than the bracket
     * ```
     * begin_log
     *      further contents
     *      ...
     * end_log
     * ```
     * @api
     * @param string $message
     * @param bool $indent To indent or to not indent?
     * @return Logger
     * @see Logger:begin() log to open a nesting level
     */
    public function end(string $message = "") : Logger {
        $this->current_nesting_level--;

        $this->log($message, false);
        return $this;

    }

    /**
     * Use this when the message does not start a new nesting level.
     *
     * In other world a normal log.
     * @api
     * @param string $message The message to log
     * @param bool $indent To indent or to not indent?, the default is true because the most common case is to print each log entry in different lines.
     * @return Logger
     */
    public function log(string $message, bool $indent = true) : Logger {
        if ( empty($message) )
            return $this;

        $message = trim ($message);
        $message = str_replace("\n", "\n" . $this->getIndentation(), $message);

        //always indent when there is a change in nesting_level
        if ( $this->last_nesting_level != $this->current_nesting_level ) {
            $this->last_nesting_level = $this->current_nesting_level;
            $indent = true;
        }

        //the indentation can be forced
        if ( $indent ) {
            $this->printIndentation();
        }

        fwrite($this->target, $message);
        $this->last_character_written = substr($message, -1);

        return $this;
    }

    /**
     * Get the indentation string.
     *
     * @api Override then creating your custom loggers
     * @uses Logger::getCurrentNestingLevel()
     * @return string
     */
    protected function getIndentation() : string {
        return str_repeat("  ", $this->getCurrentNestingLevel());
    }

    /**
     * Print the indentation.
     *
     * @api Override then creating your custom loggers
     * @uses Logger::getIndentation()
     */
    protected function printIndentation() : void {

        if ( $this->last_character_written != "\n" ) {
            fwrite($this->target, "\n");
        }

        fwrite(
            $this->target,
            $this->getIndentation()
        );
    }

    /**
     * Get the current level.
     *
     * It may correspond to the indentation level of the log
     * @see Logger::begin() To increase the nesting level
     * @see Logger::end() To decrease the ncesting level
     * @return int
     */
    private function getCurrentNestingLevel() : int {
        return $this->current_nesting_level;
    }
}
