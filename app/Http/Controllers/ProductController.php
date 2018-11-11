<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var array
     */

    protected $fields = ['id', 'name', 'category_id', 'price', 'quantity', 'state'];

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
            'alias' => 'string|min:3|max:30|required',
            'state' => 'integer|between:0,1|required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        try {
            Category::create(
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'alias' => $request->alias,
                    'state' => $request->state,
                ]
            );
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
            $caterory = Category::select($this->fields)->where('id', $request->id)->firstOrFail();
            return response()->json($caterory);
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function update(Request $request)
    {
        $requestArray = $request->toArray();
        $requestArray['id'] = $request->id;
        $validator = Validator::make($requestArray, [
            'id' => 'integer|required',
            'name' => 'string|min:3|max:100',
            'description' => 'string|min:3|max:1000',
            'alias' => 'string|min:3|max:30',
            'state' => 'integer|between:0,1',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }

        $updateFields = $request->only($this->fields);
        if (empty($updateFields)) {
            return $this->error();
        }

        try {
            Category::where('id', $request->id)->update($updateFields);
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
            $status = Category::select($this->fields)->where('id', $request->id)->delete();
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
            $categories = Category::select($this->fields)->get();
            return response()->json($categories);
        } catch (\Exception $e) {
            $this->error();
        }
    }
}
