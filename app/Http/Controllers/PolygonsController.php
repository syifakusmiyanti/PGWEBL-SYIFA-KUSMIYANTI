<?php

namespace App\Http\Controllers;

use App\Models\polygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{

    public function __construct()
    {
        $this->polygons = new polygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate(
            [
                'geometry_polygon' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ],
            [
                'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
                'name.required' => 'Field nama harus diisi.',
                'name.string' => 'Field nama harus berupa string.',
                'name.max' => 'Field nama tidak boleh lebih dari 255 karakter.',
                'description.required' => 'Field deskripsi harus diisi.',
                'image.image' => 'Field image harus berupa file gambar.',
                'image.mimes' => 'Field image harus berupa file dengan ekstensi jpeg, png, jpg, atau svg.',
                'image.max' => 'Field image tidak boleh lebih dari 2 MB.',
            ]
        );

        //Create directory for images if it doesn't exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Jika input dari image memiliki file, maka akan membuat variabel image untuk mewakili/menampung file image.
        //Kemudian supaya nama dari image teratur dan tidak duplikat, maka nama image akan dibuat dengan format waktu saat ini ditambah dengan "_point" dan ekstensi dari file image yang diupload.

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $name_image = time() . "_polygon." .
                strtolower($image->getClientOriginalExtension());

            $image->move('storage/images', $name_image);

        } else {

            $name_image = null;
        }

        $data = [
            'geom' => $request->geometry_polygon,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];
        //Simpan data ke database
        if (!$this->polygons->create($data)) {
            return redirect()->route('peta')->with('error', 'Gagal menyimpan data polygon.');
        }

        //Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polygon berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,

        ];

        return view('map-edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi Input
        $request->validate(
            [
                'geometry' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            ],
            [
                'geometry.required' => 'Field geometry polygon harus diisi.',
                'name.required' => 'Field nama harus diisi.',
                'name.string' => 'Field nama harus berupa string.',
                'name.max' => 'Field nama tidak boleh lebih dari 255 karakter.',
                'description.required' => 'Field deskripsi harus diisi.',
                'image.image' => 'Field image harus berupa file gambar.',
                'image.mimes' => 'Field image harus berupa file dengan ekstensi jpeg, png, jpg, atau svg.',
                'image.max' => 'Field image tidak boleh lebih dari 2 MB.',
            ]
        );

        //Create directory for images if it doesn't exist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        //Jika input dari image memiliki file, maka akan membuat variabel image untuk mewakili/menampung file image.
        //Kemudian supaya nama dari image teratur dan tidak duplikat, maka nama image akan dibuat dengan format waktu saat ini ditambah dengan "_point" dan ekstensi dari file image yang diupload.

        $image_old = $this->polygons->find($id)->image;

        // Get the uploaded image
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($image_old != null) {

                if (file_exists('./storage/images/' . $image_old)) {
                    unlink('./storage/images/' . $image_old);
                }
            }

            $image = $request->file('image');
            $name_image = time() . "_polygon." .
                strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

        } else {

            $name_image = $image_old;
        }

        $data = [
            'geom' => $request->geometry,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $name_image
        ];
        //Simpan data ke database
        if (!$this->polygons->find($id)->update($data)) {
            return redirect()->route('peta')->with('error', 'Gagal memperbarui data polygon.');
        }

        //Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polygon berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari nama file gambar berdasarkan ID Polygon
        $image = $this->polygons->find($id)->image;

        //Hapus data dari database
        if (!$this->polygons->destroy($id)) {
            return redirect()->route('peta')->with('error', 'Gagal menghapus data polygon.');
        }

        //Hapus file gambar jika ada
        if ($image != null) {
            // Cek apakah file gambar ada sebelum menghapus
            if (file_exists('./storage/images/' . $image)) {
                //Hapus file gambar
                unlink('./storage/images/' . $image);
            }
        }

        //Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polygon berhasil dihapus.');
    }
}
