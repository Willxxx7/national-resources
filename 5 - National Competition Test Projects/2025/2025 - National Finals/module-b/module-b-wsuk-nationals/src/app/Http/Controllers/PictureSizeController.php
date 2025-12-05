<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureSizes\CreatePictureSizeRequest;
use App\Http\Requests\PictureSizes\UpdatePictureSizeRequest;
use App\Models\PictureSize;

class PictureSizeController extends Controller
{
    /**
     * Lists all sizes.
     */
    public function index()
    {
        $sizes = PictureSize::all();

        return view('picture-sizes.index', compact('sizes'));
    }

    /**
     * Creates a new size.
     */
    public function store(CreatePictureSizeRequest $request)
    {
        $picture_size = new PictureSize($request->only([
          'pic_size_label',
          'pic_size_width',
          'pic_size_height',
        ]));

        $picture_size->save();

        return redirect()->back()->with(
            'success',
            sprintf('Picture size "%s" created successfully', $picture_size->pic_size_label),
        );
    }

    /**
     * Updates an existing size.
     */
    public function update(PictureSize $picture_size, UpdatePictureSizeRequest $request)
    {
        if (!is_null($pic_size_label = $request->input('pic_size_label'))) {
            $picture_size->pic_size_label = $pic_size_label;
        }
        if (!is_null($pic_size_width = $request->input('pic_size_width'))) {
            $picture_size->pic_size_width = $pic_size_width;
        }
        if (!is_null($pic_size_height = $request->input('pic_size_height'))) {
            $picture_size->pic_size_height = $pic_size_height;
        }
        if (!is_null($pic_size_price = $request->input('pic_size_price'))) {
            $picture_size->pic_size_price = $pic_size_price;
        }

        $picture_size->save();

        return redirect()->back()->with('success', 'Picture size updated');
    }

    /**
     * Deletes an existing size.
     */
    public function destroy(PictureSize $picture_size)
    {
        $picture_size->delete();

        return redirect()->back()->with(
            'success',
            sprintf('Picture size "%s" deleted successfully', $picture_size->pic_size_label),
        );
    }
}
