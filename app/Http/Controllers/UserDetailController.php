<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserDetailRequest;
use App\Models\UserDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = UserDetail::where('user_id', Auth::user()->id)->select(sprintf('%s.*', (new UserDetail())->table));
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = '';
                $editGate = 'user_edit';
                $deleteGate = '';
                $crudRoutePart = 'userdetails';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            // $table->addColumn('work_experience', function ($row) {
            //     return $row->work_experience ? $row->work_experience : '';
            // });
            // $table->addColumn('organization', function ($row) {
            //     return $row->organization ? $row->organization : '';
            // });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserDetailRequest $request)
    {
        try {
            UserDetail::create($request->all());
            return redirect()->route('home')->with('message', 'User details added.');
        } catch (QueryException $e) {
            return redirect()->route('home')->with('message', 'Server Error!');
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
        try {
            $userDetail = UserDetail::find($id);
            return view('pages.users.edit', compact('userDetail'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('message', 'Server Error!');
        }
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
        try {
            $userDetail = UserDetail::find($id);
            $userDetail->update($request->all());
            return redirect()->route('home')->with('message', 'User details updated.');
        } catch (QueryException $e) {
            return redirect()->route('home')->with('message', 'Server Error!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
