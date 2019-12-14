<?php

function dateFromRow($row) {
    if (isset($row) && $row != '') {
        return date('Y-m-d', strtotime(is_object($row) ?  $row->date : $row));
    } else {
        return null;
    }
}
