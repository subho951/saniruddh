<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Helper;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->data = [
            'title' => 'Blog',
            'controller' => 'BlogController',
            'controller_route' => 'blog',
            'primary_key' => 'id',
        ];
    }

    public function list()
    {
        $data['module'] = $this->data;
        $title = $this->data['title'].' List';
        $page_name = 'blog.list';
        $data['rows'] = Blog::with('category')->where('status', '!=', 3)->orderBy('id', 'DESC')->get();

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function add(Request $request)
    {
        $data['module'] = $this->data;

        if ($request->isMethod('post')) {
            $rules = [
                'blog_category_id' => 'required',
                'title' => 'required',
            ];

            if ($this->validate($request, $rules)) {
                $blogImage = $this->uploadBlogImage($request);

                if (is_array($blogImage) && isset($blogImage['error'])) {
                    return redirect()->back()->with(['error_message' => $blogImage['error']]);
                }

                Blog::insert($this->blogFields($request, $blogImage));

                return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Inserted Successfully !!!');
            }

            return redirect()->back()->with('error_message', 'All Fields Required !!!');
        }

        $title = $this->data['title'].' Add';
        $page_name = 'blog.add-edit';
        $data['row'] = [];
        $data['categories'] = BlogCategory::where('status', '=', 1)->orderBy('name')->get();

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function edit(Request $request, $id)
    {
        $data['module'] = $this->data;
        $id = Helper::decoded($id);
        $title = $this->data['title'].' Update';
        $page_name = 'blog.add-edit';
        $data['row'] = Blog::where($this->data['primary_key'], '=', $id)->first();

        if (! $data['row']) {
            return redirect('admin/'.$this->data['controller_route'].'/list')->with('error_message', $this->data['title'].' Not Found !!!');
        }

        if ($request->isMethod('post')) {
            $rules = [
                'blog_category_id' => 'required',
                'title' => 'required',
            ];

            if ($this->validate($request, $rules)) {
                $blogImage = $this->uploadBlogImage($request, $data['row']->blog_image);

                if (is_array($blogImage) && isset($blogImage['error'])) {
                    return redirect()->back()->with(['error_message' => $blogImage['error']]);
                }

                Blog::where($this->data['primary_key'], '=', $id)->update($this->blogFields($request, $blogImage, false));

                return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Updated Successfully !!!');
            }

            return redirect()->back()->with('error_message', 'All Fields Required !!!');
        }

        $data['categories'] = BlogCategory::where('status', '=', 1)->orderBy('name')->get();

        echo $this->admin_after_login_layout($title, $page_name, $data);
    }

    public function delete(Request $request, $id)
    {
        $id = Helper::decoded($id);
        Blog::where($this->data['primary_key'], '=', $id)->update(['status' => 3]);

        return redirect('admin/'.$this->data['controller_route'].'/list')->with('success_message', $this->data['title'].' Deleted Successfully !!!');
    }

    public function change_status(Request $request, $id)
    {
        $id = Helper::decoded($id);
        $model = Blog::find($id);

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

    private function blogFields(Request $request, ?string $blogImage, bool $isNew = true): array
    {
        $fields = [
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'slug' => Helper::clean($request->title),
            'blog_image' => $blogImage,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'publish_date' => $request->publish_date,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'updated_at' => now(),
        ];

        if ($isNew) {
            $fields['created_at'] = now();
        }

        return $fields;
    }

    private function uploadBlogImage(Request $request, string $oldImage = ''): string|array|null
    {
        $imageFile = $request->file('blog_image');

        if (! $imageFile) {
            return $oldImage;
        }

        $uploadDir = public_path('uploads/blog');

        if (! is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $uploadedFile = $this->upload_single_file('blog_image', $imageFile->getClientOriginalName(), 'blog', 'image');

        if (! $uploadedFile['status']) {
            return ['error' => $uploadedFile['message']];
        }

        return $uploadedFile['newFilename'];
    }
}
