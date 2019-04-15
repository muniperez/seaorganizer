<div class="modal fade slide-right" id="newCertificateModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content-wrapper">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
				</button>
				
				<div class="container-xs-height full-height">
					<div class="row-xs-height">
						<div class="modal-body col-xs-height col-middle">
							<form method="post" action="/certificates" role="form" >
								{{ csrf_field() }}

								<h4 class="text-primary ">Add a new certificate</h4>
								
								<div class="form-group">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group form-group-default">
												<label>Certificate name *</label>
												<input type="text" class="form-control" name="label" >
											</div>

											<div class="form-group form-group-default input-group">
												<label>Expiration date *</label>
												<input type="text" class="form-control datepicker" name="expiration" >
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>

											<button type="submit" class="btn btn-success btn-block">Save</button>
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
</div>