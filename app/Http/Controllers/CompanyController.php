<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $path = $image->store('images/companies', 'public');
            $nameImage = substr($path, strlen('images/companies/'));
        }
        
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->about_company = ($request->about_company) ? $request->about_company : null;
        $company->logo = ($request->hasFile('logo')) ? $nameImage : null;

        $company->save();

        return redirect()->route('companies.index')->with('success','Комания создана успешно!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        if (!$company->logo) $company->logo = 'no-image.jpg';
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete('images/companies/' . $company->logo);
            $image = $request->file('logo');
            $path = $image->store('images/companies', 'public');
            $nameImage = substr($path, strlen('images/companies/'));
        }

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'about_company' => $request->about_company,
            'logo' => ($request->hasFile('logo')) ? $nameImage : $company->logo
        ]);

        return redirect()->route('companies.show', $company)->with('success','Данные компании обновлены!');
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
                        ->with('success','Компания удалена');
    }
}
