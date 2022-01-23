<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UserTraits;
use App\Traits\ExpenseTraits;
use App\Traits\CategoryTraits;

class ExpenseController extends Controller
{
    use UserTraits;
    use ExpenseTraits;
    use CategoryTraits;

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
                'category_name' => 'required'
            ]);

            $idCategory = $this->getCategoryID($request->category_name);

            $id = $this->getUserID();

            return Expense::create([
                'name' => $request->name,
                'value' => $request->value,
                'date' => $request->date,
                'category_id' => $idCategory,
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
    
    public function showByDate(Request $request) {

        $data = $request->validate([
            'date_begin' => 'required',
            'date_end' => 'required'
        ]);


        // By default, where conditions are chaining with AND operator
       //Expense::all()->where('date','>',$data['date_begin'])->where('date', '<', $data['date_end'])->sortBy('date');
        $list = Expense::all()->where('date','>',$data['date_begin'])->where('date', '<', $data['date_end'])->sortBy('date')->sortBy('date');

        $arr = [];
        $i=0;
        foreach ($list as $f => $v) {
            $arr[$i] = $v;
            $i++;
        }

        return $arr;

    } 

    public function showByCategory(Request $request) {

        $data = $request->validate([
            'category_name' => 'required|string',
            'date_begin' => 'required|string',
            'date_end' => 'required|string'
        ]);

        $id = $this->getCategoryID($data['category_name']);

        // By default, where conditions are chaining with AND operator
        $list = Expense::all()->where('category_id', '=', $id)->where('date','>',$data['date_begin'])->where('date', '<', $data['date_end'])->sortBy('date');

        $arr = [];
        $i=0;
        foreach ($list as $f => $v) {
            $arr[$i] = $v;
            $i++;
        }

        return $arr;
    }  


    /** 
     * Returns the total expected value of the monthly expenses in a given category
    **/

    public function expectedMonthlyExpensesByCategory(Request $request) {
        $data = $request->validate([
            'category_name' => 'required|string'
        ]);

        $id = $this->getCategoryID($data['category_name']);

        // Get the begin and end dates of last month
        $begin_month = date("Y-m-d", strtotime("first day of previous month"));
        $end_month = date("Y-m-d", strtotime("last day of previous month"));

        // Get all expenses from a given category
        $expenses = Expense::where('category_id', '=', $id)->where('date','>=',$begin_month)->where('date', '<=', $end_month)->get('value');

        $count = 0;

        // Total expenses of the pasth month
        for($i=0;$i<sizeof($expenses);$i++) {
            $count += $expenses[$i]->value;
        }

        return $count;
    }

    /** 
     * Returns the total expected value of the monthly expenses 
    **/

    public function expectedMonthlyExpenses(Request $request) {

        // Get the begin and end dates of last month
        $begin_month = date("Y-m-d", strtotime("first day of previous month"));
        $end_month = date("Y-m-d", strtotime("last day of previous month"));

        // Get all expenses from a given category
        $expenses = Expense::where('date','>=',$begin_month)->where('date', '<=', $end_month)->get('value');

        $count = 0;

        // Total expenses of the pasth month
        for($i=0;$i<sizeof($expenses);$i++) {
            $count += $expenses[$i]->value;
        }

        // Return the total expected of the given category
        return $count;
    }
}
    

