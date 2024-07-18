<!-- https://www.ipvoid.com/ip-blacklist-check/
https://dnschecker.org/ip-blacklist-checker.php
https://mxtoolbox.com/blacklists.aspx
https://gist.github.com/tbreuss/74da96ff5f976ce770e6628badbd7dfc
https: //stackoverflow.com/questions/50738236/php-blocking-visitors-based-on-text-list-of-ips
https://blog.ip2location.com/knowledge-base/lookup-ip-address-in-bulk-using-php-and-mysql-database/ -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IP BlackList Checker</title>
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
              <div class="h4 mb-mob-0">Use the blacklist check tool to disclose the reputation of an IPv4.</div>
              <form action="">
                <input type="text" class="" id="" placeholder="Enter IPv4 Address Here" required>
                <div class="btn-container-flex">
                  <button class="secondry-btn btn-flex">
                    Lookup
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="container mb-4">
      <div class="single-page all-page">
        <div class="row mb-4">
          <div class="col-lg-12">
            <figure class="wp-block-table is-style-stripes">
              <table>
                <thead>
                  <tr>
                    <th>Is Blacklisted?</th>
                    <th>Blacklist Name</th>
                    <th>BlackList Host</th>
                    <th>TTL</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>getassist.net</td>
                    <td>0spam DNSBL</td>
                    <td>0spam.fusionzero.com</td>
                    <td><svg class="copyboard" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                      </svg></td>
                  </tr>
                  <tr>
                    <td>getassist.net</td>
                    <td>0spam DNSBL</td>
                    <td>0spam.fusionsecond.com</td>
                    <td><svg class="copyboard" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                      </svg></td>
                  </tr>
                  <tr>
                    <td>getassist.net</td>
                    <td>0spam DNSBL</td>
                    <td>0spam.fusionzero.com</td>
                    <td><svg class="copyboard" width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M384 336H192c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16l140.1 0L400 115.9V320c0 8.8-7.2 16-16 16zM192 384H384c35.3 0 64-28.7 64-64V115.9c0-12.7-5.1-24.9-14.1-33.9L366.1 14.1c-9-9-21.2-14.1-33.9-14.1H192c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64zM64 128c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H256c35.3 0 64-28.7 64-64V416H272v32c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192c0-8.8 7.2-16 16-16H96V128H64z" />
                      </svg></td>
                  </tr>
                </tbody>
              </table>
            </figure>
            <div class="btn-container-flex">
              <a href="#" class="secondry-btn btn-flex">
                Copy All
                <a href="#" class="secondry-btn btn-flex">
                  Print Report
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mb-4">
        <div class="h2">IP Address Blacklist Check Blacklists for Your IP</div>
        <p>Use this tool to check an IP address against the most common blacklist databases. If you believe a blacklist or
          blocklist wrongfully added your IP address or mail server, this test helps you confirm and determine what to do
          next.</p>
      </div>
    </div>
    <div class="container">
      <div class="row mb-4">
        <div class="col-lg-8">
          <div class="h2">What is a blacklist check?</div>
          <p>If you Google "blacklist check," you'll get a variety of results, from the MX blacklist lookup to RBL
            lookups that provide blacklisted domains. But an IP address blacklist check, or IP address blocklist check,
            is essentially an IP reputation check. The procedure shows if a URL or IP address entered aligns with a
            domain name server blacklist (DNSBL).
          </p>
          <p>There are dozens of DNSBLs online, all using different criteria for listing and delisting addresses.
            However, the DNSBLs consider any IP addresses that exist on the lists a source of spam, resulting in the
            blocking of those addresses and their inability to send emails.
          </p>
        </div>
        <div class="col-lg-4 mb-3">
          <span>
            <img src="https://plus.unsplash.com/premium_photo-1677564923729-5eeacd594495?q=80&w=1548&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-fluid">
          </span>
        </div>
        <div class="col-lg-12">
          <p>Spam filters utilize various DNSBLs to verify that incoming emails do not come from blacklisted sites,
            which would be a red flag. These domain name server blocklists are generally the first line of defense
            against IPs or domains sending spam. However, in some cases, the domain blacklist database adds addresses
            that don’t send spam. Users can utilize the free blacklist IP checker to find if the database wrongfully
            blocked their IP address.</p>
        </div>
      </div>
    </div>
    <div class="tools-bg-flex mb-5">
      <div class="container">
        <div class="row">
          <div class="h2">How do I check if my IP is blacklisted?</div>
          <p>Check blacklists for your IP address by entering the address into the tool above. If you don't know your IP
            address, the What's My IP address homepage shows you your IP address and its details. It also lets you
            conveniently copy and paste your IP into this tool to run a scan.
          </p>
          <p>The IP blacklist checker tool will search IP blacklist sites and report a table of various blacklists. It
            lists the block status of each of your server IP addresses.
          </p>
          <p>Domain name blacklists don’t notify users when their IP address goes on a blocklist. Users need to check name
            blacklists to find their status.
          </p>
          <p class="mb-0">Therefore, blacklist checks are essential for users, mail servers, or businesses who believe that they have a
            blacklisted IP address. If your IP is blocked, you'll show up on the list. Using the tool above is the easiest
            way to check for blocked IPs.</p>
        </div>
      </div>
    </div>
    <div class="container mb-4">
      <div class="row">
        <div class="col-lg-12">
          <div class="h2">What causes IP blacklisting?</div>
          <p>Blocklists add IP addresses for many reasons. The intention is to protect other websites and users from
            dangerous IP addresses. However, sometimes blocklists wrongfully list other IPs on the list. Therefore, a
            normal, safe IP is blocked. Then, a user who hasn't done anything wrong will see their address in an IP block
            lookup.</p>
          <p>You may do a blacklist check online and find your own IP on a blacklist. A blacklist typically adds an IP for
            the following reasons:</p>
        </div>
        <div class="col-lg-4">
          <span>
            <img src="https://plus.unsplash.com/premium_photo-1677564923729-5eeacd594495?q=80&amp;w=1548&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.0.3&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-fluid">
          </span>
        </div>
        <div class="col-lg-8 all-page">
          <ul class="mb-0">
            <li>The IP appears to be the source of spam messaging</li>
            <li>The IP associates with a website containing inappropriate or dangerous content</li>
            <li>Your device has a malware infection, which then could spread to other devices on the network</li>
            <li>You accessed the dark web or other illegal trading sources with the IP</li>
            <li>Your device has a malware infection, which then could spread to other devices on the network</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mb-5">
        <div class="h2">Blacklisting websites for spam protection</div>
        <p>As mentioned above, domain name server blocklists are the primary defense against spam as they block IP
          addresses believed to be spam accounts. However, there are also spam uniform resource identifier blocklists
          (SURBLs) that serve as backup defenses. These blacklists note websites that appear in unsolicited emails.
          However, not all email spam filters have the capacity to use them.</p>
        <p>Spam filters that can utilize the SURBLs scan the body text of emails, extract any website addresses present,
          and check them against blacklists. If the server finds an address, it flags the message as spam and handles it
          accordingly.</p>
        <p class="mb-0">Since both methods filter spam differently, they are most effective when combined. Unfortunately, as spammers
          become more clever, there is no method capable of catching every spam message. Users must be vigilant in
          checking their own inboxes and educating</p>
      </div>
    </div>
    <div class="container">
      <div class="seperator-flex">
        <div class="small-head">Networksunit Tools</div>
        <div class="big-head"> Unrelenting power with every single package</div>
        <p>Organizations are now compelled to complete comprehensive cybersecurity strategies to safeguard their systems, networks.</p>
      </div>
      <div class="row mb-4">
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