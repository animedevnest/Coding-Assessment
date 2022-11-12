<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<!-- <script src="js/jquery.dataTables.min.js"></script> -->

<script src="{{asset('js/sweet-alert.min.js')}}"></script>
<script src="{{asset('js/parsley.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
<script src="{{asset('js/jquery-ui-1.12.1.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>


<div id="onpageload" class="center">
        <div  style="position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('{{asset('images/loader.gif')}}') 50% 50% no-repeat rgba(249, 249, 249, 0);">
        </div>
</div>
<div id="myDivloader" style="display:none;position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('{{asset('images/loader.gif')}}') 50% 50% no-repeat rgba(249, 249, 249, 0);">
</div>
<script>
    $(function () {
	var $loading = $('#myDivloader').hide();
	$(document)
		.ajaxStart(function () {
			$loading.show();
		})
		.ajaxStop(function () {
			$loading.hide();
		});
});
</script>
<script> 
    document.onreadystatechange = function() { 
        if (document.readyState !== "complete") { 
            document.querySelector( 
              "#onpageload").style.visibility = "visible"; 
        } else { 
            document.querySelector( 
              "#onpageload").style.display = "none"; 
        } 
    }; 
</script> 
@stack('scripts')