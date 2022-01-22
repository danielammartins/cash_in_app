<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UserTraits;
use App\Traits\ExpenseTraits;

class ExpenseController extends Controller
{
    use UserTraits;
    use ExpenseTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Expense::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Checks the DB to make sure there are categories before the user can add a new expense
        if($this->isCategories()) {
            // TODO add all required values
            $request->validate([
                'name' => 'required',
                'value' => 'required',
                'date' => 'required',
            ]);

            $id = $this->getUserID();

            return Expense::create([
                'name' => $request->name,
                'value' => $request->value,
                'date' => $request->date,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'receipt_path' => $request->receipt_path,
                'user' => $id
            ]);
        }
        else {
            return response(['message'=>'No Categories Available'], 404);
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
        return Expense::find($id);
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
        $expense = Expense::find($id);
        $expense->update($request->all());
        return $expense;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Expense::destroy($id);
    }

    /**
     * Search for the specified resource from storage.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        // Only returns if it matches exactly, kept for reference
        //return Expenses::where('name', 'like', '%'.$name.'%')->get();
        // TODO send only ID, name and date
        return Expense::where('name', 'like', '%'.$name.'%')->get();
    }
}
