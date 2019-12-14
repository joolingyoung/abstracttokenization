<?php

use App\Property;
use Illuminate\Support\Facades\DB;


class PropertyDataHelper
{
    /**
     * Get Cap Table data
     * @param String $type
     * @param String $userid
     */
    public static function getPropertyData($type, $id, $userid)
    {
        if (!isset($type) || !isset($userid)) {
            return false;
        }

        if ($type === 'fund') {
            $table = 'security_fund_flow';
            $q = 'fund-name as name';
        } else if ($type === 'property') {

            $table = 'security_flow_property';
            $q = 'property as name';
        } else if ($type === 'sproperty') {

            $table = 'property';
            $q = 'name';
        }

        if ($type === 'sproperty') {
            $data = Property::find($id);
        } else {
            $data = DB::table($table)
                ->where('userid', $userid)
                ->where('id', $id)
                ->select($q, 'id', 'userid', 'captables')
                ->first();
        }

        return $data;
    }
}
