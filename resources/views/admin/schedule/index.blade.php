@extends('partial.adm_master')

@section('cssneeded')
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css' rel='stylesheet' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.print.css' media='print' />

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
</style>
@endsection

@section('admin_pencarian')
<form class="d-none d-md-flex ms-4" action="/schedules">
    <input class="form-control bg-dark border-0" name="search" type="search" placeholder="Search" autocomplete="off" value="{{ request('search') }}">
</form>
@endsection

@section('admin_content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- table -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Data Appointment</h6>
                    <a href="/schedules">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kontak</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Layanan</th>
                                <th scope="col">Tambahan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- diulang -->
                            @foreach ($scheds as $sched)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $sched->customer->name }}</td>
                                <td>{{ $sched->customer->email }}</td>
                                <td>{{ $sched->schedule }}</td>
                                <td><a href="" data-bs-toggle="modal" data-bs-target="#detail{{ $sched->id }}"> Detail layanan{{ $sched->id }}</a></td>
                                <td>{{ $sched->fnote }}</td>
                                <td class="text-center d-flex flex-warp  justify-content-center">
                                    <a class="btn btn-sm btn-info" href="/pesans/jadwal/{{ $sched->id }}">Reply</a> |
                                    @if( $sched->status)
                                    <form action="/schedules/{{ $sched->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash-can px-1"></i></button>
                                    </form>
                                    @else
                                    <form action="/schedules/{{ $sched->id }}" method="post" class="d-inline">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="service_id" value="{{ $sched->service_id }}">
                                        <input type="hidden" name="customer_id" value="{{ $sched->customer_id }}">
                                        <input type="hidden" name="schedule" value="{{ $sched->schedule }}">
                                        <input type="hidden" name="fnote" value="{{ $sched->fnote }}">
                                        <input type="hidden" name="bill" value="{{ $sched->bill }}">
                                        <input type="hidden" name="status" value="1">
                                        <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure?')">Done</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Modal untuk isi pesan -->
                            <div class="modal fade" id="detail{{ $sched->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detail{{ $sched->id }}Label">Appointment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <article class="text-start">
                                                <!-- Post header-->
                                                <header class="mb-4">
                                                    <!-- Post title-->
                                                    <h6 class="fw-bolder mb-1">{{ $sched->customer->name?? "Anonymous" }}</h6>
                                                    <!-- Post meta content-->
                                                    <div class="text-muted fst-italic mb-2">Created by {{ $sched->customer->name }} on {{ $sched->created_at->format('d M Y') }}</div>
                                                    <!-- Post categories-->
                                                    <a class="badge bg-secondary text-decoration-none link-light">@if ($sched->package == 1) Paket @else Layanan biasa @endif</a>
                                                </header>
                                                <!-- Post content-->
                                                <section class="mb-3">
                                                    <p class="fs-6 mb-2">
                                                        @if ($sched->package == 0)
                                                        Pilihan layanan : {{ $sched->service->name?? "Layanan terhapus" }}
                                                    <p>
                                                        Tagihan : Rp. {{ $sched->service->price?? "Layanan terhapus" }}
                                                    </p>
                                                    @endif

                                                    @if ($sched->package == 1)
                                                    @foreach ($paket as $pak)
                                                    @if ($pak->id == $sched->service_id)
                                                    Pilihan Paket : {{ $pak->name }}
                                                    <p>
                                                        Tagihan : Rp. {{ $pak->price }}
                                                    </p>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    </p>

                                                </section>
                                            </article>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <!-- sampai sini -->
                        </tbody>
                    </table>
                </div>
                <div class="d-flex mt-3 justify-content-end">
                    {{ $scheds->links() }}
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-xl-12">
            <div class="h-100 bg-secondary rounded p-4">
                <h3 class="text-center my-5">Calendar Events</h3>
                <div id="calendar"> </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah jadwal baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" placeholder="title">
                    <label for="title">Event</label>
                </div>
                <input type="hidden" id="employee_id" value="{{ auth()->user()->employee_id }}">
                <span id="titleError" class="text-danger"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsneeded')
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js'></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var booking = @JSON($events);
        var booking2 = @JSON($appos);
        $('#calendar').fullCalendar({
            header: {
                right: 'prev,next today',
                center: 'title',
                left: 'month,basicWeek,basicDay'
            },
            eventSources: [{
                events: booking,
            }, {
                events: booking2
            }],
            navLinks: true,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDays) {
                $('#bookingModal').modal('toggle');
                $('#saveBtn').click(function() {
                    var title = $('#title').val();
                    var start_date = moment(start).format('YYYY-MM-DD');
                    var end_date = moment(end).format('YYYY-MM-DD');
                    $.ajax({
                        url: "{{ route('schedusers.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            title,
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            $('#bookingModal').modal('hide')
                            $('#calendar').fullCalendar('renderEvent', {
                                'title': response.title,
                                'start': response.start,
                                'end': response.end,
                                'color': response.color,
                                'id': response.id
                            });
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                });
            },

            editable: true,
            eventDrop: function(event) {
                var id = event.id;
                var start_date = moment(event.start).format('YYYY-MM-DD');
                var end_date = moment(event.end).format('YYYY-MM-DD');
                console.log(id);
                $.ajax({
                    url: "{{ route('schedusers.update', '') }}" + '/' + id,
                    method: "POST",
                    type: "PATCH",
                    dataType: 'json',
                    data: {
                        start_date,
                        end_date
                    },
                    success: function(response) {
                        swal("Good job!", "Event Updated!", "success");
                    },
                    error: function(error) {
                        console.log(error)
                    },
                });
            },
            eventClick: function(event) {
                var id = event.id;
                if (confirm('Are you sure want to remove it')) {
                    $.ajax({
                        url: "{{ route('schedusers.destroy', '') }}" + '/' + id,
                        method: "POST",
                        type: "DELETE",
                        dataType: 'json',
                        success: function(response) {
                            $('#calendar').fullCalendar('removeEvents', response);
                            // swal("Good job!", "Event Deleted!", "success");
                        },
                        error: function(error) {
                            console.log(error)
                        },
                    });
                }
            },
            selectAllow: function(event) {
                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },
        });
        $("#bookingModal").on("hidden.bs.modal", function() {
            $('#saveBtn').unbind();
        });
        // $('.fc-event').css('font-size', '13px');
        // $('.fc-event').css('width', '20px');
        // $('.fc-event').css('border-radius', '50%');
    });
</script>
@endsection