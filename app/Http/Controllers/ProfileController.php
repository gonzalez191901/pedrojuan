<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show($id)
    {
        //$user = \App\User::where('id', 1)->firstOrFail();
        $user = \App\User::where('id', $id)->firstOrFail();
        
        /*$posts = $user->posts()
            ->withCount(['comments', 'retweets', 'likes'])
            ->latest()
            ->paginate(10);
            
        $user->loadCount(['following', 'followers']);*/
        
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'phone' => 'required|string|max:20',
            
            /*'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',*/
        ]);


        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->update();
        
        
        // Procesar avatar
        /*if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = 'avatars/'.$user->id.'_'.time().'.'.$avatar->getClientOriginalExtension();
            
            // Redimensionar y guardar
            $image = Image::make($avatar)->fit(400, 400);
            Storage::disk('public')->put($filename, (string) $image->encode());
            
            // Eliminar el avatar anterior si existe
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $data['avatar'] = $filename;
        }
        
        // Procesar banner
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $filename = 'banners/'.$user->id.'_'.time().'.'.$banner->getClientOriginalExtension();
            
            // Redimensionar y guardar
            $image = Image::make($banner)->fit(1500, 500);
            Storage::disk('public')->put($filename, (string) $image->encode());
            
            // Eliminar el banner anterior si existe
            if ($user->banner) {
                Storage::disk('public')->delete($user->banner);
            }
            
            $data['banner'] = $filename;
        }*/
        
        
        
        return response()->json([
            'message' => 'Perfil actualizado correctamente',
        ]);
    }
}
