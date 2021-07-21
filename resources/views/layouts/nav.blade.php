<nav class="navbar-top">
    <div class="max-width">
        <div class="logo"><a href="{{route('landing')}}">Portfo<span>lio.</span></a></div>
        <ul class="menu">
            <li class="nav-item"><a class="nav-link" href="#about">Sobre Mí</a></li>
            <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
            <li class="nav-item"><a class="nav-link" href="#projects">Proyectos</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
        </ul>
        <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>
<script>
$(document).ready(function () {
    if($(window).scrollTop() > 20){
        $(".navbar-top").addClass("sticky");
    }
    $(window).scroll(function () {
        if (this.scrollY > 20) {
            $(".navbar-top").addClass("sticky");
        } else {
            $(".navbar-top").removeClass("sticky");
        }
        if (this.scrollY > 500) {
            $(".scrollUp").addClass("show");
        } else {
            $(".scrollUp").removeClass("show");
        }
    });
});
</script>