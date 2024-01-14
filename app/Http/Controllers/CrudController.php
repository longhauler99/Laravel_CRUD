<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CrudController extends Controller
{
    public function index($id=null): array
    {
        $tBodyRows = "";
        $tHeadRow = "";

        $table_columns = DB::table('employees')->select('PayrollNum', 'Surname', 'FirstName', 'LastName', 'DoB', 'Gender')->columns;

        $tHeadRow = "<tr>";

        foreach($table_columns as $table_column)
        {
            $tHeadRow .= "<th class='text-nowrap'>". columnRenames($table_column) ."</th>";
        }

        $tHeadRow .= "</tr>";

        $table_rows = DB::table('employees')->select('PayrollNum', 'Surname', 'FirstName', 'LastName', 'DoB', 'Gender')->get();

        if($table_rows->isEmpty())
        {
            $tBodyRows = "<tr><td colspan='" . count($table_columns) . "' class='text-center'>No records found</td></tr>";
        }
        else
        {
            foreach ($table_rows as $row)
            {
                $tBodyRows .= "<tr>";

                foreach ($row as $value)
                {
                    $tBodyRows .= "<td class='text-nowrap'>" . $value . "</td>";
                }

                $tBodyRows .= "</tr>";
            }
        }

        return [$tHeadRow, $tBodyRows];
    }

    public function addEmployee(Request $request)
    {
//        dd($request->all());
        if($request->isMethod('POST'))
        {
            try {
                $validator = $request->validate([
                    'PayrollNum'=>'required|unique:employees|min:2',
                    'FirstName'=>'required',
                ]);
                return response()->json(['success' => true, 'msg' => 'Employee added successfully']);
            } catch (\Exception $e) {

                $errorMsgs = ['msg' => $e->getMessage()];
                Log::error('Exception occurred in addEmployees:', ['exception' => $e]);
                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    // Get validation error messages
                    $errorMessages['validation_errors'] = $e->errors();
                }

                // Return a JSON response with aggregated error messages
                return response()->json(['error' => true, 'errors' => $errorMessages["validation_errors"]]);
            }

//            return response()->json(['error' => 'Invalid request method.']);
//            return response()->json(['message' => 'Invalid request method.']);
//            return redirect('/display/employees');
        }
        else
        {
            return response()->json(['error' => 'Invalid request method.']);
        }
    }
}

function columnRenames($table_column): string
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
        default:
            $table_column = "";
    }

    return $table_column;
}
