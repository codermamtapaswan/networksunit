<?php

date_default_timezone_set('America/Toronto');

ini_set("include_path", ".:/usr/local/php/lib/php/:/usr/share/pear/");
require_once 'PEAR/PackageFileManager/File.php';
require_once 'PEAR/PackageFileManager2.php';

$pkg = new PEAR_PackageFileManager2;

$e = $pkg->setOptions([
        
        'baseinstalldir'    => '/',
        'packagedirectory'  => '/u/devel/net_dns/Net_DNS2/',
        'ignore'            => [
            'package.php',
            'package.xml',
            'TODO',
            'composer.json'
        ],
        'installexceptions' => [ 'phpdoc' => '/*' ],
        'dir_roles'         => [
            'tests'     => 'test'
        ],
        'exceptions'        => [
            'LICENSE'   => 'doc',
            'README.md' => 'doc'
        ]
]);

$pkg->setPackage('Net_DNS2');
$pkg->setSummary('PHP Resolver library used to communicate with a DNS server.');
$pkg->setDescription("Provides (roughly) the same functionality as Net_DNS, but using modern PHP objects, exceptions for error handling, better sockets support.\n\nThis release is (in most cases) 2x - 10x faster than Net_DNS, as well as includes more RR's (including DNSSEC RR's), and improved sockets and streams support.");
$pkg->setChannel('pear.php.net');
$pkg->setAPIVersion('1.5.4');
$pkg->setReleaseVersion('1.5.4');
$pkg->setReleaseStability('stable');
$pkg->setAPIStability('stable');
$pkg->setNotes(
"- fixed a bug in Names::unpack() in v1.5.3 with multi-link TXT records that might happen to have a trailing period before the line break.\n" .
"- fixed a typo in Socket::read() when checking the error condition; I was checking against the wrong value.\n"
);
$pkg->setPackageType('php');
$pkg->addRelease();
$pkg->setPhpDep('5.4');
$pkg->setPearinstallerDep('1.4.0a12');
$pkg->addMaintainer('lead', 'mikepultz', 'Mike Pultz', 'mike@mikepultz.com');
$pkg->setLicense('BSD License', 'https://opensource.org/license/bsd-3-clause/');
$pkg->generateContents();

$pkg->writePackageFile();
