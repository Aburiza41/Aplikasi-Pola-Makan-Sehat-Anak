<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FoodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Debugging
        // dd('Hello World!');

        // Get All Food Groups
        $food_groups = \App\Models\FoodGroup::paginate(10);

        // Return a view
        return view('pages.admin.food_group.index', compact('food_groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        // Return a view
        return view('pages.admin.food_group.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Debugging
        // dd($request->all());

        // Validate Request
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ],
            [
                'name.required' => 'The name field is required.',
                'name.string' => 'The name field must be a string.',
                'name.max' => 'The name field must not exceed 255 characters.',
                'description.string' => 'The description field must be a string.',
                'description.max' => 'The description field must not exceed 255 characters.',
            ]
        );

        // Check Validation
        if ($validator->fails()) {
            // Set Alert Message from first error
            Alert::error('Kesalahan', $validator->errors()->first());

            // Redirect Back
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Debugging
        // dd('Hello World!');

        // Set Slug
        $request->merge([
            'slug' => \Str::slug($request->name),
        ]);

        // Store Data to Database Table via Model with Mass Assignment from $request
        \App\Models\FoodGroup::create($request->all());

        // Set Alert Message
        Alert::success('Berhasil', 'Data ' . $request->name . ' berhasil ditambahkan.');

        // Redirect to Index
        return redirect()->route('admin.food_group.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Image Upload
     */
    public function image(Request $request)
    {
        // Debugging
        // dd($request->all());

        if ($request->hasFile('upload')) {
            // Get File
            $file = $request->file('upload');

            // Get File Name
            $file_name = $file->getClientOriginalName();

            // Rename File
            $new_file_name = time() . '_' . $file_name;

            // Store File
            $file->storeAs('public/media', $new_file_name);

            // Get File URL
            $file_url = asset('storage/media/' . $new_file_name);

            return response()->json([
                'fileName' => $new_file_name,
                'uploaded' => 1,
                'url' => $file_url,
            ]);
        }
    }
}
