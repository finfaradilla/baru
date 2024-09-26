@extends('layouts.main')

@section('container')
<!--====== Daftar Ruang ======-->
<div class="preloader">
    <div class="loader">
        <div class="ytp-spinner">
            <div class="ytp-spinner-container">
                <div class="ytp-spinner-rotator">
                    <div class="ytp-spinner-left">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                    <div class="ytp-spinner-right">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="blog" class="blog-area pt-170 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Room List</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-blog h-auto">
                    <div class="blog-img">
                        <a href="/showruang/{{ $room->code }}">
                            @if ($room->img && Storage::exists('public/' . $room->img))
                            <img src="{{ asset('storage/' . $room->img) }}" alt="">
                            @else
                            @if ($room->img)
                            <img src="{{ asset($room->img) }}" alt="FotoRuang">
                            @endif
                            @endif
                        </a>
                    </div>
                    <div class="blog-content">
                        <h4><a href="/showruang/{{ $room->code }}">{{ $room->name }}</a></h4>
                        <p>Capacity: {{ $room->capacity }}</p>
                        <br>
                        @if ($room->rents->count() > 0)
                        <ul>
                            @php
                            $today = \Carbon\Carbon::today();
                            $tomorrow = \Carbon\Carbon::tomorrow();
                            $rentsGrouped = $room->rents->groupBy(function ($rent) use ($today, $tomorrow) {
                                $rentDate = \Carbon\Carbon::parse($rent->time_start_use)->startOfDay();
                                if ($rentDate->equalTo($today)) {
                                    return 'Today';
                                } elseif ($rentDate->equalTo($tomorrow)) {
                                    return 'Tomorrow';
                                } else {
                                    return $rentDate->format('d/m/Y');
                                }
                            });
                            @endphp

                            @foreach ($rentsGrouped as $day => $rents)
                            @if ($loop->index > 0)
                            <br>
                            @endif
                            <li>
                                <strong style="color: green;">
                                    {{ $day }}
                                </strong>
                                <ul>
                                    @foreach ($rents as $rent)
                                    <li>
                                        {{ $rent->user->name }} - {{ $rent->time_start_use->format('H:i') }} - {{ $rent->time_end_use->format('H:i') }}
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <p>No bookings for the next 2 days.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-end">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
