<?php
function sign($number) {
    return ($number > 0) ? 1 : (($number < 0) ? -1 : 0 );
}
?>