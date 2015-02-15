<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Support\Collection;

function formatDate($array) {
    $telo = explode(' ', $array);
    $kampret = $telo[2] . ' ' . $telo[1] . ' ' . $telo[3];
    $string = date('d/m/Y', strtotime($kampret));
    return $string;
}

function getDateDiff($from, $to) {
    $from = str_replace('/', '-', $from);
    $to = str_replace('/', '-', $to);
    $from = date('Y-m-d', strtotime($from));
    $to = date('Y-m-d', strtotime($to));
    $datetime1 = new DateTime($from);
    $datetime2 = new DateTime($to);
    $interval = $datetime1->diff($datetime2);
    return $interval;
}
