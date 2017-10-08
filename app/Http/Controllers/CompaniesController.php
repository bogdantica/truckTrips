<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function new($owner = null)
    {
        $byOwner = $owner;

        return view('companies.company', compact('byOwner'));
    }

    public function storeNew(Request $req, $owner = null)
    {
        $this->validate($req, [
            'cif' => 'required',
            'name' => 'required',
            'reg_id' => 'required',
            'address' => 'required'
        ]);


        $req->merge(['cif' => strtoupper($req->cif)]);
        $comp = Company::whereCif($req->cif)->first();

        $isNew = true;

        if (!$comp) {
            $comp = new Company();
            $isNew = false;
        }

        if ($owner && !$comp->owner_user_id) {
            $req->merge(['owner_user_id' => \Auth::id()]);

        }
        $comp->fill($req->only([
            'cif',
            'name',
            'reg_id',
            'address',
            'owner_user_id'
        ]))
            ->save();

        if (!$isNew) {
            $comp->isNew = false;
        }
        if ($req->ajax()) {
            return new JsonResponse($comp);
        }

        return redirect(route('companies'));
    }

    public function byCif(Request $request)
    {
        $cif = $request->query('cif');


        $cif = strtolower($cif);
        $cif = str_replace('ro', '', $cif);

        if (strlen($cif) != 8) {
            return new \Illuminate\Http\JsonResponse((object)[]);
        }

        $url = 'https://legacy.openapi.ro/api/companies/>cif<.json';
        $url = str_replace('>cif<', $cif, $url);

        $client = new \GuzzleHttp\Client([
//        'cookies' => true
        ]);

        try {
            $r = $client->request('GET', $url, [
                'allow_redirects' => true,
//        'debug' => true
            ]);

            $r = \GuzzleHttp\json_decode($r->getBody()->getContents());

        } catch (\Exception $e) {
            $r = (object)[];
        }

        return new \Illuminate\Http\JsonResponse($r);

    }

}
