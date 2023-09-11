<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleManagement as RoleMgt;
use Illuminate\Validation\Rule;
use App\Models\Privilege;
use App\Http\Controllers\GenClass; 

class RoleManagement extends Controller
{

    public function role_management(){
    $search_fields = ['keyword', 'no_of_rows', 'search_start_date', 'search_end_date'];
    if(!empty(request('search'))){
    GenClass::search("role-management", $search_fields, 1);
    return redirect('/' . GenClass::$admin . '/role-management');
    }else{
    $search = GenClass::search("role-management", $search_fields);
    $query = RoleMgt::where('id', '>', 0) 
    ->when($search['keyword'], function($cond_req, $keyword){ $cond_req->where('item_name', 'LIKE', '%' . $keyword . '%'); })
    ->when($search['search_start_date'], function($cond_req, $start){ $cond_req->where('date_added', '>=', $start); })
    ->when($search['search_end_date'], function($cond_req, $end){ $cond_req->where('date_added', '<=', $end); });
    $query = GenClass::s_query($query, 10, "Role Management", GenClass::$admin . "/role-management", "role-management");
    return view('/' . GenClass::$admin . '/role-management', $query);
    }	
    }

    public function role_management_create(){
        $title = 'New Role'; $create = 1; $page_slug = "role-management";
        $post = Privilege::all();
        return view('/' . GenClass::$admin . '/role-management', compact('create', 'post', 'title', 'page_slug'));
        }	
        
        public function role_management_edit($pn, $edit){
        $post = Privilege::all();
        $pn = (isset($pn))?$pn:1; $page_slug = "role-management"; $title = 'Edit Role';
        return view('/' . GenClass::$admin . '/role-management', compact('edit', 'post', 'title', 'pn', 'page_slug'));
        }
        
        public function role_management_save(Request $request){
        $id = auth()->user()->id;
        $rand_no = GenClass::gen("rand_no");
        $date_time = GenClass::gen("date_time");
        $pn = (request('pn') != null)?request('pn'):1;
        $edit = (request('edit') != null)?request('edit'):"";
    
        $formFields = [];
        if(empty($edit)){
        $formFields['role'] = ['required', Rule::unique('role_management', 'role')];
        }else{
        $role = $request->role;
        $det_role = GenClass::in_table("role_management",[['role', '=', $role], ['id', '!=', $edit]],"id");
        $formFields['role'] = (empty($det_role))?'required':['required', Rule::unique('role_management', 'role')];
        }
        $formFields = $request->validate($formFields);	


        foreach($request->input() as $key => $val){
        if($key != "_token" && $key != "edit" && $key != "pn" && $key != "sel-all"){
        $formFields[$key] = $val;
        //$roles_combined .= ($key != "role" && !empty($val))? in_table("role_text","privileges","WHERE role_title='{$key}'","role_text") . ", " : "";
        }
        }
        
        if(empty($edit)){
        $formFields["date_created"] = $date_time;
        $formFields["created_by"] = $id;
        RoleMgt::create($formFields);
        }else if(!empty($edit)){
        $formFields["date_updated"] = $date_time;
        $formFields["updated_by"] = $id;
        RoleMgt::where('id', $edit)->update($formFields);
        }

    
        $redir_add = (!empty($edit))?"/{$pn}":"";
        return redirect('/' . GenClass::$admin . '/role-management' . $redir_add)->with('success', 'Role saved successfully.');
        }	
        
        public static function delete_items_posts(Request $request){ 
        if(!empty($request->del) && is_array($request->del)){
        $pn = $request->pn;
            
        foreach($request->del as $key => $val){
        if($val != ""){ 
        
        $data = public_path("images/products-featured/{$val}_*.*");
        $file_array = File::glob($data);
        foreach ($file_array as $filename) {
        if(file_exists($filename)){
        FileMC::delete($filename);
        }
        }
        
        $data = public_path("images/products-displayed/{$val}_*.*");
        $file_array = File::glob($data);
        foreach ($file_array as $filename) {
        if(file_exists($filename)){
        FileMC::delete($filename);
        }
        }
        
        Items::where('id', $val)->delete();
        ItemsSize::where('item_id', $val)->delete();
        return redirect('/' . GenClass::$admin . '/role-management')->with('success', 'Product deleted successfully.');
        
        }
        }
        
        }
        }
    

}
