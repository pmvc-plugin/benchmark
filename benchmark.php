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
        $this->start();
        $dispatcher = \PMVC\plug('dispatcher');
        $dispatcher->attachAfter($this,Event\MAP_REQUEST);
    }

    public function onMapRequest()
    {
        \PMVC\dev(function(){
            $dispatcher = \PMVC\plug('dispatcher');
            $dispatcher->attach($this,Event\WILL_PROCESS_VIEW);
            $dispatcher->attach($this,Event\FINISH);
            $this->tag('Get user request');
        },'benchmark');
    }

    public function onWillProcessView()
    {
        $this->tag('Will process view');
    }

    public function onFinish()
    {
        \PMVC\dev(function(){
            return $this->ReadFlags();
        },'benchmark');
    }

}
