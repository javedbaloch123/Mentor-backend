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
                                
                                <h5 class="mb-4">Edit Trainer</h5>
                                <div class="row mb-3">
                                    <label for="input35" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $trainer->name }}" class="form-control"
                                            id="title" name="name" placeholder="name">
                                            <p></p>
                                    </div>
                                </div>
 

                                <div class="row mb-3">
                                    <label for="input36" class="col-sm-3 col-form-label">Skill</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $trainer->skill }}" class="form-control"
                                            id="skill" name="skill" placeholder="Schedule">
                                            <p></p>
                                    </div>
                                </div>
                                
                                
                                <div class="row mb-3">
                                    <label for="input40" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="description">{{ $trainer->desc }}</textarea>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="input40" class="col-sm-3 col-form-label">Picture</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="image" name="image"></input>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-sm 6">
                                    <img src="{{ asset('trainer_images/' . $trainer->picture) }}" alt="" width="100px"
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
            formData.append('id',{{ $trainer->id }});
            $.ajax({
                url: '{{ route("update.trainer") }}',
                type: 'post',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                     if(response.status === false){

                    	let errors = response.error;
                    	 let keys = ['name','desc','skill','image'];
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
                    	window.location.href = '{{ route("trainers") }}';
                     }

                }

            });
        });

    </script>
@endsection

 