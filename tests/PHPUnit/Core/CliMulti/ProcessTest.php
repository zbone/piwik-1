<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
use Piwik\CliMulti\Process;

/**
 * Class ProcessTest
 * @group Core
 */
class ProcessTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Process
     */
    private $process;

    public function setUp()
    {
        $this->process = new Process('testPid');
    }

    public function tearDown()
    {
        $this->process->finishProcess();
    }

    public function test_construct_shouldBeNotStarted_IfPidJustCreated()
    {
        $this->assertFalse($this->process->hasStarted());
    }

    public function test_construct_shouldBeNotRunning_IfPidJustCreated()
    {
        $this->assertFalse($this->process->isRunning());
    }

    public function test_startProcess_finishProcess_ShouldMarkProcessAsStarted()
    {
        $this->assertFalse($this->process->isRunning());
        $this->assertFalse($this->process->hasStarted());

        $this->process->startProcess();

        $this->assertTrue($this->process->isRunning());
        $this->assertTrue($this->process->hasStarted());
        $this->assertTrue($this->process->isRunning());
        $this->assertTrue($this->process->hasStarted());

        $this->process->startProcess();

        $this->assertTrue($this->process->isRunning());
        $this->assertTrue($this->process->hasStarted());

        $this->process->finishProcess();

        $this->assertFalse($this->process->isRunning());
        $this->assertTrue($this->process->hasStarted());
    }

    public function test_finishProcess_ShouldNotThrowError_IfNotStartedBefore()
    {
        $this->process->finishProcess();

        $this->assertFalse($this->process->isRunning());
        $this->assertTrue($this->process->hasStarted());
    }
}