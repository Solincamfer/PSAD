<header class="hdr">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <span>
                    <!--<i class="fa fa-bars" id="ico"></i> -->
                    <img src="{{asset('img/PSAD_logo1.png')}}" alt="" class="img">
                </span>
            </div>
            <div class="col-md-3 col-md-offset-6">
                <nav>
                    <ul>
                        <li class="subMenu">
                            <a href="#">
                                <span>{{$nombre." ".$apellido}}<i class="fa fa-caret-down"></i></span>
                            </a>
                            <ul class="chld">
                                <li>
                                    <div class="cs">
                                        <span>Cerrar Sesion <i class="fa fa-sign-out"></i></span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>