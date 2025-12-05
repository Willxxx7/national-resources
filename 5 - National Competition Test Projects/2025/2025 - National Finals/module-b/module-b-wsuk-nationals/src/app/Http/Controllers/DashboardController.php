<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderPicture;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = Order::whereNull('order_completed_at');
        $pendingOverLastWeek = $pending->where('order_date', '>=', now()->subWeek());

        $completed = Order::whereNotNull('order_completed_at');
        $completedOverLastWeek = $completed->where('order_completed_at', '>=', now()->subWeek());

        $averagePictureCount = round(OrderPicture::with('order')
            ->selectRaw('AVG(pic_qty) as average')
            ->groupBy('order_id')
            ->pluck('average')
            ->avg());
        $averagePictureCountOverLastWeek = round(OrderPicture::with('order')
            ->whereHas('order', function ($query) {
                $query->where('order_completed_at', '>=', now()->subWeek());
            })
            ->selectRaw('AVG(pic_qty) as average')
            ->groupBy('order_id')
            ->pluck('average')
            ->avg());

        $pictureSizesByPopularity = OrderPicture::with('pictureSize')
            ->selectRaw('pic_size_id, COUNT(*) as count')
            ->groupBy('pic_size_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->pictureSize->pic_size_label => $item->count];
            });

        $incomeByPictureSize = OrderPicture::with('pictureSize')
            ->selectRaw('picture_sizes.pic_size_id, SUM(pic_qty * pic_size_price) as total_income')
            ->join('picture_sizes', 'order_pictures.pic_size_id', '=', 'picture_sizes.pic_size_id')
            ->groupBy('pic_size_id')
            ->orderBy('total_income', 'desc')
            ->limit(5)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->pictureSize->pic_size_label => $item->total_income];
            });

        $categories = Category::all();

        return view('dashboard', compact(
            'pending',
            'pendingOverLastWeek',
            'completed',
            'completedOverLastWeek',
            'averagePictureCount',
            'averagePictureCountOverLastWeek',
            'pictureSizesByPopularity',
            'incomeByPictureSize',
            'categories'
        ));
    }
}
