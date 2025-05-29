{{-- <div class="modal fade" id="courseModal" tabindex="-1" aria-hidden="true" style="display: none;">
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
										<input type="text" class="form-control" id="title" name="title" placeholder="First Name">
									</div>
									  
									<div class="col-md-12">
										<label for="input6" class="form-label">Schedual</label>
										<input type="text" class="form-control" id="schedual" name="schedual" placeholder="Schedual">
									</div>
									<div class="col-md-12">
										<label for="input7" class="form-label">Trainer</label>
										<select id="trainer" name="trainer" class="form-select">
											<option selected="">Choose...</option>
											<option>One</option>
											<option>Two</option>
											<option>Three</option>
										</select>
									</div>
									
									<div class="col-md-12">
										<label for="input8" class="form-label">Seats</label>
										<input type="number" class="form-control" id="seat" name="seat" placeholder="seats">
									</div>
									 
									 <div class="col-md-12">
										<label for="input8" class="form-label">Fees</label>
										<input type="text" class="form-control" id="fees" name="fees" placeholder="fees">
									</div>
									<div class="col-md-12">
										<label for="input11" class="form-label">Description</label>
										<textarea class="form-control" id="desc" name="desc" placeholder="description ..." rows="3"></textarea>
									</div>
									  
									<div class="col-md-12">
										<label for="input11" class="form-label">Image</label>
										 <input type="file" class="form-control" name="image" id="image">
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
</div> --}}



<div class="modal fade" id="trainerModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Trainer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <div class="modal-body"> 
        <div class="card">
							<div class="card-body p-4">
	
								<form class="row g-3" id="trainerForm" name="trainerForm">
									@csrf
									<div class="col-md-12">
										<label for="input1" class="form-label">Name</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="First Name">
										<p></p>
									</div>
									  
									<div class="col-md-12">
										<label for="input6" class="form-label">Skill</label>
										<input type="text" class="form-control" id="skill" name="skill" placeholder="Skill">
										<p></p>
									</div>
									 
								
									<div class="col-md-12">
										<label for="input11" class="form-label">Description</label>
										<textarea class="form-control" id="desc" name="desc" placeholder="description ..." rows="3"></textarea>
										<p></p>
									</div>
									  
									<div class="col-md-12">
										<label for="input11" class="form-label">Picture</label>
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
	
    $('#trainerForm').submit((e)=>{
           e.preventDefault();
		    let formData = new FormData($('#trainerForm')[0]);
		    $.ajax({
                url: '{{ route("process.trainer") }}',
				type: 'post',
				data: formData,
				dataType: 'json',
				contentType: false,
				processData: false,
				success: function(response){
					 if(response.status === false){
                          let errors = response.error;
						 let keys = ['name','skill','desc','image'];
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
					 }else{
						 window.location.reload();
					 }
				}

			});
		});

	</script>
@endsection