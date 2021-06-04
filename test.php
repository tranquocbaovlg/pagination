<?php
    function dd($data){
        echo '<pre>';
        if(is_array($data)){
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }
?>