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
                switch($table_column)
                {
                    case "PayrollNum";
                        $table_column = "UPN";
                        break;

                    case "Surname";
                        $table_column = "Surname";
                        break;

                    case "FirstName";
                        $table_column = "First Name";
                        break;

                    case "LastName";
                        $table_column = "Last Name";
                        break;

                    case "DoB";
                        $table_column = "DoB";
                        break;

                    case "Gender";
                        $table_column = "Gender";
                        break;
                }

                $tHeadRow .= "<th>". $table_column ."</th>";
            }
        $tHeadRow .= "</tr>";

        $table_rows = DB::table('employees')->select('PayrollNum', 'Surname', 'FirstName', 'LastName', 'DoB', 'Gender')->get();
        $tBodyRows = "";
        foreach ($table_rows as $row) {
            $tBodyRows .= "<tr>";
            foreach ($row as $value) {
                $tBodyRows .= "<td class='text-nowrap'>" . $value . "</td>";
            }
            $tBodyRows .= "</tr>";
        }
//        dd($tBodyRows);
        return [$tHeadRow, $tBodyRows];
    }
}
