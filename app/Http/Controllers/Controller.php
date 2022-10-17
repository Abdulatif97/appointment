<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     version="1.0",
     *     title="Example for response examples value"
     * )
     */
    /**
     * @OA\PathItem(path="/api")
     */


    /**
     * @OA\Schema(
     *  schema="Result",
     *  title="Sample schema for using references",
     * 	@OA\Property(
     * 		property="status",
     * 		type="string"
     * 	),
     * 	@OA\Property(
     * 		property="error",
     * 		type="string"
     * 	)
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}
