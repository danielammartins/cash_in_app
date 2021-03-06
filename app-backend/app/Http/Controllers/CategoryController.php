<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\UserTraits;
use Illuminate\Support\Facades\DB;
use App\Traits\CategoryTraits;

class CategoryController extends Controller
{
    use UserTraits;
    use CategoryTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'main_category' => 'nullable',
            'max' => 'nullable'
        ]);

        // Verifies whether the category already exists
        if(Category::select('id')->where('name','LIKE', $request->name)->first() == null) {

            /*  If the main_category field is empty, the category is a main category.
            If it's not empty, the category is a subcategory  */
            if(!empty($request->input('main_category'))) {
                $idCategory = $this->getCategoryID($request->main_category);
            } else {
                $idCategory = 0;       
            }

            $id = $this->getUserID();

            return Category::create([
                'name' => $request->name,
                'main_category' => $idCategory,
                'user' => $id,
                'max' => $request->max,
                'min' => $request->min
            ]);
        }
        else {             
            return response(['message'=>'The chosen category name is already taken!'], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required|string'
        ]);

        $id = $this->getCategoryID($data['category_name']);

        $category = Category::find($id);
        $category->update($request->all());
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Category::destroy($id);
    }

    public function search($name)
    {
        return Category::where('name', 'like', '%'.$name.'%')->get();
    } 
}
