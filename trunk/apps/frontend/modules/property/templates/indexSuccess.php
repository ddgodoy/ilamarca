<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAHhzikxCQyRAS8ryQoB75mRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxQiqBRnE1Iky5sZfKGxzYbUanZ0HA" type="text/javascript"></script>
<?php if ($getMobile === true): ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<?php endif; ?>
<link rel="stylesheet" href="/css/jquery.bxslider.css">
<link rel="stylesheet" href="/css/slider-modal.css">
<link rel="stylesheet" href="/css/styles-mobile.css">
<style>
    iframe {
        height: 297px;
        width: 475px;
    }
</style>
<?php include_partial ('boxEmailSharer') ?>
<div class="ficha">
    <div class="fondo-titulo bg-full" title="<?php echo truncate_text($property->getName(), 55, '') ?>">
        <h1><?php echo truncate_text($property->getName(), 55, '') ?></h1>
        <h3><?php echo Operation::getPrices($property->getId(), $sf_user->getCulture()) ?></h3>
    </div>

    <div id="container" class="cont-slider">
        <?php if ($_down_pdf_file): ?>
            <div class="pdf"><a href="<?php echo '/admin/uploads/pdf_file/' . $_down_pdf_file ?>" target="_blank"></a>
            </div>
        <?php endif; ?>

        <?php if ($getMobile === false): ?>
        <ul class="bxslider" style="">

            <?php if (count($images) > 0): ?>

                <?php
                $index = 1;
                foreach ($images as $value){

                    if ($index === 1) { ?>
                        <li onclick="openModal();currentSlide(<?php echo $index;?>)">
                            <img class="slider" src="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>" />
                        </li>
                    <?php }

                    if (($videos) || ($latitude != '' || $longitude != '') && $index > 1 ){
                        if ($videos && $index == 1 ) { ?>
                            <div onclick="openModal();currentSlide(<?php echo $index; ?>)">
                                <?php echo html_entity_decode($videos->getYoutube()) ?>
                            </div>
                            <?php $index++; }

                        if (!$videos && ($latitude != '' || $longitude != '') && ($index == 2)) { ?>
                            <li onclick="openModal();currentSlide(<?php echo $index; ?>)">
                                <div id="gallery-mapas" class="slider clearfix">
                                    <div id="maps" class="fotoBig">
                                        <div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
                                    </div>
                                </div>
                            </li>
                            <?php $index++;
                        }else if ( $videos && ($latitude != '' || $longitude != '') && ($index == 3 )) { ?>
                            <li onclick="openModal();currentSlide(<?php echo $index; ?>);">
                                <div id="gallery-mapas" class="slider clearfix">
                                    <div id="maps" class="fotoBig">
                                        <div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
                                    </div>
                                </div>
                            </li>
                            <?php $index++; }
                    }

                    if ($videos && ($latitude != '' || $longitude != '') && $index > 3) { ?>
                        <li onclick="openModal();currentSlide(<?php echo $index;?>)">
                            <img class="slider" src="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>" />
                        </li>
                    <?php } else if ($videos && $index > 2) { ?>
                        <li onclick="openModal();currentSlide(<?php echo $index;?>)">
                            <img class="slider" src="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>" />
                        </li>
                    <?php } else if (($latitude != '' || $longitude != '') && $index > 2) {?>
                        <li onclick="openModal();currentSlide(<?php echo $index;?>)">
                            <img class="slider" src="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>" />
                        </li>
                    <?php }else if (!$videos && ($latitude == '' || $longitude == '') && $index > 1 ){ ?>
                        <li onclick="openModal();currentSlide(<?php echo $index;?>)">
                            <img class="slider" src="<?php echo Gallery::getPath($value->getRealPropertyId()).$value->getInternalName() ?>" />
                        </li>
                    <?php }

                    $index++;
                }
                ?>
            <?php else: ?>
                <li><img class="slider" src="/images/logo_ilamarca.png" /></li>
            <?php endif; ?>
        </ul>

        <?php endif; ?>

        <?php
        if ($getMobile === true) { ?>

            <ul class="bxslider-mobile">
                <?php if (count($images) > 0) {

                    $index = 1;
                    foreach ($images as $value) {
                        ?>
                        <li onclick="openModal();currentSlide(<?php echo $index; ?>);changeOrientation()">
                            <img class="slider"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                        </li>
                        <?php $index++;
                    }

                } else { ?>
                    <li><img class="slider" src="/images/logo_ilamarca.png"/></li>
                <?php }
                ?>
            </ul>

            <?php if ($videos): ?>
                <div class="mobile-div">
                    <?php echo html_entity_decode($videos->getYoutube()) ?>
                </div>
            <?php endif; ?>

            <?php if ($latitude != '' && $longitude != ''): ?>
                <div id="gallery-mapas" class="slider clearfix mobile-div">
                    <div id="maps" class="fotoBig">
                        <div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
                    </div>
                </div>
            <?php endif; ?>
        <?php } ?>

    </div>
