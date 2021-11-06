<?php


namespace AmirVahedix\User\Http\Controllers;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Http\Requests\UpdateAvatarRequest;
use AmirVahedix\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('User::profile.show', [
            "user" => auth()->user()
        ]);
    }

    public function info($user_id)
    {
        $user = User::query()->where('id', $user_id)
            ->with(['purchases', 'courses'])
            ->first();

        return view("User::admin.user-info", compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->except('password'));

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
