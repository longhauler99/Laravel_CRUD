<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index($id=null): array
    {
        $tHeadRow = "";
        $table_columns = DB::table('employees')->select('PayrollNum', 'Surname', 'FirstName', 'LastName', 'DoB', 'Gender')->columns;

        $tHeadRow = "<tr>";
            foreach($table_columns as $table_column)
            {
                $tHeadRow .= "<th>". $table_column ."</th>";
            }
        $tHeadRow .= "</tr>";

        $table_rows = DB::table('employees')->select('PayrollNum', 'Surname', 'FirstName', 'LastName', 'DoB', 'Gender')->get();
        $tBodyRows = "";
        foreach ($table_rows as $row) {
            $tBodyRows .= "<tr>";
            foreach ($row as $value) {
                $tBodyRows .= "<td>" . $value . "</td>";
            }
            $tBodyRows .= "</tr>";
        }
//        dd($tBodyRows);
        return [$tHeadRow, $tBodyRows];
    }
}
