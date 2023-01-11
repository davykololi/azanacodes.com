 <hr>
 <div class="container">
 	<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
 		@include('partials.disqus')
 	</div> 
 </div>
 <hr>
 <!-- Footer -->
<footer class="py-5 bg-dark" style="margin-top: 500px">
    <div class="container">
        <p class="m-0 text-center text-white">
            Copyright &copy; {{ config('app.name', 'Larablog') }} {{ now()->year }} 
            | <a href="https://frencymedia.com">https://frencymedia.com</a>
        </p>
    </div>
    <!-- /.container -->
</footer>
