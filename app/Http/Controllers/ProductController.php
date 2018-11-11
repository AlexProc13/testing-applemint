<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var array
     */

    protected $fields = ['id', 'name', 'description', 'category_id', 'price', 'quantity', 'state'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->toArray(), [
            'name' => 'string|min:3|max:100|required',
            'description' => 'string|min:3|max:1000|required',
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

    public function read(Request $request)
    {
        //validate
        $requestArray = $request->toArray();
        $requestArray['id'] = $request->id;
        $validator = Validator::make($requestArray, [
            'id' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        //act
        try {
            $product = Product::select($this->fields)
                ->with('category:id,name,description,alias,state')->where('id', $request->id)->firstOrFail();;
            return response()->json($product);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function update(Request $request)
    {
        //validation
        $requestArray = $request->toArray();
        $requestArray['id'] = $request->id;
        $validator = Validator::make($requestArray, [
            'name' => 'string|min:3|max:100',
            'description' => 'string|min:3|max:1000',
            'category_id' => 'integer|exists:categories,id',
            'price' => 'numeric|min:0.01',
            'quantity' => 'integer',
            'state' => 'integer|between:0,1',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $updateFields = $request->only($this->fields);
        if (empty($updateFields)) {
            return $this->error();
        }
        //act
        try {
            Product::where('id', $request->id)->update($updateFields);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function delete(Request $request)
    {
        //validate
        $requestArray = $request->toArray();
        $requestArray['id'] = $request->id;
        $validator = Validator::make($requestArray, [
            'id' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        //act
        try {
            $status = Product::where('id', $request->id)->delete();
            return response()->json([
                'success' => boolval($status)
            ]);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function list()
    {
        //validate empty
        try {
            $products = Product::select($this->fields)->with('category:id,name,description,alias,state')->get();
            return response()->json($products);
        } catch (\Exception $e) {
            $this->error();
        }
    }
}
