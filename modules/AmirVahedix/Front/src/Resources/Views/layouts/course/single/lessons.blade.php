<div class="episodes-list">
    <div class="episodes-list--title">فهرست جلسات</div>
    <div class="episodes-list-section">
        @foreach($lessons as $lessonItem)
            <div class="episodes-list-item
                    @if(isset($lesson)) {{ $lessonItem->number == request()->route()->parameter('number') ? 'selected' : '' }} @endif
                    {{ $lessonItem->free ? '' : 'lock' }}
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
                            <a class="detail-download">
                                <i class="icon-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