</div>
<div class="left ficha" title="<?php echo truncate_text($property->getName(), 55, '') ?>">
    <?php if($sf_user->getFlash('notice')): ?>
        <div class="mensajeSistema comun"><ul><li><?php echo $sf_user->getFlash('notice') ?></li></ul></div>
        <br/>
    <?php endif; ?>

    <div class="info">
        <h2>
            DETALLES GENERALES
            <div style="float:right;"><span style="color:#666666;">Código de ficha:</span> #<?php echo sprintf("%09d", $property->getId()) ?></div>
        </h2>
        <ul>
            <?php if (!empty($m2_sup_cubierta)): ?>
                <li><strong>Superficie cubierta:</strong> <?php echo $m2_sup_cubierta ?> m2.</li>
            <?php endif; ?>
            <?php if (!empty($m2_sup_terreno)): ?>
                <li><strong>Superficie terreno: </strong> <?php echo $m2_sup_terreno ?> m2.</li>
            <?php endif; ?>
            <?php if (!empty($years_antiquity)): ?>
                <li><strong>Antigüedad (años): </strong> <?php echo $years_antiquity ?> </li>
            <?php endif; ?>
            <?php if (!empty($qty_bathrooms)): ?>
                <li><strong>Baños: </strong> <?php echo $qty_bathrooms ?> </li>
            <?php endif; ?>
            <li><strong>Cantidad dormitorios: </strong> <?php echo $property->getBedroom()->getName() ?></li>
        </ul>
        <?php if($property->getDetail()): ?>
            <h2>DESCRIPCIÓN</h2>
            <p style="text-align:justify">
                <?php echo nl2br($property->getDetail()) ?>
            </p>

            <br/>
        <?php endif; ?>
        <?php if($property->getPointsOfRef()): ?>
            <h2>PUNTOS DE REFERENCIA</h2>
            <p style="text-align:justify">
                <?php echo nl2br($property->getPointsOfRef()) ?>
            </p>
            <br/>
        <?php endif; ?>
        <?php if($property->getTransports()): ?>
            <h2>TRANSPORTE</h2>
            <p style="text-align:justify">
                <?php echo nl2br($property->getTransports()) ?>
            </p>
            <br/>
        <?php endif; ?>
        <h2>
            <img src="images/tit_datosvendedor.png" alt="Datos del vendedor" />
        </h2>
        <!--        <p align="left">-->
        <p class="avatar">
            <img src="<?php echo $property->AppUser->getPhoto() ? '/admin/uploads/user/'.$property->AppUser->getPhoto() : '/images/avatar.jpg' ?>" />
        </p>
        <br clear="all"/>
        <p class="nombre" style=" padding-top: 25px;">Nombre: <?php echo ucwords($property->AppUser->getName().' '.$property->AppUser->getLastName()) ?></p>
        <p class="nombre" style="">Teléfono: <?php echo $property->AppUser->getPhone()?$property->AppUser->getPhone():'---' ?></p>
        <p class="nombre" style="">Email: <?php echo $property->AppUser->getEmail() ?></p>
        <div class="boton">
            <a href="<?php echo $sf_user->isAuthenticated() ? url_for('search/contact?pid='.$property->getId()) : url_for('user/index') ?>" class="contactar" style=""></a>
        </div>

    </div>
