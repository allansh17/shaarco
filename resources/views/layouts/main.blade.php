<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
	<title>@yield('title','') | {{env('APP_NAME')}}</title>
	<!-- initiate head with meta tags, css and script -->
	@include('include.head')

</head>
<body id="app" class="">
    <div class="wrapper">
    	<!-- initiate header-->
    	@include('include.header')
    	<div class="page-wrap">
	    	<!-- initiate sidebar-->
	    	@include('include.sidebar')

	    	<div class="main-content">
	    		<!-- yeild contents here -->
	    		@yield('content')
	    	</div>

	    	<!-- initiate chat section-->
	    	<!-- @include('include.chat') -->


	    	<!-- initiate footer section-->
<!--	    	@include('include.footer')-->

    	</div>
    </div>
    
	<!-- initiate modal menu section-->
	@include('include.modalmenu')
	<style type="text/css">
		.close_button{
        cursor: pointer;
        position: absolute;
        top: 22px;
        right: 10px;
        display: none;
    }
	</style>
	<script type="text/javascript">
setTimeout(function () { 
    $('.close_button').on('click',function () {
        if($('#listing_table').DataTable().search()!=''){
            $('#listing_table').DataTable().search('').draw();
        }
    });
},3000);
</script>
	<div class="loader">
		<img src="{{asset('/dist/img')}}/loader-img.gif" alt="loader-img">
	</div>
	
	<script>
		$('.loader').hide();
	</script>
	<!-- initiate scripts-->
	@include('include.script')	
	<script>
		function logout() {
			$.confirm({
            title: 'Delete',
            content: 'Are you sure you want to logout ?',
            buttons: {
                Cancel: function () {
                    //nothing to do
                },
                Sure: {
                    btnClass: 'btn-primary',
                    action: function () {
                        window.location.href = "{{ url('logout') }}";
                    },
                }
            }
        });
		}
	</script>
	@stack('app-script')
</body>
</html>
