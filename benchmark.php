<?php
namespace PMVC\PlugIn\benchmark;

\PMVC\l(__DIR__.'/src/class.wristwatch.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\benchmark';

class benchmark extends \PMVC\PlugIn
{
    public function init()
    {
        $this->setDefaultAlias(new wristwatch());
        \PMVC\plug('dispatcher')->attach($this,\PMVC\Event\FINISH);
        \PMVC\plug('dispatcher')->attach($this,\PMVC\Event\B4_PROCESS_VIEW);
    }

    public function tag($s=null)
    {
        $this->SetFlag($s);
    }

    public function onB4ProcessView()
    {
        $this->tag('b4 process view');
    }

    public function onFinish()
    {
        $this->ReadFlags();
    }

}