</div>
<!-- -->
<div class="right">
    <!--<div class="box clearfix wprofile">
        <div class="inner clearfix">
            <div class="titulo"><img src="images/tit_datosvendedor.png" alt="Datos del vendedor" /></div>
            <div class="avatar" align="center" style="margin-left: 70px"><img src="<?php /*echo $property->AppUser->getPhoto() ? '/admin/uploads/user/'.$property->AppUser->getPhoto() : '/images/avatar.jpg' */?>" /></div>
            <br clear="all"/>
            <div class="nombre" style="margin-left: 25px; width: 85%; padding-top: 25px;">Nombre: <?php /*echo ucwords($property->AppUser->getName().' '.$property->AppUser->getLastName()) */?></div>
            <div class="nombre" style="margin-left: 25px; width: 85%">Teléfono: <?php /*echo $property->AppUser->getPhone()?$property->AppUser->getPhone():'---' */?></div>
            <div class="nombre" style="margin-left: 25px; width: 85%">Email: <?php /*echo $property->AppUser->getEmail() */?></div>
            <div class="boton">
                <a href="<?php /*echo $sf_user->isAuthenticated() ? url_for('search/contact?pid='.$property->getId()) : url_for('user/index') */?>" class="contactar" style="margin-top:30px;"></a>
            </div>
        </div>
    </div>
    <div class="sombra"></div>-->
    <!-- -->
    <?php if (!empty($qrcode_img)): ?>
        <div class="box clearfix wprofile">
            <div align="center" style=" padding: 15px;">
                <img src="/uploads/qr_codes/<?php echo $qrcode_img ?>" alt="qr" title="qr" />
            </div>
        </div>
        <div class="sombra"></div>
        <!-- -->
    <?php endif; ?>
    <div class="box clearfix  compartir">
        <div class="inner clearfix">
            <div class="titulo"><img src="images/tit_compartir.png" alt="Compartir propiedad" /></div>
            <div class="boton">
                <?php if ($getMobile === false): ?>
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url_site ?>" class="share-fb"
                       target="_blanck">En Facebook</a>
                    <a class="share-email" id="email-box">Por E-mail</a>
                <?php endif; ?>

                <?php if ($getMobile === true): ?>
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $url_site ?>" class="share-fb" target="_blanck"></a>
                    <a class="share-email" id="" title="<?php echo truncate_text($property->getName(), 55, '') ?>"
                       href="mailto:?subject=I wanted you to see this site&amp;body=<?php echo $url_site.' '; echo truncate_text($property->getName(), 55, ''); ?>" ></a>
                    <a href="whatsapp://send" class="share-whatsapp"
                       data-text="<?php echo truncate_text($property->getName(), 55, ''); ?>"
                       data-href=""></a>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="sombra"></div>
    <!--    -->
    <?php include_partial('home/rateProperty') ?>
</div>
<?php if (count($images) > 0): ?>
    <div id="in_gallery">
        <?php foreach ($images as $value):  ?>
            <a rel="lightbox[$ID]" id="<?php  $id_img_arrary = explode('.', $value->getInternalName()); echo $id_img_arrary[0]; ?>" href="<?php echo Gallery::getPath($value->getRealPropertyId()).'g_'.$value->getInternalName() ?>"></a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<script type="text/javascript" src="/js/jquery.bxslider.js"></script>
<script type="text/javascript" src="/js/slider-modal.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.bxslider').bxSlider({
            minSlides: 2,
            maxSlides: 4,
            slideWidth: 600,
            infiniteLoop: true,
            slideMargin: 10
        });

        $('.bxslider-mobile').bxSlider({
            minSlides: 1,
            maxSlides: 1,
            slideWidth: 600,
            infiniteLoop: true,
            slideMargin: 10
        });

        $('.bxslider-mobile-lightbox').bxSlider({
            mode: 'vertical',
            minSlides: 1,
            maxSlides: 1,
            responsive: true,
            infiniteLoop: true,
            touchEnabled: true,
            preloadImages: visible
        });

        $('.close').click(function () {
            alert('hola');
        });

        /*var prevX = -1;

        $('.modal-content').draggable({
            drag: function (e) {
                //console.log(e.pageX);
                if (prevX == -1) {
                    prevX = e.pageX;
                    return false;
                }
                // dragged left
                if (prevX > e.pageX) {
                    if (e.pageX < 10){
                        console.log('dragged left ===> ' + e.pageX);
                        plusSlides(1);
                        e.pageX = 196;
                    }
                }
                else if (prevX < e.pageX) { // dragged right
                    console.log('dragged right ===> ' + e.pageX);
                }
                prevX = e.pageX;
            }
        });*/


        function inicializar(lat, longt, name, id) {
            if (GBrowserIsCompatible())
            {

                var map = new GMap2(document.getElementById(id));
                map.setCenter(new GLatLng(lat,longt), 17);
                map.addControl(new GMapTypeControl());
                map.addControl(new GLargeMapControl());
                map.addControl(new GScaleControl());
                map.addControl(new GOverviewMapControl());
                //map.addOverlay(new GMarker(new GLatLng(-33.43795,-70.603627)));

                var show_descripcion = '<b>'+name+'</b><br />';
                var point = new GPoint (longt,lat);
                var marker = new GMarker(point);
                map.addOverlay(marker);
                marker.openInfoWindowHtml(show_descripcion);

                GEvent.addListener(map, "click", function (overlay,point){
                    if (point){
                        marker.setPoint(point);
                        map.addOverlay(marker);
                        marker.openInfoWindowHtml(show_descripcion);
                    }
                });
            }
        }
        <?php if($latitude != '' || $longitude != ''): ?>
        $('#gallery-mapas').html(inicializar(<?php echo $latitude ?>,<?php echo $longitude ?>, '<?php echo $property->getName() ?>', 'gallery-mapas'));
        <?php endif; ?>

        <?php if($latitude != '' || $longitude != ''): ?>
        $('#gallery-mapas-modal').html(inicializar(<?php echo $latitude ?>,<?php echo $longitude ?>, '<?php echo $property->getName() ?>', 'gallery-mapas-modal'));
        <?php endif; ?>


        $('body').keydown(function (e) {
            if (e.keyCode === 37){
                /* Prev */
                plusSlides(-1);
                $('.bx-prev').click();
            }else if (e.keyCode === 39){
                /* Next */
                plusSlides(1);
                $('.bx-next').click()
            }else if (e.keyCode === 27){
                /* Close */
                closeModal();
            }
        });



    })
