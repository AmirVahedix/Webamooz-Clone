<form action="{{ route('users.avatar.update', auth()->id()) }}" method="POST" x-ref="form" x-data
      enctype="multipart/form-data">
    @csrf
    <div>
        <div class="profile__info border cursor-pointer text-center">
            <div class="avatar__img">
                <img src="{{ auth()->user()->user_avatar ?? asset('panel/img/pro.jpg') }}" class="avatar___img">
                <input type="file" accept="image/*" name="image" class="hidden avatar-img__input"
                       x-on:change="$refs.form.submit()">
                <div class="v-dialog__container" style="display: block;"></div>
                <div class="box__camera default__avatar"></div>
            </div>
            <span class="profile__name">{{ auth()->user()->name }}</span>
        </div>
    </div>
</form>
