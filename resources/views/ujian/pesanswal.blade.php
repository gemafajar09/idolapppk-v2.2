@if(Session::has('sukses'))
<script type="text/javascript">
	swal({
	  title: "Seccess",
	  text: "{!! Session::get('sukses')!!}",
	  icon: "success",
	});
</script>

@elseif(Session::has('gagal'))
<script type="text/javascript">
	swal({
	  title: "Error",
	  text: "{!! Session::get('gagal')!!}",
	  icon: "error",
	});
</script>
@endif