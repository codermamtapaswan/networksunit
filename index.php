<?php

require_once 'ipdata.php';


$mdetect = new MobileDetect();
if ($mdetect->isMobile()) {
  // Detect mobile/tablet  
  if ($mdetect->isTablet()) {
    $client_device =  'Tablet Device';
  } else {
    $client_device =  'Mobile Device';
  }

  // Detect platform
  if ($mdetect->isiOS()) {
    $client_device =  'IOS';
  } elseif ($mdetect->isAndroidOS()) {
    $client_device =  'ANDROID';
  }
} else {
  $client_device =  'Desktop';
}

$client_browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);

$clientIPs  =  getClientIPs();

$ipv4 = implode(', ', $clientIPs['ipv4']);
if(!$ipv4){
  $message = "Not Dected!";
}
$ipv6 = implode(', ', $clientIPs['ipv6']);
if(!$ipv6){
  $message = "Not Dected!";
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Networksunit</title>
  <link rel="preload" href="./assets/font-family/poppins-v21-latin-regular.woff2" fetchpriority="highest" as="font" crossorigin="">
  <link rel="preload" href="./assets/font-family/poppins-v21-latin-500.woff2" fetchpriority="highest" as="font" crossorigin="">
  <link rel="preload" href="./assets/font-family/poppins-v21-latin-600.woff2" fetchpriority="highest" as="font" crossorigin="">
  <link rel="preload" href="./assets/font-family/poppins-v21-latin-700.woff2" fetchpriority="highest" as="font" crossorigin="">
  <style>
    /* poppins-regular - latin */
    @font-face {
      font-display: swap;
      /* Check https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display for other options. */
      font-family: 'Poppins';
      font-style: normal;
      font-weight: 400;
      src: url('./assets/font-family/poppins-v21-latin-regular.woff2') format('woff2');
      /* Chrome 36+, Opera 23+, Firefox 39+, Safari 12+, iOS 10+ */
    }

    /* poppins-500 - latin */
    @font-face {
      font-display: swap;
      /* Check https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display for other options. */
      font-family: 'Poppins';
      font-style: normal;
      font-weight: 500;
      src: url('./assets/font-family/poppins-v21-latin-500.woff2') format('woff2');
      /* Chrome 36+, Opera 23+, Firefox 39+, Safari 12+, iOS 10+ */
    }

    /* poppins-600 - latin */
    @font-face {
      font-display: swap;
      /* Check https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display for other options. */
      font-family: 'Poppins';
      font-style: normal;
      font-weight: 600;
      src: url('./assets/font-family/poppins-v21-latin-600.woff2') format('woff2');
      /* Chrome 36+, Opera 23+, Firefox 39+, Safari 12+, iOS 10+ */
    }

    /* poppins-700 - latin */
    @font-face {
      font-display: swap;
      /* Check https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display for other options. */
      font-family: 'Poppins';
      font-style: normal;
      font-weight: 700;
      src: url('./assets/font-family/poppins-v21-latin-700.woff2') format('woff2');
      /* Chrome 36+, Opera 23+, Firefox 39+, Safari 12+, iOS 10+ */
    }
  </style>
  <link rel="stylesheet" href="./assets/css/layout.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>





  <!-- header start -->
  <header>
    <div class="container">
      <div class="top-bar">
        <div id="site-logo">
          <a href="index.html">
            <img src="./assets/img/Networksunit-logo.svg" alt="" class="img-fluid">
          </a>
        </div>
        <div class="search-form">
          <form action="">
            <input type="search" placeholder="What can we help you find today?" required="">
            <button type="submit" class="search-btn trip-btn">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <path d="M7.333 12.667A5.333 5.333 0 1 0 7.333 2a5.333 5.333 0 0 0 0 10.667ZM14 14l-2.9-2.9" stroke="#3D564A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </button>
          </form>
        </div>
        <ul class="top-bar-links-flex">
          <li>
            <a href="index.html">Pricing</a>
          </li>
          <li>
            <a href="index.html">API</a>
          </li>
          <li>
            <a href="index.html">Help</a>
          </li>

        </ul>
        <div class="toggle-slide-btn" onclick="toggleButtons()">
          <svg fill="#000" width="16" height="16" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM64 256c0-17.7 14.3-32 32-32H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H96c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z">
            </path>
          </svg>
        </div>
        <div class="mob-search-btn">
          <span class="search-icon-flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
              <path d="M7.333 12.667A5.333 5.333 0 1 0 7.333 2a5.333 5.333 0 0 0 0 10.667ZM14 14l-2.9-2.9" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </span>
        </div>
      </div>
      <div class="navigation">
        <nav>
          <ul>
            <li class="dropdown">
              <a href="#" class="link-active">What is My IP?</a>
              <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 448 512">
                <path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z">
                </path>
              </svg>
              <ul>
                <li>
                  <a href="#">Artist</a>
                </li>
                <li>
                  <a href="#">Budget</a>
                </li>
                <li>
                  <a href="#">Guide</a>
                </li>
                <li>
                  <a href="#">User Login</a>
                </li>
                <li>
                  <a href="#">Contact</a>
                </li>
                <li>
                  <a href="#">Budget</a>
                </li>
                <li class="dropdown">
                  <a href="#"> budget</a>
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 448 512">
                    <path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z">
                    </path>
                  </svg>
                  <ul>
                    <li>
                      <a href="#">Instagram</a>
                    </li>
                    <li>
                      <a href="#">Instagram</a>
                    </li>
                    <li>
                      <a href="#">Instagram</a>
                    </li>
                    <li>
                      <a href="#">Instagram</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">IP Address Lookup</a></li>
            <li>
              <a href="index.html">IP WHOIS Lookup</a>
            </li>
            <li>
              <a href="index.html">DNS Lookup</a>
            </li>
            <li>
              <a href="index.html">Internet Speed Test</a>
            </li>
            <li>
              <a href="index.html">Tools</a>
            </li>
            <div class="cancel-btn" onclick="toggleButtons()">
              <svg fill="#000" xmlns="http://www.w3.org/2000/svg" height="18" width="18" viewBox="0 0 384 512">
                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z">
                </path>
              </svg>
            </div>
          </ul>
        </nav>
      </div>
    </div>
  </header>
  <!-- header end -->


  <main>




  <div class="overlay-part-flex mb-5">
      <div class="container">
        <div class="small-head-flex">
          <svg width="16" height="16" fill="#ff7800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path d="M54.2 202.9C123.2 136.7 216.8 96 320 96s196.8 40.7 265.8 106.9c12.8 12.2 33 11.8 45.2-.9s11.8-33-.9-45.2C549.7 79.5 440.4 32 320 32S90.3 79.5 9.8 156.7C-2.9 169-3.3 189.2 8.9 202s32.5 13.2 45.2 .9zM320 256c56.8 0 108.6 21.1 148.2 56c13.3 11.7 33.5 10.4 45.2-2.8s10.4-33.5-2.8-45.2C459.8 219.2 393 192 320 192s-139.8 27.2-190.5 72c-13.3 11.7-14.5 31.9-2.8 45.2s31.9 14.5 45.2 2.8c39.5-34.9 91.3-56 148.2-56zm64 160a64 64 0 1 0 -128 0 64 64 0 1 0 128 0z" />
          </svg>
          What is my IP ?
        </div>
        <div class="ip-section-flex">
          <div class="ip-title">My Public IPv4 :
            <span class="main-ip">
              <?php if(isset($ipv4) || isset($message)){
                echo $ipv4;
                echo $message;
                } ?>
            </span>
          </div>
          
          <div class="small-title">My Public IPv6 :
             <span class="main-ip">
              <?php if(isset($ipv4) || isset($message)){
                echo $ipv4;
                echo $message;
                } ?>
            </span>
          </div>

          <div class="ip-seperator-flex">

            <?php if (isset($client_browser)) { ?>
              <span>
                My browser : <strong><?php echo $client_browser ?></strong>
              </span>
            <?php } ?>


            <?php if (isset($client_device)) { ?>
              <span>
                My Device : <strong><?php echo $client_device ?></strong>
              </span>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>








    <div class="container mb-5">
      <div class="row">
        <div class="overlay-strip-flex">
          <span><img src="./assets/img/bri-finance.svg" alt="" class="img-fluid"></span>
          <span><img src="./assets/img/daihatsu.svg" alt="" class="img-fluid"></span>
          <span><img src="./assets/img/Finmas.svg" alt="" class="img-fluid"></span>
          <span><img src="./assets/img/Kredivo.svg" alt="" class="img-fluid"></span>
          <span><img src="./assets/img/daihatsu.svg" alt="" class="img-fluid"></span>
          <span><img src="./assets/img/Finmas.svg" alt="" class="img-fluid"></span>
        </div>
      </div>
    </div>
    <div class="container mb-5">
      <div class="seperator-flex">
        <div class="small-head">Networksunit Tools</div>
        <div class="big-head"> Unrelenting power with every single package</div>
        <p>Organizations are now compelled to complete comprehensive cybersecurity strategies to safeguard their
          systems, networks.</p>
      </div>
      <div class="row">
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/IP Address Lookup.svg" alt="" class="img-fluid">
            </div>
            <a href="#">IP Address Lookup</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/IP Who is Lookup.svg" alt="" class="img-fluid">
            </div>
            <a href="#">IP Who is Lookup</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/DNS Lookup.svg" alt="" class="img-fluid">
            </div>
            <a href="#">DNS Lookup</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/Port Scanner.svg" alt="" class="img-fluid">
            </div>
            <a href="#">Port Scanner</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/Password Generator.svg" alt="" class="img-fluid">
            </div>
            <a href="#">Password Generator</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/Data Breach Check.svg" alt="" class="img-fluid">
            </div>
            <a href="#">Data Breach Check</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/User Agent.svg" alt="" class="img-fluid">
            </div>
            <a href="#">User Agent</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="col-lg-3 mb-3 col-md-6">
          <div class="tools-box-flex">
            <div>
              <img src="./assets/img/Screen Resolution.svg" alt="" class="img-fluid">
            </div>
            <a href="#">Screen Resolution</a>
            <p class="truncate">It is a long established fact that a reader will be distracted by the rea</p>
          </div>
        </div>
        <div class="btn-container-flex">
          <a href="#" class="primary-btn btn-flex m-auto">
            Explore More
            <svg width="16" height="16" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z">
              </path>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="bg-cover">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="why-choose">
              <div class="seperator-flex">
                <div class="small-head">Email Buzz Tools</div>
                <div class="big-head"> Our Exceptional Email Solutions</div>
                <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the
                  visual form of a document or a typeface.</p>
              </div>
              <ul class="why-choose-d-grid">
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>IP Address Lookup</span>
                </li>
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>Wireless Networks</span>
                </li>
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>Network Topologies</span>
                </li>
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>Bandwidth and Latency</span>
                </li>
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>Network Protocols</span>
                </li>
                <li>
                  <img src="./assets/img/check-circle.svg" alt="" class="img-fluid">
                  <span>Network Layers (OSI Model)</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="why-choose-img">
              <img src="./assets/img/why-chosse-img.svg" alt="" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
      <div class="container mb-5">
        <div class="seperator-flex">
          <div class="small-head">Networksunit Tools</div>
          <div class="big-head"> Frequently Asked Questions</div>
        </div>
        <div class="accordions">
          <details class="active" open="">
            <summary class="">What is an IP address?</summary>
            <div class="content">
              <p>
                Organizations are now compelled to complete comprehensive cybersecurity strategies to safeguard their
                systems, networks.
                Organizations are now compelled to complete comprehensive cybersecurity strategies to safeguard their
                systems, networks
              </p>
            </div>
          </details>
          <details>
            <summary>What is an IP address?</summary>
            <div class="content">
              <p>
                The basic plan allows one account, the standard plan allows two, and the premium
                plan allows
                up to 4 accounts.
              </p>
            </div>
          </details>
          <details>
            <summary class="">What is an IP address?</summary>
            <div class="content">
              <p>
                The basic plan allows one account, the standard plan allows two, and the premium
                plan allows
                up to 4 accounts.
              </p>
            </div>
          </details>
        </div>
      </div>
      <div class="container mb-5">
        <div class="seperator-flex seperator-flex-left">
          <div class="seperator-wrap-flex">
            <div class="small-head">Email Buzz Tools</div>
            <div class="big-head"> Network Protocols</div>
            <div class="btn-container-flex">
              <a href="#" class="primary-btn btn-flex margin-left">
                Read All
                <svg width="16" height="16" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z">
                  </path>
                </svg>
              </a>
            </div>
          </div>
          <p>It is a long established fact that a reader will be distracted by the readable content of a page when
            looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of
            letters, as opposed to using 'Content here, content here', making it look like readable English</p>
        </div>
        <div class="row">
          <div class="col-lg-4 mb-3">
            <div class="row h-100">
              <div class="col-lg-12">
                <div class="site-card-flex d-grid-60-auto">
                  <div class="card-img">
                    <a href="#">
                      <img src="https://getassist.net/wp-content/uploads/2024/05/car-thing.webp" alt="" class="img-fluid">
                    </a>
                  </div>
                  <div class="card-content-flex p-20">
                    <div class="card-meta-flex">
                      <a href="#" class="cat-g">Procutivity</a>
                    </div>
                    <a href="#" class="truncate site-title">The Art of Living: News and Features The Art of Living: News
                      and Features......</a>
                    <div class="card-meta">
                      <span>14 Feb, 2024 </span> /
                      <a href="#">By Anna Rosé</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="row h-100">
              <div class="col-lg-12">
                <div class="site-card-flex d-grid-60-auto">
                  <div class="card-img">
                    <a href="#">
                      <img src="https://getassist.net/wp-content/uploads/2024/05/wordpad-and-cortana.webp" alt="" class="img-fluid">
                    </a>
                  </div>
                  <div class="card-content-flex p-20">
                    <div class="card-meta-flex">
                      <a href="#" class="cat-g">Procutivity</a>
                    </div>
                    <a href="#" class="truncate site-title ">The Art of Living: News and Features The Art of Living:
                      News and Features......</a>
                    <div class="card-meta">
                      <span>14 Feb, 2024 </span> /
                      <a href="#">By Anna Rosé</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="row h-100">
              <div class="col-lg-12">
                <div class="site-card-flex d-grid-60-auto">
                  <div class="card-img">
                    <a href="#">
                      <img src="https://getassist.net/wp-content/uploads/2024/05/ai-feature-to-lightroom.webp" alt="" class="img-fluid">
                    </a>
                  </div>
                  <div class="card-content-flex p-20">
                    <div class="card-meta-flex">
                      <a href="#" class="cat-g">Procutivity</a>
                    </div>
                    <a href="#" class="truncate site-title">The Art of Living: News and Features The Art of Living: News
                      and Features......</a>
                    <div class="card-meta">
                      <span>14 Feb, 2024 </span> /
                      <a href="#">By Anna Rosé</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </main>





  <div id="progress">
    <span id="progress-value">
      <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.134.366a1.25 1.25 0 0 0-1.768 0l-6 6a1.25 1.25 0 1 0 1.768 1.768L6 4.268V17.25a1.25 1.25 0 1 0 2.5 0V4.268l3.866 3.866a1.25 1.25 0 0 0 1.768-1.768z" fill="#000"></path>
      </svg>
    </span>
  </div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 mb-3">
          <div class="footer-logo-flex">
            <div id="site-logo">
              <a href="index.html">
                <img src="./assets/img/Networksunit-logo.svg" alt="" class="img-fluid">
              </a>
            </div>
            <div class="inner-mail-flex">
              <span>Email at :</span>
              <a href="mailto:info@Networksunit.com">info@Networksunit.com</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mb-3">
          <div class="footer-catg">Guideline
          </div>
          <ul class="footer-links-flex">
            <li>
              <a href="404.html">404
              </a>
            </li>
            <li>
              <a href="single.html">Blog
              </a>
            </li>
            <li>
              <a href="author.html">Author
              </a>
            </li>
            <li>
              <a href="all-author.html">All Author
              </a>
            </li>
            <li>
              <a href="contact.html">Contact Page
              </a>
            </li>
            <li>
              <a href="thankyou.html">Thank You</a>
            </li>
            <li>
              <a href="checktools.html">Checktools
              </a>
            </li>
            <li>
              <a href="blacklisttool.html">Blacklisttool</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4 mb-3">
          <div class="footer-catg">Retirement Benefit
          </div>
          <ul class="footer-links-flex">
            <li>
              <a href="category.html">Category
              </a>
            </li>
            <li>
              <a href="search-n-found.html">Search not found
              </a>
            </li>
            <li>
              <a href="all-author.html">Superannuation
              </a>
            </li>
            <li>
              <a href="contact-p.html">Pension Management
              </a>
            </li>
            <li>
              <a href="single.html">GPF Trust
              </a>
            </li>
            <li>
              <a href="thankyou.html">Unexempted PF</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4 mb-3">
          <div class="footer-catg">Products
          </div>
          <ul class="footer-links-flex">
            <li>
              <a href="404.html">Payroll Software
              </a>
            </li>
            <li>
              <a href="author.html">HR Software
              </a>
            </li>
            <li>
              <a href="all-author.html">Attendance Management System
              </a>
            </li>
            <li>
              <a href="contact-p.html">Leave Management System
              </a>
            </li>
            <li>
              <a href="single.html">Performance Management Software
              </a>
            </li>
            <li>
              <a href="thankyou.html">Mobile Application</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="footer-strip-flex">
          <div class="footer-social-flex">
            <span>Follow Us</span>
            <ul class="footer-social-links-flex">
              <li>
                <a href="#">
                  <svg fill="#000" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141m0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7m146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8m76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8M398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1">
                    </path>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#">
                  <svg fill="#000" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z">
                    </path>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#">
                  <svg fill="#000" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                    </path>
                  </svg>
                </a>
              </li>
              <li>
                <a href="#">
                  <svg fill="#000" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path d="M80 299.3V512h116V299.3h86.5l18-97.8H196v-34.6c0-51.7 20.3-71.5 72.7-71.5 16.3 0 29.4.4 37 1.2V7.9C291.4 4 256.4 0 236.2 0 129.3 0 80 50.5 80 159.4v42.1H14v97.8z">
                    </path>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
          <div class="newsletter-flex">
            <span>Sign in and don’t miss anything!</span>
            <form action="">
              <input type="search" placeholder="Enter Your Emails" required="" name="your-name">
              <div class="btn-container-flex">
                <button class="btn-flex" type="submit">
                  SUBSCRIBE
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">
      <p class="mb-0">Copyright © 2024 Accountiod. All Rights Reserved</p>
    </div>
  </footer>
  <script src="./assets/js/script.js"></script>
</body>

</html>
</div>