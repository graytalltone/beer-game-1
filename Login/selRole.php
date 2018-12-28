<?php
require_once("dbconfig.php");
    function selectRole(){
        $role='';
        $btns = array(
                    1=>'Factory',
                    2=>'Distributor',
                    3=>'Wholesaler',
                    4=>'Retailer',
                    );
        while(list($k,$v)=each($btns)){
            $role.='&nbsp;<input type="submit" value="'.$v.'" name="btn_'.$k.'" id="btn_'.$k.'"/>';
        }
        return $role;
    }
?>