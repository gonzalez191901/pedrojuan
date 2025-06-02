<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = \App\User::where('id', 1)->firstOrFail();
        
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
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'bio' => 'nullable|string|max:160',
            'location' => 'nullable|string|max:30',
            'website' => 'nullable|url|max:100',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        $data = $request->only(['name', 'username', 'bio', 'location', 'website']);
        
        // Procesar avatar
        if ($request->hasFile('avatar')) {
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
        }
        
        $user->update($data);
        
        return redirect()->back()->with('success', 'Perfil actualizado correctamente');
    }
}
