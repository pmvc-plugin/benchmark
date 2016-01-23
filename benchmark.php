<?php
namespace PMVC\PlugIn\benchmark;

\PMVC\l(__DIR__.'/src/class.wristwatch.php');

${_INIT_CONFIG}[_CLASS] = __NAMESPACE__.'\benchmark';

class benchmark extends \PMVC\PlugIn
{
    public function init()
    {
        $this->setDefaultAlias(new wristwatch());
        \PMVC\call_plugin(
            'dispatcher',
            'attach',
            array(
                $this,
                \PMVC\Event\FINSH
            )
        );
    }

    public function tag($s=null){
        $this->SetFlag($s);
    }

    public function onFinish()
    {
        $this->ReadFlags();
    }

}
