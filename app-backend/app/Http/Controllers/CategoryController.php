<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\UserTraits;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use UserTraits;

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
        // TODO add all required values
        $request->validate([
            'name' => 'required',
            'main_category' => 'required'
        ]);

        // Verifies whether the category already exists
        if(Category::select('id')->where('name','LIKE', $request->name)->first() == null) {
            $id = $this->getUserID();

            if($request->main_category == 0) {
                return Category::create([
                    'name' => $request->name,
                    'main_category' => 0,
                    'user' => $id
                ]);
            }
            else {
                $main = Category::select('id')->where('name','LIKE', $request->main_category)->first();
                return Category::create([
                    'name' => $request->name,
                    'main_category' => $main->id,
                    'user' => $id
                ]);
            }
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
    public function update(Request $request, $id)
    {
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
