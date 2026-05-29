<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Helper;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->data = [
            'title' => 'Blog Category',
            'controller' => 'BlogCategoryController',
            'controller_route' => 'blog-category',
            'primary_key' => 'id',
        ];
    }

    public function list()
    {
        $data['module'] = $this->data;
        $title = $this->data['title'].' List';
        $page_name = 'blog-category.list';
        $data['rows'] = BlogCategory::withCount([
            'blogs as blogs_count' => function ($query) {
                $query->where('status', '!=', 3);
            },
        ])->where('status', '!=', 3)->orderBy('id', 'DESC')->get();

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function add(Request $request)
    {
        $data['module'] = $this->data;

        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required',
            ];

            if ($this->validate($request, $rules)) {
                BlogCategory::insert([
                    'name' => $request->name,
                    'slug' => Helper::clean($request->name),
                    'description' => $request->description,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Inserted Successfully !!!');
            }

            return redirect()->back()->with('error_message', 'All Fields Required !!!');
        }

        $title = $this->data['title'].' Add';
        $page_name = 'blog-category.add-edit';
        $data['row'] = [];

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function edit(Request $request, $id)
    {
        $data['module'] = $this->data;
        $id = Helper::decoded($id);
        $title = $this->data['title'].' Update';
        $page_name = 'blog-category.add-edit';
        $data['row'] = BlogCategory::where($this->data['primary_key'], '=', $id)->first();

        if (! $data['row']) {
            return redirect('admin/'.$this->data['controller_route'].'/list')->with('error_message', $this->data['title'].' Not Found !!!');
        }

        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required',
            ];

            if ($this->validate($request, $rules)) {
                BlogCategory::where($this->data['primary_key'], '=', $id)->update([
                    'name' => $request->name,
                    'slug' => Helper::clean($request->name),
                    'description' => $request->description,
                    'updated_at' => now(),
                ]);

                return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Updated Successfully !!!');
            }

            return redirect()->back()->with('error_message', 'All Fields Required !!!');
        }

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function delete(Request $request, $id)
    {
        $id = Helper::decoded($id);
        BlogCategory::where($this->data['primary_key'], '=', $id)->update(['status' => 3]);

        return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Deleted Successfully !!!');
    }

    public function change_status(Request $request, $id)
    {
        $id = Helper::decoded($id);
        $model = BlogCategory::find($id);

        if (! $model) {
            return redirect('admin/'.$this->data['controller_route'].'/list')->with('error_message', $this->data['title'].' Not Found !!!');
        }

        if ($model->status == 1) {
            $model->status = 0;
            $msg = 'Deactivated';
        } else {
            $model->status = 1;
            $msg = 'Activated';
        }

        $model->save();

        return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' '.$msg.' Successfully !!!');
    }
}
