<?php
namespace App\Http\Controllers;

use App\Models\Caves;
use Illuminate\Http\Request;

define('DEFAULT_OFFSET', 0);
define('DEFAULT_LIMIT', 50);
define('MAX_LIMIT', 50);
define('AVAILABLE_COLS', ['id', 'cave_number', 'cave_name', 'cave_description']);
define('DEFAULT_COLS', ['id', 'cave_number', 'cave_name', 'cave_description']);

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
        if ($request['cols']) {
            $cols = $request['cols'];
            foreach ($request['cols'] as $col) {
                if (!in_array($col,AVAILABLE_COLS)) {
                    $cols = DEFAULT_COLS;
                    break;
                }
            }
        } else {
            $cols = DEFAULT_COLS;
        }
        $find = Caves::select($cols);

        $limit = $request['limit']?$request['limit']:DEFAULT_LIMIT;
        $limit = $limit>MAX_LIMIT?MAX_LIMIT:$limit;
        $find->limit($limit);

        $offset = $request['offset']?$request['offset']:DEFAULT_OFFSET;
        $find->offset($offset);

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
        $message = "Error";
        $status = 500;

        if (Caves::whereId($id)->update($request->all())) {
            $message = "Success";
            $status = 200;
        }
        return response(['message' => $message], $status);

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
