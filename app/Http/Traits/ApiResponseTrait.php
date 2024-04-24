<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    protected function respondJsonOrView($data, $view = null)
    {
        if (request()->ajax() || request()->wantsJson()) {
            return $data;
        } else {
            return view($view, $data);
        }
    }
}
