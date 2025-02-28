<?php
namespace App\Helper;

use Illuminate\Support\Facades\DB;

if (!function_exists('returnData')) {
    function returnData($status_code = 2000, $result = null, $message = null, $type = false)
    {
        $data = [];
        if ($status_code) {
            $data['status'] = $status_code;
        }
        if ($result) {
            $data['result'] = $result;
        }
        if ($message) {
            $data['message'] = $message;
        }
        if ($message) {
            $data['message'] = $message;
        }
        if ($type) {
            $data['type'] = $type;
        }
        return response()->json($data);
    }
}

if (!function_exists('can')) {
    function can($permission) {
        if (!auth()->check()) {
            return false;
        }

        $routeName = request()->route()->action['as'] ?? '';

        $slice= explode('.', $routeName);
        $onlyLast = end($slice);
        $onlyFirst = reset($slice);
        $per = $onlyFirst . "_" . $onlyLast;

        $xxx = DB::table('permissions')->where('permission', $per)->first();
        if (!$xxx) {
            return false;
        }

        $ccc = DB::table('role_permissions')->where('permission_id', $xxx->id)->first();
        if (!$ccc) {
            return false;
        }
        return $ccc->role_id == auth()->user()->role_id;
    }

}
