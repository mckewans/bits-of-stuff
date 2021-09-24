<?php

$scores = [80,53,35,99,12,16,66];

usort($scores, function($score1, $score2) {
    return $score1 <=> $score2;
});

print_r($scores);