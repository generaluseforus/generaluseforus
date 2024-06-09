<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected $userData;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $this->userData = Auth::user();
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        return view('accounts/home', ['userData' => $this->userData]);
    }

    public function index()
    {
        return view('accounts/index');
    }

    public function report(Account $account, $id = NULL)
    {
        if($id == NULL || $id == 'all') {
            $accountData = Account::where('email', $this->userData['email'])->get();
        } else {
            $accountData = Account::where('email', $this->userData['email'])->whereYear('date', $id)->get();
        }

        $distinctYears = Account::selectRaw('YEAR(date) AS year')->where('email', $this->userData['email'])->distinct()->get();

        return view('accounts/report', ['accountData' => $accountData, 'years' => $distinctYears]);
    }

    public function add_expense()
    {
        return view('accounts/add-expense', ['actionData' => '', 'action' => 'add']);
    }

    public function store_expense(StoreAccountRequest $request)
    {
        $model = new Account();
        $model->date = $request->date;
        $model->email = $this->userData['email'];
        $model->amount_spent = $request->amount_spent;
        $model->description = $request->description;
        $model->save();

        return redirect()->route('report')->with('success', 'Expense added.');
    }

    public function edit_expense($id)
    {
        $actionData = Account::where('id', $id)->get();

        return view('accounts/add-expense', ['actionData' => $actionData, 'action' => 'edit']);
    }

    public function update_expense(UpdateAccountRequest $request, $id)
    {
        Account::where('id', $id)
                ->where('email', $this->userData['email'])
                ->update([
                    'date' => $request->date,
                    'amount_spent' => $request->amount_spent,
                    'description' => $request->description
                ]);

        return redirect()->route('report')->with('success', 'Expense updated.');
    }

    public function delete_expense($id)
    {
        Account::where('id', $id)->delete();

        return redirect()->route('report')->with('success', 'Expense deleted.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
