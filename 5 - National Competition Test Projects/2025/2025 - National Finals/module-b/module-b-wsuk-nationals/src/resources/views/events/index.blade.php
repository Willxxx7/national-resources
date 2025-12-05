@extends('layouts.app')
@use(App\Models\EventType)
@section('content')
    

        @if (session('success'))
            <div class="status success">
                <p> {{ session('success') }}</p>
            </div>
        @endif

        @if (session('errors'))
            <div class="status error">
                <p>{{ session('errors')->first() }}</p>
            </div>
        @endif

        <div class="page-header" style="margin-bottom: 1.5rem;">
            <h2>Events</h2>
            <button type="button" class="btn-primary" onclick="document.getElementById('createEventModal').style.display='flex'">
                <i class="fa fa-plus"></i>
                Create Event
            </button>
        </div>

        <div class="table-responsive">
        <table class="themed-table">
            <thead>
            <tr>
                <th>
                    <a href="{{ route('events.index', array_merge(request()->except('page'), ['sort' => 'event_name', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                            @class([
                                'sort-link',
                                'active' => empty(request('sort')) || request('sort') === 'event_name',
                            ])>
                        Name

                        @if (request('sort') === 'event_name')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @elseif (empty(request('sort')))
                            <i class="fa fa-arrow-down"></i>
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th>Category</th>
                <th>Type</th>
                <th>
                    <a href="{{ route('events.index', array_merge(request()->except('page'), ['sort' => 'event_city', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                            @class(['sort-link', 'active' => request('sort') === 'event_city'])>
                        City

                        @if (request('sort') === 'event_city')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('events.index', array_merge(request()->except('page'), ['sort' => 'event_date', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                            @class(['sort-link', 'active' => request('sort') === 'event_date'])>
                        Date &amp; Time

                        @if (request('sort') === 'event_date')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th class="hide-mobile">Note</th>
                <th class="hide-mobile">Path</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($events as $event)
                <tr>
                    <td>
                        <a class="link" href="{{route('events.show', ['path' => $event->event_folder_path])}}">
                            {{ $event->event_name }}
                        </a>
                    </td>
                    <td>{{$event->category->cat_name}}</td>
                    <td>{{ ucfirst($event->event_type->value) }}</td>
                    <td>{{ $event->event_city }}</td>
                    <td>{{ $event->date_time->isoFormat('LLL') }}</td>
                    <td class="hide-mobile">{{ $event->event_note }}</td>
                    <td class="hide-mobile">{{ $event->event_folder_path }}</td>
                    <td>
                        @if($event->is_active)
                            <span style="color: var(--success); font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
                                <i class="fa fa-check-circle"></i>
                                <span class="hide-mobile-text">Active</span>
                            </span>
                        @else
                            <span style="color: var(--error); font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
                                <i class="fa fa-times-circle"></i>
                                <span class="hide-mobile-text">Inactive</span>
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn-icon btn-edit" title="Edit event" onclick='openEditModal({
                                updateUrl: "{{ route('events.update', compact('event')) }}",
                                name: {{ json_encode($event->event_name) }},
                                categoryId: {{ $event->cat_id }},
                                type: {{ json_encode($event->event_type->value) }},
                                city: {{ json_encode($event->event_city) }},
                                dateTime: {{ json_encode($event->date_time->format('Y-m-d\TH:i')) }},
                                note: {{ json_encode($event->event_note) }}
                            })'>
                                <i class="fa fa-edit"></i>
                            </button>

                            <form method="POST" action="{{ route('events.toggle', compact('event')) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" @class([
                                    'btn-icon',
                                    'btn-update' => !$event->is_active,
                                    'btn-cancel' => $event->is_active,
                                ]) title="{{ $event->is_active ? 'Deactivate event' : 'Activate event' }}">
                                    <i class="fa fa-{{ $event->is_active ? 'eye-slash' : 'eye' }}"></i>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('events.destroy', compact('event')) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-icon btn-delete" title="Delete event">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            @if($event->event_type == EventType::PRIVATE)
                                <a href="{{route('events.access', compact('event'))}}" class="btn-icon btn-access" title="Manage access codes">
                                    <i class="fa fa-lock"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $events->appends(request()->except('page'))->links() }}
        </div>

        @include('events._create_modal')
        @include('events._edit_modal')
@endsection
