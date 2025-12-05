<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pictures\CreatePicturesRequest;
use App\Http\Requests\Pictures\UpdatePictureRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    private const PER_PAGE = 30;

    /**
     * Lists all pictures.
     */
    public function index()
    {
        $pictures = Picture::query()
            ->orderBy('event_id', 'asc')
            ->orderBy('pic_upload_date', 'desc')
            ->paginate(self::PER_PAGE);

        return view('pictures.index', compact('pictures'));
    }

    public function create()
    {
        $categories = Category::all();
        $events = Event::all();

        return view('pictures.create', compact('categories', 'events'));
    }

    /**
     * Creates a new picture.
     */
    public function store(CreatePicturesRequest $request)
    {
        foreach ($request->input('pictures', []) as $index => $rawData) {
            $file = $request->file(sprintf('files.%d', $index));

            $event = Event::find($rawData['event_id']);

            $data = [
                ...$rawData,
                'pic_upload_date' => now()
            ];

            $picture = new Picture($data);

            if ($file) {
                $ext = $file->getClientOriginalExtension();

                $latestPic = $event->pictures()->latest('pic_path')->first();
                if ($latestPic) {
                    preg_match('/_(\d+)\.\w+$/', $latestPic->pic_path, $matches);
                    $picIndex = ((int)$matches[1]) + 1;
                } else {
                    $picIndex = 1;
                }

                $newName = sprintf('event_%s_pic_%d.%s', $event->event_id, $picIndex, $ext);

                $baseEventFolder = $event->event_folder_path;
                // Store the file in the 'pictures' directory
                $file->storeAs($baseEventFolder, $newName, 'public');

                // Set the picture path URL
                $picture->pic_path = sprintf('%s/%s', $baseEventFolder, $newName);
                $picture->pic_name = $newName;

                $picture->save();
            }
        }

        return redirect()->route('pictures.index')->with('success', 'Picture upload successful.');
    }

    public function edit(Picture $picture)
    {
        return view('pictures.edit', compact('picture'));
    }

    /**
     * Updates an existing picture.
     */
    public function update(Picture $picture, UpdatePictureRequest $request)
    {
        $picture->update([
            'pic_is_active' => $request->boolean('pic_is_active'),
            'pic_upload_note' => $request->input('pic_upload_note')
        ]);

        return redirect()->route('pictures.index')->with('success', 'Picture updated successfully.');
    }

    /**
     * Deletes an existing picture.
     */
    public function destroy(Picture $picture)
    {
        Storage::drive('public')->delete($picture->pic_path);
        $picture->delete();
        return redirect()->route('pictures.index')->with('success', sprintf('Picture "%s" deleted successfully.', $picture->pic_locator));
    }
}
