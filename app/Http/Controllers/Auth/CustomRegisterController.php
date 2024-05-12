<?php

// app/Http/Controllers/Auth/CustomRegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User; // Adjust the User model namespace as needed
use App\Transaction;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class CustomRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
       
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'account_type' => ['required', 'string', 'in:INDIVIDUAL,BUSINESS'], // Validate the account type
            'balance' => ['required', 'numeric'], // Validate the balance field
        ]);
    }

    protected function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $save= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'account_type' => $request->account_type, // Insert account type
                'balance' => $request->balance, // Insert balance
            ]);
            if ($save) {
                $transtion= Transaction::create([
                    'user_id' => $save->id,
                    'transactions_type' => 'DIPOSIT',              
                    'amount' => $request->balance, // Insert first balance
                    'fee' =>0, 
                ]);
            }
           
            DB::commit();
            $message=['meg'=>'success'];
        } catch (\Throwable $th) {
          DB::rollback();
          $message=['meg'=>'Fail'];
        }
          return redirect()->route('login')->with($message);
      
    }
   
}
