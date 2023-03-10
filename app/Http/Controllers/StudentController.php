<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Student::orderby('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {

                    if ($row->status == 1) {
                        return "Active";
                    } else {
                        return "Inactive";
                    }
                })
                ->addColumn('action', function ($row) {
                    // Update Button
                    $updateButton = "<button class='btn btn-sm btn-primary text-dark p-1 editUser' title='Update Data' data-id='" . $row->id . "' data-name='" . $row->name . "' data-email='" . $row->email . "' data-password='" . $row->password . "'><i class='fa-solid fa-pen-to-square'></i></button>";
                    // Delete Button
                    $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' title='Delete Data'  data-id='" . $row->id . "'><i class='fa-solid fa-trash'></i></button>";
                    $statusButton = "<button class='btn btn-sm btn-dark' title='Change Status'  id ='status_changehange_btn' data-id='" . $row->id . "'><i class='fa-solid fa-repeat'></i></button>";
                    return $updateButton . " " . $deleteButton." ".$statusButton;
                })
                ->make(true);
        }
        return view('ssr.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('ssr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        try {
            DB::table('students')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->JSON([
                'status' => 1,
            ]);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
    }

    //status

    public function status(Request $request)
    {
        $status_id = $request->id;
        $data = Student::find($status_id);
        
        if ($data->status == 1) {
            DB::table('students')->where('id',$status_id)->update([ 'status'=>0]);
            return response()->JSON(['status' => 1]);
        } else {
            DB::table('students')->where('id',$status_id)->update([ 'status'=>1]);
            return response()->JSON(['status' => 1]);
        }
    }


    public function delete(Request $request)
    {
        $id = $request->post('id');
        // dd($id);
        $data = Student::find($id);


        if ($data->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }

 
    public function updateData(Request $request)
    {
      
        try {
            $update_id = $request->id;
            DB::table('students')->where('id',$update_id)->update([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->JSON([
                'status' => 1,
            ]);
        } catch(\Throwable $th) {
            return $th;
        }
    }

   
}
