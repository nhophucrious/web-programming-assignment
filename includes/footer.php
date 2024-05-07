<style>
.footer {
    background-color: black !important;
}
</style>
<footer class="footer bg-dark text-white mt-auto">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-6">
                <h2 class="h5">HiredCMUT Job Portal</h2>
                
            </div>
            
        </div>
    </div>
</footer>
<script>
    function scrollToSection(id) {
        var element = document.getElementById(id);
        var headerOffset = 70; // Adjust this value based on the height of your header
        var elementPosition = element.getBoundingClientRect().top;
        var offsetPosition = elementPosition - headerOffset;

        window.scrollTo({
            top: offsetPosition,
            behavior: "smooth"
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</body>
</html>