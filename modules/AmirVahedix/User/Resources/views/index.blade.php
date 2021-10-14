@extends('Dashboard::master')

@section('title', 'همه کاربران')

@section('breadcrumbs')
    <li><a href="{{ route('dashboard.index') }}">پیشخوان</a></li>
    <li><a href="#">کاربران</a></li>
@endsection

@section('content')
    <div class="main-content">
        <div class="table__box">
            <table class="table">

                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام</th>
                    <th>شماره تلفن</th>
                    <th>ایمیل</th>
                    <th>نقش کاربری</th>
                    <th>وضعیت تایید</th>
                    <th>وضعیت حساب</th>
                    <th>تاریخ عضویت</th>
                    <th>عملیات</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr role="row" x-data="{delete_modal: false, role_modal: false}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone ?? 'ثبت نشده' }}</td>
                        <td>{{ $user->email }}</td>
                        <td style="display: flex; flex-direction: column">
                            @if(count($user->roles))
                                <ul style="list-style: none">
                                    @foreach($user->roles as $role)
                                        <li>@lang($role->name)</li>
                                    @endforeach
                                </ul>
                            @else
                                <span>کاربر عادی</span>
                            @endif

                            @can('manage_authorization')
                                <a href="#" class="item-edit " x-on:click="role_modal=true"></a>
                            @endcan
                        </td>

                        <td>
                            @if($user->email_verified_at)
                                <span class="text-success">تایید شده</span>
                            @else
                                <span class="text-error">تاییده نشده</span>
                            @endif
                        </td>
                        <td>{{ __($user->status) }}</td>
                        <td>{{ jdate($user->created_at)->format('%Y/%m/%d') }}</td>
                        <td>
                            <a href="#" class="item-delete mlg-15" x-on:click="delete_modal=true" title="حذف"></a>
                            @if($user->status === \AmirVahedix\User\Models\User::STATUS_ACTIVE)
                                <a href="{{ route('admin.users.ban.toggle', $user->id) }}" class="item-lock mlg-15" title="بن"></a>
                            @elseif($user->status === \AmirVahedix\User\Models\User::STATUS_BAN)
                                <a href="{{ route('admin.users.ban.toggle', $user->id) }}" class="item-lock mlg-15 text-error" title="فعالسازی"></a>
                            @endif
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="item-edit " title="ویرایش"></a>
                        </td>

                        {{-- Delete User Modal --}}
                        <td>
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="delete_modal" x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="delete_modal=false">
                                    <h3>آیا از حذف این کاربر اطمینان دارید؟</h3>
                                    <p>با کلیک بر روی حذف، این کاربر، دوره‌ها، نظرات و تمامی فایل‌هایش حذف میشود.</p>
                                    <div class="modal-actions">
                                        <button class="btn margin-left-10" x-on:click="delete_modal=false">انصراف</button>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-webamooz_net">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Roles Modal --}}
                        <td>
                            <div class="modal hidden" x-init="$el.classList.remove('hidden')" x-show="role_modal" x-transition.opacity>
                                <div class="modal-content" x-on:click.outside="role_modal=false">
                                    <h3>مدیریت نقش‌های {{ $user->name }}</h3>
                                    <p>لطفا نقش‌های کاربر مورد نظر را انتخاب کنید. در صورت خالی بودن، کاربر نقش عادی میگیرد.</p>
                                    <div class="modal-actions">
                                        <form action="{{ route('admin.users.syncRoles', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            @foreach(\AmirVahedix\Authorization\Models\Role::all() as $role)
                                                <x-checkbox name="roles[]" value="{{ $role->id }}" title="{{ $role->name }}"
                                                    checked="{{ in_array($role->id, $user->roles->pluck('id')->toArray()) }}" />
                                            @endforeach

                                            <div style="margin-top: 28px">
                                                <button type="button" class="btn margin-left-10" x-on:click="role_modal=false">انصراف</button>
                                                <button type="submit" class="btn btn-webamooz_net">ثبت</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
