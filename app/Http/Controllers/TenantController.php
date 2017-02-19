<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessTenant;
use App\Organisation;
use App\Tenant;
use App\TenantComments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['tenants'] = Tenant::all();
        $data['tenant_count'] = count($data['tenants']);
        return view('tenant.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['id'] = null;
        $data['tenant'] = new Tenant();
        $data['comments'] = array();
        return view('tenant.edit', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProcessTenant $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessTenant $request)
    {
        $id = $this->save($request);

        if($id) {
            Session::flash('flash_message', 'Tenant added successfully');
            Session::flash('flash_message_class', 'success');
            return redirect(Tenant::$prefix_route . '/tenants/' . $id);
        }

        Session::flash('flash_message', 'Error while adding tenant');
        Session::flash('flash_message_class', 'danger');
        return redirect(Tenant::$prefix_route . '/tenants');
    }

    /**
     * Save the request
     *
     * @param Request $request
     * @param null $id
     * @return integer $id
     */
    public function save(Request $request, $id = null)
    {
        if(empty($id)) {
            $tenant = new Tenant();
        }
        else {
            $tenant = Tenant::find($id);
        }

        $tenant->name = $request->get('name');
        $tenant->email = $request->get('email');
        $tenant->organisation_name = $request->get('organisation_name');

        if(empty($id)) {
            $tenant->status = 2; // Mark as running
            $tenant->organisation_unique_name = $request->get('organisation_unique_name');
        }

        $tenant->save();
        $tenant_id = $tenant->id;

        if(!empty($tenant_id) && empty($id)) {
            $comment_information['status'] = 1;
            $comment_information['tenant_id'] = $tenant_id;
            $comment_information['comment_description'] = null;
            // Adding a new comment
            TenantComments::add($comment_information);
        }

        return $tenant_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['tenant'] = Tenant::find($id);
        $data['comments'] = $data['tenant']->comments;
        $data['tenant_statuses'] = getTenantStatusListBasedOnStatus($data['tenant']->status);
        return view('tenant.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['id'] = $id;
        $data['tenant'] = Tenant::find($id);
        $data['comments'] = array();
        return view('tenant.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProcessTenant $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProcessTenant $request, $id)
    {
        $id = $this->save($request, $id);

        if($id) {
            Session::flash('flash_message', 'Tenant updated successfully');
            Session::flash('flash_message_class', 'success');
            return redirect(Tenant::$prefix_route . '/tenants/' . $id);
        }

        Session::flash('flash_message', 'Error while updating tenant');
        Session::flash('flash_message_class', 'danger');
        return redirect(Tenant::$prefix_route . '/tenants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tenant::destroy($id);
        Session::flash('flash_message', 'Report deleted successfully');
        Session::flash('flash_message_class', 'success');
        return redirect(Tenant::$prefix_route . '/tenants');
    }

    /**
     * Change the status of the tenant
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        // TODO send a call to the server to change the status
        $call_response = true;

        $data['tenant_id'] = $request->get('tenant_id');
        $data['status'] = $request->get('status');
        $data['comment_description'] = $request->get('comment-description');

        if($data['status'] == 4 && $call_response == true)
            $data['status'] = 2;

        $tenant = Tenant::find($data['tenant_id']);
        $tenant->status = $data['status'];
        $tenant->save();

        if($tenant->id) {
            $comment_id = TenantComments::add($data);
            if(empty($comment_id))  {
                Session::flash('flash_message', 'Error while adding a comment');
                Session::flash('flash_message_class', 'danger');
                return redirect(Tenant::$prefix_route . '/tenants/' . $tenant->id);
            }

            Session::flash('flash_message', 'Tenant updated successfully');
            Session::flash('flash_message_class', 'success');
            return redirect(Tenant::$prefix_route . '/tenants/' . $tenant->id);
        }

        Session::flash('flash_message', 'Error while updating tenant');
        Session::flash('flash_message_class', 'danger');
        return redirect(Tenant::$prefix_route . '/tenants/' . $tenant->id);
    }

    /**
     * Generate HTML to show status change section
     *
     * @param Request $request
     * @return string $html
     */
    public function generateHTMLForStatusChange(Request $request)
    {
        $tenant_id = $request->get('tenant_id');
        $status_id = $request->get('status_id');
        $current_status_id = $request->get('current_status_id');

        if(empty($tenant_id) || empty($status_id) || empty($current_status_id))   {
            return response()->json(array('result'=> 'Error occurred', 'success' => false), 200);
        }

        $current_status_class = getClassForTenantStatus($current_status_id);
        $current_status_text = getTenantStatus($current_status_id);

        $status_class = getClassForTenantStatus($status_id);
        $status_text = getTenantStatus($status_id);
        $html = "<input type = 'hidden' name = 'tenant_id' id = 'tenant_id' value = '{$tenant_id}'>
                 <input type = 'hidden' name = 'status' id = 'status' value = '{$status_id}'>
                    <div class = 'form-group'>
                        <label class = 'col-lg-2 control-label'> Status </label>
                        <div class = 'col-lg-5 show_value'>
                            <p class = 'comment-bg bg-{$current_status_class}'> {$current_status_text} </p>
                            <i class='fa fa-arrow-right marginl5'></i>
                            <p class = 'comment-bg bg-{$status_class}'> {$status_text} </p>
                        </div>
                    </div>
                    <div class = 'form-group'>
                        <label class = 'col-lg-2 control-label' for = 'status-comment'> Reason </label>
                        <div class = 'col-lg-10'> <textarea name = 'comment-description' class = 'form-control'></textarea> </div>
                    </div>";

        return response()->json(array('result'=> $html, 'success' => true), 200);
    }

    /**
     * Add new user under organisation
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:saas_users',
            'password' => 'required|min:6|confirmed',
        ]);

        $organisation_id = $request->get('organisation_id');

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->is_admin = $request->get('is_admin') == 'on' ? 1 : 0;
        $user->organisation_id = $organisation_id;
        $user->save();

        $id = $user->id;

        if($id) {
            Session::flash('flash_message', 'User created successfully');
            Session::flash('flash_message_class', 'success');
            return redirect(Tenant::$prefix_route . '/tenants/' . $organisation_id);
        }

        Session::flash('flash_message', 'Error while adding tenant');
        Session::flash('flash_message_class', 'danger');
        return redirect(Tenant::$prefix_route . '/tenants/' . $organisation_id);
    }
}
