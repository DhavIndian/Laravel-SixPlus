<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use File;
use Illuminate\Http\Request;
use Validator;

class ProductController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$products = Product::all();
		return $this->sendResponse($products->toArray(), 'Products retrieved successfully.');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$input = $request->all();

		$validator = Validator::make($input, [
			'name' => 'required',
			'detail' => 'required',
			'image.*' => 'mimes:jpg,jpeg,png|max:4096',
		]);

		if ($request->hasFile('image')) {
			$allowedfileExtension = ['jpeg', 'jpg', 'png'];
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$check = in_array($extension, $allowedfileExtension);
			if ($check) {
				$destinationPath = 'uploads/images';
				$file->move($destinationPath, $file->getClientOriginalName());
				$input['image'] = $destinationPath . "/" . $file->getClientOriginalName();
			} else {
				return $this->sendError('Please Uplod Png and Jpg Only', $validator->errors());
			}

		}

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$product = Product::create($input);

		return $this->sendResponse($product->toArray(), 'Product created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$product = Product::find($id);
		if (is_null($product)) {
			return $this->sendError('Product not found.', 300);
		}
		return $this->sendResponse($product->toArray(), 'Product retrieved successfully.');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Product $product) {
		$input = $request->all();
		$validator = Validator::make($input, [
			'name' => 'required',
			'detail' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}

		$product->name = $input['name'];
		$product->detail = $input['detail'];
		$product->save();
		return $this->sendResponse($product->toArray(), 'Product updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Product $product) {
		$id = $product->id;
		$unlink_p = Product::find($id, ['image']);
		$filename = $unlink_p['image'];
		$product->delete();
		File::delete($filename);
		return $this->sendResponse($product->toArray(), 'Product deleted successfully.');
	}
}