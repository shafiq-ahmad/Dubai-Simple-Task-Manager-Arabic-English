<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class CompanyController extends Controller
{
	//use AuthenticatesUsers;
	protected $redirectTo = '/companies';
	//$company = Auth::guard('company')->user();

	public function login(Request $request)
    {
        $this->validate($request, [
            'secret'   => 'required'
        ]);
		$company = Company::where('login', $request->secret)
			->first();
		if(!$company){
			$executed = RateLimiter::attempt('send-message:',
				$perMinute = 5,
				function(){
					// Send message...
					return back()->with('warning', 'Failed Login attempt');
				
				}
			);
			 
			if (! $executed) {
			  return 'Too many attempts sent! try again later';
			  exit;
			}
			return back()->withInput($request->only('secret'));
		}
		Auth::guard('company')->login($company);
		RateLimiter::clear('cleared');
        return redirect()->intended('/companies');
    }
	
	public function logout(Request $request)
	{
		//Auth::logout();
		Auth::guard('company')->logout();
	 
		$request->session()->invalidate();
	 
		$request->session()->regenerateToken();
	 
		return redirect('/');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//dd(Auth::guard('company')->user()->toArray());
		$companies = Company::withCount('projects')->get()->toArray();
		$page_title="Companies";
		$view = 'listView';
		$user = Auth::user();
		if(isset($user->username) && $user->username == 'admin')
			$view='pages.companies.index';
		//dd($companies);
		return view($view, compact('companies', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.companies.create');
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
            'title' => 'required',
            'login' => 'required',
        ]);
		//dd($request->all());
      
        Company::create($request->only('title','login'));
       
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('pages.companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            //'id' => 'required',
            'title' => 'required',
            'login' => 'required',
        ]);
      
        $company->update($request->only('id','title','login'));
      
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
       
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}
