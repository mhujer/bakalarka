<?php
//https://wiki.jenkins-ci.org/display/JENKINS/Remote+access+API

$jobUrl = "http://localhost:8080/job/shopio-trunk/";
$jobDir = "i:/BP-jenkins/data/jobs/shopio-trunk/workspace/";

$fromRev = 2000;
$toRev = 10497;
$toBuild = 20;

$step = round(($toRev - $fromRev)/$toBuild);
$currentRev = $fromRev;

while ($currentRev <= $toRev) {
    $cmd = "svn update -r $currentRev $jobDir";
    
    echo "SVN: " . exec($cmd) . PHP_EOL;
    
    file_get_contents($jobUrl . 'build');
    sleep(1);
    
    while (isBuilding($jobUrl . "/lastBuild/api/json")) {
        echo "Waiting for build to finish". PHP_EOL;
        sleep(1);
    }    
    
    if ($currentRev == $toRev) { break; }
    $currentRev += $step;
    if ($currentRev > $toRev) { $currentRev = $toRev; }
}


function isBuilding($url) {
    $data = json_decode(file_get_contents($url));
    return $data->building;
}