</script>
<script type="text/javascript">
    $(document).ready(function () {
        document.title = "<?php echo truncate_text($property->getName(), 55, '') ?>";

        $('#mas-imagen').click(function(){
            var id = $(this).attr('alt');
            $(id).click();
        });

        $('#fotos').click(function() {
            $('#gallery').removeAttr('style');
            $(this).attr('class', 'active-f');
            $('#videos').removeAttr('class');
            $('#videos').attr('class', 'videos');
            $('#gallery-videos').hide();
            $('#mapas').removeAttr('class');
            $('#mapas').attr('class', 'mapas');
            $('#gallery-mapas').hide();
        })
        //
        $('#videos').click(function() {
            $('#gallery-videos').removeAttr('style');
            $(this).attr('class', 'active-v');
            $('#fotos').removeAttr('class');
            $('#fotos').attr('class', 'fotos');
            $('#gallery').hide();
            $('#mapas').removeAttr('class');
            $('#mapas').attr('class', 'mapas');
            $('#gallery-mapas').hide();
        })
        //
        $('#mapas').click(function() {
            $('#gallery-mapas').removeAttr('style');
            $(this).attr('class', 'active-m');
            $('#fotos').removeAttr('class');
            $('#fotos').attr('class', 'fotos');
            $('#gallery').hide();
            $('#videos').removeAttr('class');
            $('#videos').attr('class', 'videos');
            $('#gallery-videos').hide();
            <?php if($latitude != '' || $longitude != ''): ?>
            $('#gallery-mapas').html(inicializar(<?php echo $latitude ?>,<?php echo $longitude ?>, '<?php echo $property->getName() ?>'));
            <?php endif; ?>
        })

        //
        $(window).resize(function () {
            var ancho = 735;
            var alto = 475;
            var wscr = $(window).width();
            var hscr = $(window).height();
            $('#bgtransparent').css("width", wscr);
            $('#bgtransparent').css("height", hscr);
            $('#bgmodal').css("width", ancho + 'px');
            $('#bgmodal').css("height", alto + 'px');
            var wcnt = $('#bgmodal').width();
            var hcnt = $('#bgmodal').height();
            var mleft = (wscr - wcnt) / 2;
            var mtop = (hscr - hcnt) / 2;
            var atop = (mtop - 15);
            var aright = (mleft - 72);
            $('#bgmodal').css("left", mleft + 'px');
            $('#bgmodal').css("top", mtop + 'px');
            $('#modal-close').css("top", atop + 'px');
            $('#modal-close').css("right", aright + 'px')
        });
        $('#email-box').click(function(){
            showModal();
        });
        $('#submit-sharer').click(function() {

            if ($('#contac_name').val()=='')
            {
                alert('Ingresa tu nombre');
                $('#contac_name').focus();
                return false;
            }
            if ($('#contac_email').val()=='')
            {
                alert('Ingresa tu email');
                $('#contac_email').focus();
                return false;
            }
            if (!validar_email($('#contac_email').val()))
            {
                alert('Tu email no es correcto');
                $('#contac_email').focus();
                return false;
            }
            if ($('#contac_email_friend').val()=='')
            {
                alert('Ingresa el email de tu amigo');
                $('#contac_email_friend').focus();
                return false;
            }
            if (!validar_email($('#contac_email_friend').val()))
            {
                alert('El email de tu amigo no es correcto');
                $('#contac_email_friend').focus();
                return false;
            }
        });
    });
    //
    function showModal() {
        var bgdiv = $('<div>').attr({
            'id': 'bgtransparent'
        });
        $('body').append(bgdiv);
        var wscr = $(window).width();
        var hscr = $(window).height();
        $('#bgtransparent').css("width", wscr);
        $('#bgtransparent').css("height", hscr);
        var moddiv = '';
        moddiv = $('<div>').attr({
            'id': 'bgmodal'
        });
        var mod_close = $('<div>').attr({
            id: 'modal-close-div'
        });
        $('body').append(moddiv);
        $('body').append(mod_close);
        $('#bgmodal').append($('#ab-inbox').contents());
        $('#modal-close-div').append($('#new-close-modal').contents());
        $(window).resize()
    }
    //
    function closeModalOld()
    {
        $('#ab-inbox').append($('#bgmodal').contents());
        $('#new-close-modal').append($('#modal-close-div').contents());
        $('#bgmodal').remove();
        $('#bgtransparent').remove();
        $('#modal-close-div').remove()
    }
    //
    function validar_email(valor)
    {
        // creamos nuestra regla con expresiones regulares.
        var filter = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        // utilizamos test para comprobar si el parametro valor cumple la regla
        if (filter.test(valor))
            return true;
        else
            return false;
    }

