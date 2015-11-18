<?php

function paginate($reload, $page, $tpages) {
    $adjacents = 2;
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $out = "";
    // previous
    if ($page == 1) {
        $out.= "<span style='text-decoration:none; font-size:15px;'>" . $prevlabel . "</span>\n";
    } elseif ($page == 2) {
        $out.= "<li><a style='text-decoration:none;font-size:15px' href=\"" . $reload . "\">" . $prevlabel . "</a>\n</li>";
    } else {
        $out.= "<li><a style='text-decoration:none;font-size:15px' href=\"" . $reload . "&amp;page=" . ($page - 1) . "\">" . $prevlabel . "</a>\n</li>";
    }
  
    $pmin = ($page > $adjacents) ? ($page - $adjacents) : 1;
    $pmax = ($page < ($tpages - $adjacents)) ? ($page + $adjacents) : $tpages;
    for ($i = $pmin; $i <= $pmax; $i++) {
        if ($i == $page) {
            $out.= "<li  class=\"active\"><a href=''>" . $i . "</a></li>\n";
        } elseif ($i == 1) {
            $out.= "<li><a style='text-decoration:none;font-size:15px' href=\"" . $reload . "\">" . $i . "</a>\n</li>";
        } else {
            $out.= "<li><a style='text-decoration:none;font-size:15px' href=\"" . $reload . "&amp;page=" . $i . "\">" . $i . "</a>\n</li>";
        }
    }
    
    if ($page < ($tpages - $adjacents)) {
        $out.= "<a style='text-decoration:none;font-size:15px' href=\"" . $reload . "&amp;page=" . $tpages . "\">" . $tpages . "</a>\n";
    }
    // next
    if ($page < $tpages) {
        $out.= "<li><a style='text-decoration:none;font-size:15px' href=\"" . $reload . "&amp;page=" . ($page + 1) . "\">" . $nextlabel . "</a>\n</li>";
    } else {
        $out.= "<span style='text-decoration:none;font-size:15px'>" . $nextlabel . "</span>\n";
    }
    $out.= "";
    return $out;
}
