@extends('layout')

@section('main')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">

                            <form id="editForm" name="editForm" enctype="multipart/form-data">
                                @csrf
                                
                                <h5 class="mb-4">Edit Course</h5>
                                <div class="row mb-3">
                                    <label for="input35" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $course->title }}" class="form-control"
                                            id="title" name="title" placeholder="title">
                                            <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input36" class="col-sm-3 col-form-label">Seats</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $course->seats }}" class="form-control"
                                            id="seats" name="seats" placeholder="seats">
                                            <p></p>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="input36" class="col-sm-3 col-form-label">Schedule</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $course->schedule }}" class="form-control"
                                            id="schedule" name="schedule" placeholder="Schedule">
                                            <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input36" class="col-sm-3 col-form-label">Fees</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $course->fee }}" class="form-control"
                                            id="fees" name="fees" placeholder="Fees">
                                            <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input39" class="col-sm-3 col-form-label">Select Trainer</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="trainer" name="trainer">
                                            <option selected value="">Select Trainer</option>
                                            @foreach ($trainers as $trainer)
                                                <option value="{{ $trainer->id }}"
                                                    {{ $trainer->id == $course->trainer_id ? 'selected' : '' }}>
                                                    {{ $trainer->name }}</option>
                                            @endforeach

                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input40" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="description">{{ $course->desc }}</textarea>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input40" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="image" name="image"></input>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-sm 6">
                                    <img src="{{ asset('images/' . $course->image) }}" alt="" width="100px"
                                        height="100px">
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Update</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('customJs')
    <script>
        $('#editForm').submit((e) => {
            e.preventDefault();

            let formData = new FormData($('#editForm')[0]);
            formData.append('id',{{ $course->id }});
            $.ajax({
                url: '{{ route("update.course") }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend:function(){
                      $('#editForm :input').prop('disabled',true);
                },
                success: function(response) {
                     if(response.status === false){

                    	let errors = response.error;
                    	 let keys = ['title','schedual','desc','seat','fees','image','trainer'];
                    		   keys.forEach(element => {
                    			   $(`#${element}`).removeClass('is-invalid');
                    	           $(`#${element}`).next('p').text('');
                    		  });

                        for (let key in errors) {
                    	 if (errors.hasOwnProperty(key)) {
                    		// Add is-invalid class
                    		 console.log(key)
                    		 $(`#${key}`).addClass('is-invalid');
                    		 $(`#${key}`).next('p').text(errors[key][0]).css('color','red');

                    	}
                    }
                     }
                     else{
                        $('#editForm')[0].reset();
                    	window.location.href = '{{ route("courses") }}';
                     }

                },
              
                complete:function(){
                      $('#editForm :input').prop('disabled',false);
                }

            });
        });
    </script>
@endsection
