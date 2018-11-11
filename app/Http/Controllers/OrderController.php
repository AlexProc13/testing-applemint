<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var array
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->params['config'] = config('app');
    }

    public function create(Request $request)
    {
        dd(1);
        $validator = Validator::make($request->toArray(), [
            'name' => 'string|min:3|max:100|required',
            'product_id' => 'string|min:3|max:1000|required',
            'category_id' => 'integer|exists:categories,id|required',
            'price' => 'numeric|min:0.01|required',
            'quantity' => 'integer|required',
            'state' => 'integer|between:0,1|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $fieldsCreate = $request->only($this->fields);

        try {
            Product::create($fieldsCreate);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

}
