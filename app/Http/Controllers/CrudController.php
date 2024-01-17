<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CrudController extends Controller
{
    public function index($id=null): array
    {
        $tBodyRows = "";
        $tHeadRow = "";

        $table_columns = DB::table('employees')->select('PayrollNum', 'FirstName', 'LastName', 'DoB', 'Gender')->columns;

        $tHeadRow = "<tr>";

        foreach($table_columns as $table_column)
        {
            $tHeadRow .= "<th class='text-nowrap'>". columnRenames($table_column) ."</th>";
        }

        $tHeadRow .= "</tr>";

        $table_rows = DB::table('employees')->select('PayrollNum', 'FirstName', 'LastName', 'DoB', 'Gender')->get();

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

    /**
     * @throws ValidationException
     */
    public function addEmployee(Request $request)
    {
//        dd($request->all());
        if($request->isMethod('POST'))
        {
            try {
                $this->validate($request, [
                    'PayrollNum'=>'required|unique:employees|min:11',
                    'FirstName'=>'required|string',
                    'LastName'=>'nullable|string',
                    'DoB'=>'required|Date',
                    'Gender'=>'required|string'
                ]);

                DB::table('employees')->insert([
                    'PayrollNum'=>$request->input('PayrollNum'),
                    'FirstName'=>$request->input('FirstName'),
                    'LastName'=>$request->input('LastName'),
                    'DoB'=>$request->input('DoB'),
                    'Gender'=>$request->input('Gender')
                ]);

                return response()->json(['success' => true, 'msg' => 'Employee added successfully']);
            }
            catch (\Exception $e)
            {
                $errorMessages = ['validation_errors' => $e->getMessage()];
//                Log::error('Exception occurred in addEmployees:', ['exception' => $e]);

                if($e instanceof \Illuminate\Validation\ValidationException)
                {
                    $errorMessages['validation_errors'] = $e->errors();
                }

                // Return a JSON response with aggregated error messages
                return response()->json(['error' => true, 'errors' => $errorMessages["validation_errors"]]);
            }
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
