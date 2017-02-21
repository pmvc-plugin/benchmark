<?php
namespace PMVC\PlugIn\benchmark;
class WRISTWATCH{

    function GetMicrotime(){  // From PHP manual
        list($usec, $sec) = explode(" ", microtime());
        return round((float)$usec + (float)$sec, 4);
    }

    function Start(){
        $this->SetFlag('start');	
    }

    function End(){
        $this->SetFlag('end');	
    }

    function GetSec(){
        return $this->time['end']-$this->time['start'];
    }

    function SetFlag($flag = ""){
        if( $flag ){
            $this->time[$flag] = WRISTWATCH::GetMicrotime();
        }
        else{
            $this->time[] = WRISTWATCH::GetMicrotime();
        }
    }
	
    function ReadFlags(){
        if(!isset($this->time['end'])){
            $this->End();
        }
        asort($this->time);
        $all=0;
        $data = [[
            'Flag Positio',
            'Time Taken',
            'Time Difference'
        ]];
        $before = current( $this->time );
        foreach( $this->time as $flag=>$time ){
            $timeDiff = round($time - $before,4);
            if($timeDiff>0){
                $all+=$timeDiff;
            }
            $data[] = [
                $flag,
                $time,
                $timeDiff
            ];
            $before = $time;
        }
        $data[] = [
            'Total',
            '',
            round($all,4)
        ];
        return $data;
    }
}

