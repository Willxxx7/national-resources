@extends('layouts.app')
@use(App\Models\EventType)

@section('content')
    <div class="page-header">
        <h2>Dashboard</h2>
        <button type="button" class="btn-primary" onclick="document.getElementById('createEventModal').style.display='flex'">
            <i class="fa fa-plus"></i>
            Create Event
        </button>
    </div>

    <section id="statistics">
            <h3>At a Glance</h3>

            <div class="statistics-row">
                <article class="statistic">
                    @php
                        $total = $pending->count() + $completed->count();
                    @endphp
                    <header>
                        <h4>Orders</h4>
                    </header>
                    <div class="statistic-progress">
                        <div class="statistic-progress-label">
                            <span class="statistic-value">{{ $completed->count() }}</span>
                            <span class="statistic-additional">of {{ $total }} completed</span>
                        </div>
                        <progress class="statistic-progress-bar" value="{{ $completed->count() }}"
                            max="{{ $total }}"></progress>
                    </div>
                    <span class="statistic-additional">{{ $pendingOverLastWeek->count() }} new this week</span>
                </article>

                <article class="statistic">
                    <header>
                        <h4>Avg. Order Picture Count</h4>
                    </header>
                    <span class="statistic-value">{{ $averagePictureCount }}</span>
                    <span class="statistic-additional">{{ $averagePictureCountOverLastWeek }} this week</span>
                </article>

                <article class="statistic">
                    <header>
                        <h4>Popular Picture Sizes</h4>
                    </header>
                    <ul class="statistic-list">
                        @foreach ($pictureSizesByPopularity as $size => $count)
                            <li>
                                <span class="statistic-value">{{ $size }}</span>
                                <span class="statistic-additional">{{ $count }}
                                    {{ \Illuminate\Support\Str::plural('order', $count) }}</span>
                                <progress class="statistic-progress-bar" value="{{ $count }}"
                                    max="{{ $pictureSizesByPopularity->max() }}"></progress>
                            </li>
                        @endforeach
                    </ul>
                </article>

                <article class="statistic">
                    <header>
                        <h4>Income by Picture Size</h4>
                    </header>

                    <ul class="statistic-list">
                        @foreach ($incomeByPictureSize as $size => $income)
                            <li>
                                <span class="statistic-value">{{ $size }}</span>
                                <span class="statistic-additional">£{{ number_format($income, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </section>

        @include('events._create_modal')
@endsection
