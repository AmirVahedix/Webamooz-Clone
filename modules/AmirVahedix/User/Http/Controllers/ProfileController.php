<?php


namespace AmirVahedix\User\Http\Controllers;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Http\Requests\UpdateAvatarRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('User::profile.show');
    }

    public function update(Request $request)
    {
        auth()->user()->update($request->all());

        toast('تغییرات باموفقیت انجام شد.', 'success');
        return redirect(route('users.profile.show'));
    }

    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $media = MediaService::publicUpload($request->file('image'));

        if (auth()->user()->avatar) {
            auth()->user()->avatar->delete();
        }

        auth()->user()->update(['avatar_id' => $media->id]);

        toast('عکس پروفایل باموفقیت آپدیت شد.', 'success');
        return back();
    }
}
