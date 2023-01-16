
					<!--begin::Footer-->
					<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
						<!--begin::Container-->
						<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">

						</div>
						<!--end::Container-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->

		<!--begin::Javascript-->
		<script>var hostUrl = "{{ asset('metronic_assets/assets/') }}";</script>
		<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>

		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('metronic_assets/assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('dashboard_assets/js/ckeditor/ckeditor.js') }}"></script>
		<script src="{{ asset('dashboard_assets/assets/vendor/libs/select2/select2.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function () {
					if($('.select2Fe').length != 0 ){
						$('.select2Fe').select2();
					}
					if($('.ckeditor').length != 0 ){
						$('.ckeditor').ckeditor();
					}
			});
		</script>
<script>


</script>

		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{ asset('metronic_assets/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->

		<script src="{{ asset('metronic_assets/assets/js/widgets.bundle.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/custom/utilities/modals/create-app.js') }}"></script>
		<script src="{{ asset('metronic_assets/assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
