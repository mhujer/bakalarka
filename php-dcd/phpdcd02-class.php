<?php
class Test {
    function notCalled() {
        return true;
    }

    function called() {
        return true;
    }
}
$t = new Test();
$t->called();