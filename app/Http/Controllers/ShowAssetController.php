<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class ShowAssetController extends Controller

{
    public function ShowAsset(Request $request)
    {
      $page_size = $request->page_size ? (int)$request->page_size : 12;

      $asset_type = $request->asset_type;

      $query = Asset::where('asset_type', '!=', 'ของส่วนกลาง');

      if($asset_type === 'empty'){
        $query = $query->where('asset_status', '=', 'ว่าง');
      }

      $assets = $query->paginate($page_size)->withQueryString();

      $search_option = [
        'page_size' => $page_size,
        'asset_type' => $asset_type
      ];

      return view('approver.asset.showAsset', compact('assets', 'search_option'));
    }
}

