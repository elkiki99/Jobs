<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::where('created_by', auth()->user()->id)->paginate(24);

        return view('companies.index', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Company::class);
        $categories = config('categories');
        $countries = config('countries');

        return view('companies.create', [
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $companyData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:companies,email'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'digits_between:1,20'],
            'phone' => ['nullable', 'string', 'max:20'],
            'industry' => ['required', 'string', 'max:255'],
            'founded' => ['nullable', 'date'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'employees' => ['nullable', 'integer', 'min:1'],
            'revenue' => ['nullable', 'numeric', 'min:0'],
            'slug' => ['required', 'string', 'max:255', 'unique:companies'],
        ]);

        if ($request->hasFile('logo')) {
            $companyData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $companyData['created_by'] = auth()->user()->id;
        $company = Company::create($companyData);

        return redirect()->route('companies.show', $company->slug)->with('company_created', 'Company created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $openings = $company->openings()->paginate(24);

        return view('companies.show', [
            'company' => $company,
            'openings' => $openings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        Gate::authorize('update', $company);
        $countries = config('countries');

        return view('companies.edit', [
            'company' => $company,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        // Gate::authorize('update', $company);
        $newCompanyData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique('companies')->ignore($company->id),
            ],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'digits_between:1,20'],
            'phone' => ['nullable', 'string', 'max:20'],
            'industry' => ['required', 'string', 'max:255'],
            'founded' => ['nullable', 'date'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'employees' => ['nullable', 'integer', 'min:1'],
            'revenue' => ['nullable', 'numeric', 'min:0'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies')->ignore($company->id),
            ],
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $newCompanyData['logo'] = $logoPath;
        } else {
            $newCompanyData['logo'] = $company->logo;
        }
        $newCompanyData['created_by'] = auth()->user()->id;
        $company->update($newCompanyData);

        return redirect()->route('companies.show', $company->slug)->with('company_updated', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $user = auth()->user();
        
        $isCompanyInUseByOthers = User::where('company_id', $company->id)
                                      ->where('id', '!=', $user->id)
                                      ->exists();
    
        if (!$isCompanyInUseByOthers) {
            $company->delete();
            return redirect()->route('network')
                             ->with('company_deleted', 'Your company was deleted successfully!');
        } else {
            return redirect()->route('companies.show', ['company' => $company->slug])
                             ->with('company_deleted_error', 'Your company cannot be deleted as it is being used by another user!');
        }
    }
}
