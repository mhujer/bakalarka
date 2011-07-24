<?php
function notCalled() {
    return false;
}

function called() {
    return true;
}
var_dump(called());