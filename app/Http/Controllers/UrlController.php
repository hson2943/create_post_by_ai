<?php

namespace App\Http\Controllers;

use App\Models\Sns;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function setting()
    {
        $link_website = Url::where('user_id', auth()->user()->id)->first();

        $link_snses = Sns::where('user_id', auth()->user()->id)->get();

        return view('setting', [
            'link_website' => $link_website->link_website ?? '',
            'link_snses' => $link_snses ?? [],
        ]);
    }
    public function create(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $link_websites = [
            'link_website' => $request->link_website,
            'user_id' => $user->id
        ];

        $urlDB = Url::where('user_id', $user->id)->first();

        // link_website
        if ($urlDB) {
            $urlDB->link_website = $request->link_website;
            $urlDB->save();
        } else {
            Url::create($link_websites);    
        }

        $link_snses = $request->link_sns ?? [];

        $user->snses()->delete();

        foreach ($link_snses as $link_sns) {
            Sns::create([
                'link_sns' => $link_sns,
                'user_id' => $user->id
            ]);
        }

        return redirect()->route('setting')->with("status", "Cập nhật link thành công");
    }

    public function deleteSns($id){
        Sns::find($id)->delete();
        return redirect()->route('setting')->with('status', 'Xoá thành công');
    }
}
