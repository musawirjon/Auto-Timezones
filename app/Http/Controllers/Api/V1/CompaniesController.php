<?php

namespace App\Http\Controllers\Api\V1;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {
    	$timezone = $request->timeZone;
    	$timezone_name = timezone_name_from_abbr("", $timezone*60, false); 
        $companies = Company::all();
        foreach($companies as $company){
        	$company->created_at = new Carbon($company->created_at,$timezone_name); 
        }
        return $companies;
    }

    public function show($id)
    {
        return Company::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return $company;
    }

    public function store(Request $request)
    {
        $company = Company::create($request->all());
        return $company;
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return '';
    }
}
