<?php
namespace App\Http\Controllers;

use App\Models\Caves;
use Illuminate\Http\Request;


class CaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(['message' => "Not Implemented. Please use the find option."], 501);
    }

    /**
     * Store a newly created resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Caves::create($request->all());
    }

    public function find(Request $request)
    {

        $find = Caves::select('id', 'cave_number', 'cave_name', 'cave_description');

        if ($request['cave_name']) {
            $find->where('cave_name', 'like', "%" . $request['cave_name'] . "%");
        }

        $result = $find->get();

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Caves::where("id", "=", $id)->firstOrFail();
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
        return Caves::whereId($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Caves::whereId($id)->delete($id);
    }
}
