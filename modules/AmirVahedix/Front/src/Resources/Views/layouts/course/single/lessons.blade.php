<div class="episodes-list">
    <div>
        <div class="episodes-list--title">
            فهرست جلسات
            @can('download', $course)
                <a href="{{ route('courses.download.all', $course->id) }}">دریافت همه لینک‌های دانلود</a>
            @endcan
        </div>

    </div>
    <div class="episodes-list-section">
        @foreach($lessons as $lessonItem)
            <div class="episodes-list-item
                    @if(isset($lesson)) {{ $lessonItem->number == request()->route()->parameter('number') ? 'selected' : '' }} @endif
                    @cannot('download', $lessonItem) {{ !$lessonItem->free ? 'lock' : '' }} @endcannot
                ">
                <div class="section-right">
                    <span class="episodes-list-number">{{ $lessonItem->number }}</span>
                    <div class="episodes-list-title">
                        <a href="{{ route('lessons.single', [$course->slug, $lessonItem->number]) }}">{{ $lessonItem->title }}</a>
                    </div>
                </div>
                <div class="section-left">
                    <div class="episodes-list-details">
                        <div class="episodes-list-details">
                            <span class="detail-type">{{ $lessonItem->free ? 'رایگان' : '' }}</span>
                            <span class="detail-time">{{ $lessonItem->formatted_duration }}</span>
                            <a class="detail-download"
                               @if((auth()->check() && auth()->user()->can('download', $lessonItem)) || $lessonItem->free) href="{{ $lessonItem->downloadLink() }}" @endif
                            >
                                <i class="icon-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
