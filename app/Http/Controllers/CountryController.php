<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

define('DEFAULT_OFFSET', 0);
define('DEFAULT_LIMIT', 50);
define('MAX_LIMIT', 50);

class CountryController extends Controller
{
    public function store(Request $request)
    {
        print $request;
        return Country::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $message = "Error";
        $status = 500;

        if (Country::whereId($id)->update($request->all())) {
            $message = "Success";
            $status = 200;
        }
        return response(['message' => $message], $status);
    }

    public function show($id)
    {
        $country = Country::select("id", "country_name")
            ->where("id", "=", $id)
            ->firstOrFail();
        return $country;
    }

    public function destroy($id)
    {
        return Country::whereId($id)->delete($id);
    }

    public function find(Request $request)
    {
        $find = Country::where('country_name', 'LIKE', "%{$request['search_string']}%");

        $limit = $request['limit']?$request['limit']:DEFAULT_LIMIT;
        $limit = $limit>MAX_LIMIT?MAX_LIMIT:$limit;
        $find->limit($limit);

        $offset = $request['offset']?$request['offset']:DEFAULT_OFFSET;
        $find->offset($offset);

        $result = $find->get();
        return $result;
    }
}
