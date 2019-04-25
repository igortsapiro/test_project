<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /** Main page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fields = DB::select('SELECT * FROM test ORDER BY id LIMIT 25');
        $currentPage = 1;
        $allFields = $this->getCountFields('SELECT * FROM test') ?? Test::ALL_TEST_FIELDS;
        $allPages = round($allFields / Test::COUNT_PAGINATE);
        return view('index', compact('fields', 'allFields', 'allPages', 'currentPage'));

    }

    /** Function for handling ajax request
     * @param TestRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFilteredFields(TestRequest $request)
    {
        //array for inputs from request
        $params = [];

        $sql = 'SELECT * FROM test ';

        //if there is at least 1 not empty input
        if (!empty($request->id) || !empty($request->string_field) ||
            !empty($request->boolean_field) || !empty($request->decimal_field) ||
            !empty($request->timestamp_field_from) || !empty($request->timestamp_field_to)) {

            $sql .= 'WHERE ';

            if (!empty($request->id)) {
                $sql .= 'id = ? ';
                $params[] = $request->id;
            }
            if (!empty($request->string_field)) {
                if (substr($sql, -6, 5) != 'WHERE') $sql .= 'AND ';
                $sql .= "string_field LIKE ? ";
                $params[] = $request->string_field;
            }
            if (!empty($request->boolean_field)) {
                $bool = $request->boolean_field == 2 ? 0 : 1;
                if (substr($sql, -6, 5) != 'WHERE') $sql .= 'AND ';
                $sql .= 'boolean_field = ? ';
                $params[] = $bool;
            }
            if (!empty($request->decimal_field)) {
                if (substr($sql, -6, 5) != 'WHERE') $sql .= 'AND ';
                $sql .= 'decimal_field = ? ';
                $params[] = $request->decimal_field;
            }
            if (!empty($request->timestamp_field_from)) {
                if (substr($sql, -6, 5) != 'WHERE') $sql .= 'AND ';
                $sql .= 'timestamp_field >= ? ';
                $params[] = date('Y-m-d H:i:s', strtotime($request->timestamp_field_from));
            }
            if (!empty($request->timestamp_field_to)) {
                if (substr($sql, -6, 5) != 'WHERE') $sql .= 'AND ';
                $sql .= 'timestamp_field <= ? ';
                $params[] = date('Y-m-d H:i:s', strtotime($request->timestamp_field_to));
            }
        }

        //pagination settings
        $allFields = $this->getCountFields($sql, $params) ?? Test::ALL_TEST_FIELDS;
        $currentPage = $request->current_page ?? 1;
        $searchFrom = ($currentPage - 1) * Test::COUNT_PAGINATE;
        $allPages = ceil($allFields / Test::COUNT_PAGINATE);

        $sql .= ' ORDER BY ' . $request->order_by . ' ' . $request->sort_order .' LIMIT ' . $searchFrom . ', ' . Test::COUNT_PAGINATE;
        $fields = DB::select($sql, $params);

        return view('fields', compact('fields', 'allFields', 'currentPage', 'allPages'));

    }

    /** Get all fields for sql query
     * @param $sql
     * @param $params
     * @return mixed
     */
    protected function getCountFields(string $sql, array $params = [])
    {
        $sql = substr_replace($sql, 'COUNT(*)', 7, 1);

        return ((array) DB::select($sql, $params)[0])['COUNT(*)'];
    }

}
