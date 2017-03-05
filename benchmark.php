<?php
namespace PMVC\PlugIn\benchmark;

\PMVC\l(__DIR__.'/src/class.wristwatch.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\benchmark';

use \PMVC\Event;

class benchmark extends \PMVC\PlugIn
{
    public function init()
    {
        $this->setDefaultAlias(new wristwatch());
        $dispatcher = \PMVC\plug('dispatcher');
        $dispatcher->attach($this,Event\B4_PROCESS_VIEW);
        $dispatcher->attach($this,Event\FINISH);
        \PMVC\dev(function(){
            $this->start();
        },'benchmark');
    }

    public function onB4ProcessView()
    {
        $this->tag('b4 process view');
    }

    public function onFinish()
    {
        \PMVC\dev(function(){
            return $this->ReadFlags();
        },'benchmark');
    }

}
