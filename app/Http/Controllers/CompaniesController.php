<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function new()
    {
        return view('companies.company');
    }

    public function storeNew(Request $req)
    {
        $this->validate($req, [
            'cif' => 'required',
            'name' => 'required',
            'reg_id' => 'required',
            'address' => 'required'
        ]);

        $req->merge(['cif' => strtoupper($req->cif)]);
        $comp = Company::whereCif($req->cif)->first();

        if (!$comp) {
            $comp = new Company();
            $comp->isNew = false;
        }

        $comp->fill($req->only([
            'cif',
            'name',
            'reg_id',
            'address'
        ]))
            ->save();

        if ($req->ajax()) {
            return new JsonResponse($comp);
        }

        return redirect(route('companies'));
    }
}
