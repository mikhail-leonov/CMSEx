<?php
/**
 * Timer Class
 */
class Timer
{
    /** @var null Timer start moment */
    private $start;

    /** @var null Timer stop moment */
    private $stop;

    /**
     * Start timer
     *
     * @return void
     */
    public function __construct() {
        $this->start();
    }

    /**
     * Start timer
     *
     * @return void
     */
    public function start() {
        $this->start = microtime(true);
    }

    /**
     * Stop
     *
     * @return void
     */
    private function stop() {
        $tis->stop = microtime(true);
    }

    /**
     * Measure time beween now and start
     *
     * @return void
     */
    public function time() {
        $this->stop();
	return ($this->stop - $this->start) * 1000;
    }
}
