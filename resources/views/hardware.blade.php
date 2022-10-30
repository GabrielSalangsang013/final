<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/ualogo.ico') }}"/>
    <link rel="stylesheet" href="{{asset('css/hardware.css')}}">
    <script type="module" src="https://unpkg.com/@google/model-viewer@0.6.0/dist/model-viewer.js"></script>
    <script nomodule src="https://unpkg.com/@google/model-viewer@0.6.0/dist/model-viewer-legacy.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>{{ $hardware_info['hardware_name'] }} | Markerless Web-AR</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ route('dashboard') }}"><span class='material-icons iconLeave'>keyboard_backspace</span> </a>
                
                <ul class="nav-links">
                    <a href="{{ route('internal_hardware') }}"><li>Internal Hardware</li></a>
                    <a href="{{ route('external_hardware') }}"><li>External Hardware</li></a>
                    <a href="{{ route('logout') }}"><li>Logout</li></a>
                </ul>
    
                <div class="burger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <p class="hardwareName">{{ $hardware_info['hardware_name'] }}</p>

            <div class="tab">
                <button type="button" class="btnTab btnTabActive" data-content="#ar">A.R</button>
                <button type="button" class="btnTab" data-content="#image">Image</button>
                <button type="button" class="btnTab" data-content="#video">Video</button>
            </div>

            <div id="ar" class="content contentActive">
                <br/>
                <model-viewer 
                    src="{{ $hardware_info['hardware_url_android'] }}"
                    ios-src="{{ $hardware_info['hardware_url_ios'] }}"
                    ar="ar" 
                    auto-rotate="auto-rotate" 
                    camera-controls="camera-controls" 
                    quick-look-browsers="safari chrome" class="ar">
                </model-viewer>
            </div>

            <div id="image" class="content">
                <br/>
                <img src="{{ $hardware_info['hardware_image'] }}" alt="" class="image"/>
            </div>

            <div id="video" class="content">
                <br/>
                <iframe width="300" height="315" src="{{ $hardware_info['hardware_video'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <br/>
            <p class="explanation">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $hardware_info['hardware_description'] }}</p>

            <div>
                <img src="{{asset('images/Design5.png')}}" alt="" class="Design5"/>
            </div>
        </div>
    </main>
    <footer></footer>

    <script>
        let btnTabs = document.querySelectorAll('.btnTab');

        btnTabs.forEach(btnTab => {
            btnTab.addEventListener('click', (e) => {
                if(btnTab.getAttribute('data-content') == 'all') {
                    let allNotActiveContent = document.querySelectorAll('.content');
                    allNotActiveContent.forEach(notActiveContent => notActiveContent.classList.add('contentActive'));
                    document.querySelector('.btnTabActive').classList.remove('btnTabActive');
                    btnTab.classList.add('btnTabActive');
                    return;
                }

                document.querySelector('.btnTabActive').classList.remove('btnTabActive');
                btnTab.classList.add('btnTabActive');

                let allContentActives = document.querySelectorAll('.contentActive');
                allContentActives.forEach(contentActive => contentActive.classList.remove('contentActive'));

                let newAllContentActives = document.querySelectorAll(`${btnTab.getAttribute('data-content')}`);
                newAllContentActives.forEach(newContentActive => newContentActive.classList.add('contentActive'));
            });
        });

        const burger = document.querySelector('.burger');
        const nav_links = document.querySelector('.nav-links');
        const myBody = document.querySelector('body');
        burger.addEventListener('click', () => {
            nav_links.classList.toggle('show_nav_links');
            burger.classList.toggle('cross_burger');
            myBody.classList.toggle('overflow_screen');
        });
    </script>
</body>
</html>