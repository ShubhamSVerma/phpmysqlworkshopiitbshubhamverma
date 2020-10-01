<?php
    function check($choice){
        switch($choice){
            case 'A':
            case 'E':
            case 'I':
            case 'O':
            case 'U':
            case 'a':
            case 'e':
            case 'i':
            case 'o':
            case 'u': echo "$choice is a vowel.<br>"; break;
            default: echo "$choice is consonant<br>"; break;
        }
    }

    $word = array("A","R","I","G","A","T","O");
    
    foreach($word as $letter){
        check($letter);
    }
?>