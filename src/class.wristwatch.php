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

    function Read(){
        echo "<code>".$this->GetSec()." sec</code>";
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
        $html='';
        $all=0;
        $html.= "<tr><th>Flag Position</th><th>Time Taken</th><th>Time Difference</th></tr>\n";
        $before = current( $this->time );
        foreach( $this->time as $flag=>$time ){
            $timeDiff = round($time - $before,4);
            if($timeDiff>0){
                $all+=$timeDiff;
            }
            $html.= "<tr><td><code>$flag</code></td>
                <td><code>$time</code></td>
                <td><code>".$timeDiff."</code></td>
                </tr>\n";
            $before = $time;
        }
        $html= '
            <table border="1">
            '.$html.'
            <tr><td>Total</td><td>&#160;</td><td><code>'.round($all,4).'</code></td></tr>
            </table>
            ';
        echo $html;
    }
}

?>
