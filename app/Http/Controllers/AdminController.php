<?php

namespace App\Http\Controllers;

use App\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Intervention\Image\Filters\FilterInterface;

class AdminController extends Controller
{
    public function index()
    {
        $doctors = Doctors::all();
        return view('admin.doctors.doctors', ['doctors' => $doctors]);
//        return view('admin.index');
    }

    public function list_doctors()
    {
        $doctors = Doctors::all();
        return view('admin.doctors.doctors', ['doctors' => $doctors]);
    }

    public function add()
    {
        return view('admin.doctors.add_doctor');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'city' => 'required|max:50',
            'zip_code' => 'required|max:10',
            'display_picture' => 'required|max:255',
            'cover' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->route('doctor.add')->withErrors($validator)->withInput();
        }

        $doctor = new Doctors();

        $display_picture = $request->file('display_picture');
        $display_pictur = Storage::put('public/images', $display_picture);
        $newfile = (explode("/", $display_pictur));
        $display_picture = $newfile[1] . '/' . $newfile[2];

        $image = Image::make(storage_path('app/' . $display_pictur));
        $image->encode('png');
        $image->resize(150, 150);

        $width = $image->getWidth();
        $height = $image->getHeight();
        $mask = Image::canvas($width, $height);

        $mask->circle($width, $width / 2, $height / 2, function ($draw) {
            $draw->background('#fff');
        });
        $image->mask($mask, false);
        $image->save(storage_path('app/' . $display_pictur));

        $cover = $request->file('cover');
        $cover = Storage::put('public/images', $cover);
        $coverfile = (explode("/", $cover));
        $cover = $coverfile[1] . '/' . $coverfile[2];

        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->latitude = $request->input('latitude');
        $doctor->longitude = $request->input('longitude');
        $doctor->city = $request->input('city');
        $doctor->zip_code = $request->input('zip_code');
        $doctor->display_picture = $display_picture;
        $doctor->cover = $cover;
        if ($doctor->save()) {
            return redirect()->route('doctors.list');
        } else {
            $error = [
                'error' => 'An error occurred while saving!',
            ];
            return redirect()->route('doctor.add')->withErrors($error)->withInput();
        }

    }

    public function delete($id)
    {
        $doctor = Doctors::findorfail($id);
        if ($doctor->delete()) {
            return redirect()->route('doctors.list');
        }
    }

    public function edit($id)
    {
        $doctor = Doctors::findorfail($id);
        return view('admin.doctors.edit_doctor', ['doctor' => $doctor]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'city' => 'required|max:50',
            'zip_code' => 'required|max:10',
            'display_picture' => 'required_without:display_picture_path',
            'cover' => 'required_without:cover_path'
        ]);

        if ($validator->fails()) {
            return redirect()->route('doctor.edit', [$id])->withErrors($validator)->withInput();
        }

        $doctor = Doctors::findorfail($id);

        $display_picture = $request->input('display_picture_path');
        if ($request->hasFile('display_picture')) {
            $display_picture = $request->file('display_picture');
            $display_pictur = Storage::put('public/images', $display_picture);
            $newfile = (explode("/", $display_pictur));
            $display_picture = $newfile[1] . '/' . $newfile[2];

            $image = Image::make(storage_path('app/' . $display_pictur));
            $image->encode('png');
            $image->resize(150, 150);

            $width = $image->getWidth();
            $height = $image->getHeight();
            $mask = Image::canvas($width, $height);

            $mask->circle($width, $width / 2, $height / 2, function ($draw) {
                $draw->background('#fff');
            });
            $image->mask($mask, false);
            $image->save(storage_path('app/' . $display_pictur));

        }

        $cover = $request->input('cover_path');
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $cover = Storage::put('public/images', $cover);
            $coverfile = (explode("/", $cover));
            $cover = $coverfile[1] . '/' . $coverfile[2];
        }

        $doctor->name = $request->input('name');
        $doctor->address = $request->input('address');
        $doctor->latitude = $request->input('latitude');
        $doctor->longitude = $request->input('longitude');
        $doctor->city = $request->input('city');
        $doctor->zip_code = $request->input('zip_code');
        $doctor->display_picture = $display_picture;
        $doctor->cover = $cover;
        if ($doctor->save()) {
            return redirect()->route('doctors.list');
        } else {
            $error = [
                'error' => 'An error occurred while saving!',
            ];
            return redirect()->route('doctor.edit', [$id])->withErrors($error)->withInput();
        }

    }
}