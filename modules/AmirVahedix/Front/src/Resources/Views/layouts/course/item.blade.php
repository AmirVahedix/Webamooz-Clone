<div class="col">
    <a href="{{ route('courses.single', $course->slug) }}">
        <div class="course-status">
            {{ __($course->status) }}
        </div>
        @if($course->getDiscountPercent())
            <div class="discountBadge">
                <p>{{ $course->getDiscountPercent() }}%</p>
                تخفیف
            </div>
        @endif
        <div class="card-img"><img src="{{ $course->thumb }}" alt="{{ $course->title }}"></div>
        <div class="card-title"><h2>{{ $course->title }}</h2></div>
        <div class="card-body">
            <img src="{{ $course->teacher->user_avatar ?? asset('panel/img/profile.jpg') }}" alt="{{ $course->teacher->name }}">
            <span>{{ $course->teacher->name }}</span>
        </div>
        <div class="card-details">
            <div class="time">{{ $course->formatted_duration }}</div>
            <div class="price">
                @if($course->getDiscountAmount())
                    <div class="discountPrice">{{ number_format($course->price) }}</div>
                @endif
                <div class="endPrice">{{ number_format($course->getFinalPrice()) }}</div>
            </div>
        </div>
    </a>
</div>
