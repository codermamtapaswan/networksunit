<?php

function pingDomain($domain, $count, $env = 'windows')
{

  $countOption = '-n';
  if ($env === 'linux') {
    $countOption = '-c';
  }

  exec("ping $countOption $count " . escapeshellarg($domain), $output, $var); // Ping specified number of times
  return $output;
}


function extract_ping_data($pingResults)
{
  $data = [];
  $packet_summary = [];
  $latency_summary = [];
  $ping_results = [];

  $ip = 'N/A';
  foreach ($pingResults as $line) {
    if (preg_match('/Reply from ([\d\.]+): bytes=([0-9]+)\s+time=([0-9\.]+)ms\s+TTL=([0-9]+)/', $line, $matches)) {
      $ip = $matches[1];
      $ping_results[] = [
        'ip' => $matches[1],
        'response_time' => $matches[3] . ' ms',
        'ttl' => $matches[4],
        'bytes' => $matches[2],
      ];
    }
    if (preg_match('/Packets: Sent = ([0-9]+), Received = ([0-9]+), Lost = ([0-9]+) \(([0-9]+)% loss\)/', $line, $matches)) {
      $packet_summary = [
        'sent' => $matches[1],
        'received' => $matches[2],
        'loss' => $matches[4] . '%',
        'time' => 'N/A', // This might be available in another line of output
      ];
    }
    if (preg_match('/Minimum = ([0-9\.]+)ms, Maximum = ([0-9\.]+)ms, Average = ([0-9\.]+)ms/', $line, $matches)) {
      $latency_summary = [
        'min' => $matches[1],
        'max' => $matches[2],
        'avg' => $matches[3],
        'stddev' => 'N/A', // This might not be available from a simple ping command
      ];
    }
  }

  $data['ip'] = $ip;
  $data['ping_results'] = $ping_results;
  $data['packet_summary'] = $packet_summary;
  $data['latency_summary'] = $latency_summary;

  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $domain = $_POST['domain'];
  $count = $_POST['count'];
  $pingResultArr = pingDomain($domain, $count);
  // $pingResult = extract_ping_data($pingResultArr);
  $pingResult = implode("\n", $pingResultArr);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ping Domain Checker</title>
  <link rel="preload" href="./assets/font-family/poppins-v21-latin-regular.woff2" fetchpriority="highest" as="font" crossorigin="">
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
                  <a href="#">Budget</a>
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


    <div class="bg-img tools-page-bg">
      <div class="container">
        <div class="row">
          <p id="breadcrumbs"><span><span><a href="https://getassist.net/category/social-media/">Social
                  Media</a></span> &gt; <span><a href="https://getassist.net/category/social-media/facebook/">Facebook</a></span> &gt; <span><a href="https://getassist.net/category/social-media/facebook/">Facebook</a></span></span>
          </p>
          <div class="col-lg-12">
            <div class="tools-page-box-flex">
              <div class="h4 mb-mob-0">Ping IP or Domain Checker</div>
              <form method="post">
                <input type="text" id="domain" name="domain" value="<?php if (isset($_POST['domain'])) echo htmlspecialchars($_POST['domain']); ?>" placeholder="Enter Domain or IP Address:" required>
                <input type="number" id="count" name="count" value="<?php if (isset($_POST['count'])) echo htmlspecialchars($_POST['count']);
                                                                    else echo '4'; ?>" min="1" required>
                <div class="btn-container-flex" type="submit">
                  <button class="secondry-btn btn-flex">Check</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="container mb-4">
      <?php if (isset($pingResult)) : ?>
        <div class="single-page all-page">
          <div class="row">
            <div class="col-lg-12">
              <div class="h4">Ping results for <?php echo "$domain ($count requests)" ?>:</div>
              <?php echo "<pre>$pingResult</pre>"; // Displaying ping output in a preformatted block
              ?>
              <!-- <figure class="wp-block-table is-style-stripes">
                <table>
                  <tr>
                    <th>Connected To</th>
                    <th>Response Time</th>
                    <th>TTL</th>
                    <th>No of Bytes</th>
                  </tr>
                  <tbody>
                    <?php // foreach ($pingResult['ping_results'] as $result) : 
                    ?>
                      <tr>
                        <td><?php echo htmlspecialchars($result['ip']) ?></td>
                        <td><?php echo htmlspecialchars($result['response_time']) ?></td>
                        <td><?php echo htmlspecialchars($result['ttl']) ?></td>
                        <td><?php echo htmlspecialchars($result['bytes']) ?></td>
                      </tr>
                    <?php // endforeach 
                    ?>
                    <tr>
                      <th>Packet Summary</th>
                    </tr>
                    <tr>
                      <th>Sent</th>
                      <th>Received</th>
                      <th>Loss</th>
                      <th>Time</th>
                    </tr>
                    <tr>
                      <td><?php // echo htmlspecialchars($pingResult['packet_summary']['sent']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['packet_summary']['received']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['packet_summary']['loss']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['packet_summary']['time']) 
                          ?></td>
                    </tr>
                    <tr>
                      <th>Latency Summary</th>
                    </tr>
                    <tr>
                      <th>Min</th>
                      <th>Max</th>
                      <th>Avg</th>
                      <th>StdDev</th>
                    </tr>
                    <tr>
                      <td><?php // echo htmlspecialchars($pingResult['latency_summary']['min']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['latency_summary']['max']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['latency_summary']['avg']) 
                          ?></td>
                      <td><?php // echo htmlspecialchars($pingResult['latency_summary']['stddev']) 
                          ?></td>
                    </tr>





                  </tbody>
                </table>
              </figure> -->

            </div>
          </div>
        </div>

      <?php endif; ?>
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
  </script>
</body>

</html>
</div>