@extends('layout')

@section('main')
  
    <div class="page-wrapper" style="position: relative">
        {{-- <div id="ajaxloader">
            <div class="spinner-grow" role="status"> <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow" role="status"> <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow" role="status"> <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}
        <div class="page-content">

            <div class="row">

                <div class="col-lg-8 mx-auto">
                    @if (Session::has('success'))
                        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-success"><i class="bx bxs-check-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-success">Success</h6>
                                    <div>{{ Session::get('success') }}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <button class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#courseModal">Add
                        Course</button>
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="example_length"><label>Show <select
                                                        name="example_length" aria-controls="example"
                                                        class="form-select form-select-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> entries</label></div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div id="example_filter" class="dataTables_filter"><label>Search:<input
                                                        type="search" class="form-control form-control-sm" placeholder=""
                                                        aria-controls="example"></label></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example" class="table table-striped table-bordered dataTable"
                                                style="width: 100%;" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Fees</th>
                                                        <th>Schedule</th>
                                                        <th>Seats</th>
                                                        <th>Image</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @if ($courses)
                                                        @foreach ($courses as $course)
                                                            <tr role="row" class="odd">
                                                                <td class="sorting_1">{{ $course->title }}</td>
                                                                <td>{{ $course->desc }}</td>
                                                                <td>{{ $course->fee }}</td>
                                                                <td>{{ $course->schedule }}</td>
                                                                <td>{{ $course->seats }}</td>
                                                                <td>{{ $course->image }}</td>
                                                                <td><a href="{{ route('edit.course', $course->id) }}"><button
                                                                            class="btn btn-primary">Edit</button></a></td>
                                                                <td><button class="btn btn-danger"
                                                                        onclick="Delete({{ $course->id }})">Delete</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                                <tfoot>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Fees</th>
                                                    <th>Schedule</th>
                                                    <th>Seats</th>
                                                    <th>Image</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="example_info" role="status"
                                                aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled"
                                                        id="example_previous"><a href="#" aria-controls="example"
                                                            data-dt-idx="0" tabindex="0" class="page-link">Prev</a></li>
                                                    <li class="paginate_button page-item active"><a href="#"
                                                            aria-controls="example" data-dt-idx="1" tabindex="0"
                                                            class="page-link">1</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example" data-dt-idx="2" tabindex="0"
                                                            class="page-link">2</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example" data-dt-idx="3" tabindex="0"
                                                            class="page-link">3</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example" data-dt-idx="4" tabindex="0"
                                                            class="page-link">4</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example" data-dt-idx="5" tabindex="0"
                                                            class="page-link">5</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example" data-dt-idx="6" tabindex="0"
                                                            class="page-link">6</a></li>
                                                    <li class="paginate_button page-item next" id="example_next"><a
                                                            href="#" aria-controls="example" data-dt-idx="7"
                                                            tabindex="0" class="page-link">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



<div class="modal fade" id="courseModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body p-4">

                        <form class="row g-3" id="courseForm" name="courseForm" enctype="multipart/form-data">

                            @csrf
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Course Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="First Name">
                                <p></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input6" class="form-label">Schedual</label>
                                <input type="text" class="form-control" id="schedual" name="schedual"
                                    placeholder="Schedual">
                                <p></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input7" class="form-label">Trainer</label>
                                <select id="trainer" name="trainer" class="form-select">
                                    <option selected value="">Choose Trainer</option>
                                    @foreach ($trainers as $trainer)
                                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                    @endforeach
                                </select>
                                <p></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input8" class="form-label">Seats</label>
                                <input type="number" class="form-control" id="seat" name="seat"
                                    placeholder="seats">
                                <p></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input8" class="form-label">Fees</label>
                                <input type="text" class="form-control" id="fees" name="fees"
                                    placeholder="fees">
                                <p></p>
                            </div>
                            <div class="col-md-12">
                                <label for="input11" class="form-label">Description</label>
                                <textarea class="form-control" id="desc" name="desc" placeholder="description ..." rows="3"></textarea>
                                <p></p>
                            </div>

                            <div class="col-md-12">
                                <label for="input11" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <p></p>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@section('customJs')
    <script>
        
        $('#courseForm').submit((e) => {
            e.preventDefault();
            let formData = new FormData($('#courseForm')[0]);
            $.ajax({
                url: '{{ route('process.course') }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() {
                      $('#courseForm :input').prop('disabled',true);
                 },

                success: function(response) {
                    if (response.status === false) {

                        let errors = response.error;
                        let keys = ['title', 'schedual', 'desc', 'seat', 'fees', 'image', 'trainer'];
                        keys.forEach(element => {
                            $(`#${element}`).removeClass('is-invalid');
                            $(`#${element}`).next('p').text('');
                        });

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                // Add is-invalid class
                             
                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}`).next('p').text(errors[key][0]).css('color', 'red');

                            }
                        }
                    } else {
                           $('#courseForm')[0].reset();
                        window.location.href = '{{ route('courses') }}';
                    }

                },
                complete:function(){
                    
                      $('#courseForm :input').prop('disabled',false);
                }

            });
        });



        function Delete(id) {
            if (confirm('Sure You Want To Delete')) {
                $.ajax({
                    url: '{{ route('delete.course', ':id') }}'.replace(':id', id),

                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            window.location.href = '{{ route('courses') }}'
                        }
                    }
                });
            }

        }
    </script>
@endsection


@section('customCss')
    <style>
        /* #ajaxloader {
            background: rgba(131, 130, 130, 0.267);
            position: absolute;
            z-index: 999;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none
        } */
    </style>
@endsection
