<?php

namespace App\Http\Controllers;

use Log;
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
    protected $fieldsProduct = ['id', 'name', 'description', 'category_id', 'price', 'quantity', 'state'];

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
        //validate
        $validator = Validator::make($request->toArray(), [
            'product_id' => 'integer|exists:products,id|required',
            //check quantity
            'quantity' => 'integer|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        //apply confines
        try {
            $currentProduct = Product::select(['id', 'name', 'description'])
                ->where([
                    ['id', '=', $request->product_id],
                    ['quantity', '>', $this->params['config']['quantityLimit']],
                    ['price', '>', $this->params['config']['quantityLimit']],
                    ['state', '=', $this->params['config']['state']['on']],
                ])->first();

            if (is_null($currentProduct)) {
                return response()->json([
                    'error' => 'Unable to buy goods. There are restrictions.'
                ]);
            }
            //edit quantity

            $act = [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'product' => $currentProduct->toArray()
            ];
            //write to log file
            Log::info(['createOrder' => $act]);
            return response()->json([
                'success' => true,
                'message' => $act
            ]);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

}