</script>


<?php if($getMobile === false): ?>
    <div id="myModal" class="modal">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modal-content">

            <?php if (count($images) > 0): ?>

                <?php
                $index = 1;
                foreach ($images as $value) {

                    if ($index === 1) { ?>
                        <div class="mySlides">
                            <img class="img-mySlides"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>">
                        </div>
                    <?php }

                    if (($videos) || ($latitude != '' || $longitude != '') && $index > 1) {
                        if ($videos && $index == 1) { ?>

                            <div class="mySlides">
                                <?php echo html_entity_decode($videos->getYoutube()) ?>
                            </div>
                            <?php $index++;
                        }

                        if (!$videos && ($latitude != '' || $longitude != '') && ($index == 2)) { ?>
                            <div class="mySlides">
                                <div id="gallery-mapas-modal" class="slider clearfix">
                                    <div id="maps" class="fotoBig">
                                        <div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
                                    </div>
                                </div>
                            </div>
                            <?php $index++;
                        } else if ($videos && ($latitude != '' || $longitude != '') && ($index == 3)) { ?>
                            <div class="mySlides">
                                <div id="gallery-mapas-modal" class="slider clearfix">
                                    <div id="maps" class="fotoBig">
                                        <div style="margin-top:150px;color:#CCCCCC;">SIN MAPA DE GOOGLE</div>
                                    </div>
                                </div>
                            </div>
                            <?php $index++;
                        }
                    }

                    if ($videos && ($latitude != '' || $longitude != '') && $index > 3) { ?>
                        <div class="mySlides">
                            <img class="img-mySlides"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                        </div>
                    <?php } else if ($videos && $index > 2) { ?>
                        <div class="mySlides">
                            <img class="img-mySlides"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                        </div>
                    <?php } else if (($latitude != '' || $longitude != '') && $index > 2) { ?>
                        <div class="mySlides">
                            <img class="img-mySlides"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                        </div>
                    <?php } else if (!$videos && ($latitude == '' || $longitude == '') && $index > 1) { ?>
                        <div class="mySlides">
                            <img class="img-mySlides"
                                 src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                        </div>
                    <?php }

                    $index++;
                }
                ?>
            <?php else: ?>
                <div class="mySlides">
                    <img src="/images/logo_ilamarca.png"/>
                </div>
            <?php endif; ?>


            <a class="prev-touch" onclick="plusSlides(-1)"></a>
            <a class="next-touch" onclick="plusSlides(1)"></a>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!--<div class="caption-container">
                <p id="caption"></p>
            </div>-->

        </div>
    </div>
<?php endif; ?>

<?php if($getMobile === true): ?>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-content">
                <ul class="bxslider-mobile-lightbox">
                    <?php if (count($images) > 0) {

                        $index = 1;
                        foreach ($images as $value) {
                            ?>
                            <li>
                                <span class="close cursor" onclick="closeModal()">&times;</span>
                                <img class="slider img-lightbox"
                                     src="<?php echo Gallery::getPath($value->getRealPropertyId()) . $value->getInternalName() ?>"/>
                            </li>
                            <?php $index++;
                        }

                    } else { ?>
                        <li>
                            <span class="close cursor">&times;</span>
                            <img class="slider" src="/images/logo_ilamarca.png"/>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>

<?php endif; ?>

