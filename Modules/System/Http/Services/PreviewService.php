<?php

namespace Modules\System\Http\Services;

class PreviewService
{
    public function data($repository, $code, $relation = false)
    {
        $linen = $repository;
        $data = $code->all();
        $preview = null;

        if (isset($data['from']) && !empty($data['from'])) {
            $linen = $linen->whereDate('item_linen_created_at', '>=', $data['from']);
        }
        if (isset($data['to']) && !empty($data['to'])) {
            $linen = $linen->whereDate('item_linen_created_at', '<=', $data['to']);
        }

        // DB::enableQueryLog(); // Enable query log

        // print_r( $linen->filter()->getBindings() );
        // dd($linen->filter()->toSql());

        $preview = $linen->filter()->get();
        // dd(DB::getQueryLog()); // Show results of log

        return $preview;
    }
}
