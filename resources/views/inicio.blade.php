@extends('layouts.index')

@section('cuerpo')

@include('layouts.nav')
<section class="home" id="home">
    <div class="max-width">
        <div class="home-content">
            <div class="text-1">Hola, mi nombre es</div>
            <div class="text-2">Jon de Casa</div>
            <div class="text-3">y soy <span class="typing"></span></div>
            <a href="#contact" class="button">Hablemos</a>
        </div>
    </div>
</section>

<section class="about" id="about">
    <div class="max-width">
        <h2 class="title">Sobre mí</h2>
        <div class="about-content row">
            <div class="col-12 col-md-6">
                <img class="img-fluid" src="{{ asset('img/jon_cara.jpg') }}"/>
            </div>
            <div class="col-12 col-md-6 right">
                <div class="text">Apasionado</div>
                <p>Recuerdo, que lo primero que me llamó la atención cuando comencé mis estudios, fue mi primer trabajo en C, un pequeño juego para un proyecto de clase, al que dediqué incansables horas para mejorarlo y añadirle detalles para hacerlo más interesante.
                    Con esto descubrí que es lo que más me gustaba</p>
                <p>Tengo la suerte de amar mi trabajo y disfrutar mucho desarrollandolo, por eso pongo mucho empeño en que todo quede perfecto</p>
                <p>Otra de mis inquietudes es viajar. Me gusta el deporte y soy una persona competitiva.</p>
                
            </div>
        </div>
    </div>
</section>

<section class="services" id="services">
    <div class="max-width">
        <h2 class="title">Servicios</h2>
        <div class="services-content row">
            <div class="card col-12 col-md m-1">
                <div class="box animacionVisible ani-zoom">
                    <i class="fas fa-paint-brush"></i>
                    <div class="text">Diseño Web</div>
                    <p>La mejor manera de contactar y encontrar clientes es una buena web. ¿Tienes ya la tuya? o quizá, ¿quieres cambiarla?</p>
                </div>
            </div>
            <div class="card col-12 col-md m-1">
                <div class="box animacionVisible ani-zoom">
                    <i class="fas fa-code"></i>
                    <div class="text">Aplicaciones a medida</div>
                    <p>Busquemos una solución para agilizar y mejorar el trabajo y la eficiencia de tu día a día.</p>
                </div>
            </div>
            <div class="card col-12 col-md m-1">
                <div class="box animacionVisible ani-zoom">
                    <i class="fas fa-users"></i>
                    <div class="text">Consultoría</div>
                    <p>¿Mejorar la estructura del negocio? Tengo la solución.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="skills" id="skills">
    <div class="max-width">
        <h2 class="title">Skills</h2>
        <div class="row">
            <div class="col-12 col-md-6">
                <p>He trabajado con Java y con .Net, pero prefiero PHP por su versatilidad y su comunidad. 
                    Me gusta el mundo web y la amplitud que brinda PHP. Este lenguaje me hace sentir muy cómodo.</p>
                <p>Laravel me otorga esa posibilidad de desarrollo rápido, seguro e innovador.</p>
                <a href="{{asset("descargas/Jon_Ander_de_Casa_CV.docx")}}" class="btn button button-alt">Descargar CV</a>
            </div>
            <div class="col-12 col-md-6">
                <div>
                    <div class="w-100">
                        <span class="pull-left">jQuery</span>
                        <span class="porcentaje">90%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-red countUp" role="progressbar" style="width: 0%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <div class="w-100">
                        <span class="pull-left">CSS</span>
                        <span class="porcentaje">70%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-red countUp" role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <div class="w-100">
                        <span class="pull-left">PHP</span>
                        <span class="porcentaje">100%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-red countUp" role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div>
                    <div class="w-100">
                        <span class="pull-left">Laravel</span>
                        <span class="porcentaje">80%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-red countUp" role="progressbar" style="width: 0%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="projects" id="projects">
    <div class="max-width">
        <h2 class="title">Mis proyectos</h2>
        <p class="text-center">Un pequeño vistazo a cosas que he hecho</p>
        <div class="carousel owl-carousel ">
            <div class="card">
                <div class="box">
                    <img src="{{ asset("/img/mft.png") }}" alt="">
                    <div class="text">
                        <a href="https://www.freemadridtours.com/en" target="_blank">FreeMadridTours</a>
                    </div>
                    <p>Web de Guías Turisticos en inglés por la ciudad de Madrid. Con aplicación de gestión interna para los guías.</p>
                </div>
            </div>
            <div class="card">
                <div class="box">
                    <img src="{{ asset("/img/muralesmadrid.png") }}" alt="">
                    <div class="text">
                        <a href="https://muralesmadrid.com/" target="_blank">MuralesMadrid</a>
                    </div>
                    <p>Murales pintados a mano hechos por artistas en Madrid. Con asesoramiento y presupuestos gratuitos.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact" id="contact">
    <div class="max-width">
        <h2 class="title">Contacto</h2>
        <div class="row">
            <div class="contact-body col-12 col-md-6 animacionVisible ani-slide-left">
                <h2>Ponte en contacto</h2>
                <p>Preguntar siempre fue mejor que suponer, además es totalmente gratis.</p>
                <p>Si tienes cualquier duda acerca de una necesidad que pueda resolver no dudes en ponerte en contacto conmigo en el siguiente formulario.</p>
                <div class="row">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <div class="info">
                        <div class="contact-title">Ubicación</div>
                        <div class="contact-sub">Madrid, España</div>
                    </div>
                </div>
                <div class="row">
                    <i class="fas fa-envelope icon"></i>
                    <div class="info">
                        <div class="contact-title">Email</div>
                        <div class="contact-sub">contacto@jondecasa.com</div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 animacionVisible ani-slide-right">
                <form id="contact-form" method="post" action="{{route('mail.contacto')}}" role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Nombre*</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Por favor, introduce tu nombre" required="required">
                                @error('name')
                                <div class="text-danger font-italic">*{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Email*</label>
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="Por favor, introduce tu email" required="required">
                                @error('email')
                                <div class="text-danger font-italic">*{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="subject">Asunto</label>
                                <input id="form_phone" type="text" name="subject" class="form-control" placeholder="Por favor, introduce el asunto.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_message">Mensaje*</label>
                                <textarea id="form_message" name="message" class="form-control" placeholder="Mensaje" rows="4" required></textarea>
                                @error('message')
                                <div class="text-danger font-italic">*{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn button button-alt" value="Enviar">
                        </div>
                    </div>

                </form>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success mt-2" role="alert">
            <span>{{session('success')}}</span>
        </div>
        @elseif(session('error'))
        <div class="alert alert-error mt-2" role="alert">
            <span>{{session('error')}}</span>
        </div>
        @endif
    </div>

</section>


@endsection