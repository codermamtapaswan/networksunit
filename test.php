<?php

require 'vendor/autoload.php';

use Netdns2\Resolver;

$resolver = new Net_DNS2();
$resolver->setServers(array('8.8.8.8', '8.8.4.4'));

$re = new Net_DNS2_Resolver();
$res = $re->query('getassist.net');
var_dump($res);



// printf("id %d, opcode %s, rcode %s, flags %s\n",
//        $response->header->id,
//        $response->header->opcode,
//        $response->header->rcode,
//        implode(' ', $response->header->flags));

// echo ";\nQUESTION\n";
// foreach ($response->question as $question) {
//     printf("%s IN %s\n", $question->qname, $question->qtype);
// }

// echo ";\nANSWER\n";
// foreach ($response->answer as $answer) {
//     printf("%s %d IN %s %s\n",
//            $answer->name,
//            $answer->ttl,
//            $answer->type,
//            $answer->rdatastr);
// }

// echo ";\nAUTHORITY\n";
// foreach ($response->authority as $authority) {
//     printf("%s %d IN %s %s\n",
//            $authority->name,
//            $authority->ttl,
//            $authority->type,
//            $authority->rdatastr);
// }

// echo ";\nADDITIONAL\n";
// foreach ($response->additional as $additional) {
//     printf("%s %d IN %s %s\n",
//            $additional->name,
//            $additional->ttl,
//            $additional->type,
//            $additional->rdatastr);
// }







// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2.php';
// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2\Socket.php';
// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2\Packet.php';
// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2\Resolver.php';
// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2\Exception.php';
// require 'C:\xampp\htdocs\www\networksunit\netdns2\Net\DNS2\Lookups.php';

// use NetworksUnit\NetDNS2\Net\DNS2;
// use NetworksUnit\NetDNS2\Net\DNS2\Socket;
// use NetworksUnit\NetDNS2\Net\DNS2\Packet;
// use NetworksUnit\NetDNS2\Net\DNS2\Resolver;

// $r = new Net_DNS2_Resolver();
// $r->query('google.com', 'A');

// // $response = $resolver->query('getassist.net', 'A');
// echo "<pre>";
// // print_r($response);
// print_r($r);

// printf("id %d, opcode %s, rcode %s, flags %s\n",
//        $response->header->id,
//        $response->header->opcode,
//        $response->header->rcode,
//        implode(' ', $response->header->flags));

// echo ";\nQUESTION\n";
// foreach ($response->question as $question) {
//     printf("%s IN %s\n", $question->qname, $question->qtype);
// }

// echo ";\nANSWER\n";
// foreach ($response->answer as $answer) {
//     printf("%s %d IN %s %s\n",
//            $answer->name,
//            $answer->ttl,
//            $answer->type,
//            $answer->rdatastr);
// }
    
// function dns_query($domain, $type = 'A') {
//     $resolver = new Resolver();

//     try {
//         $response = $resolver->query($domain, $type);

//         return [
//             'id' => $response->header->id,
//             'opcode' => Packet::opcodeText($response->header->opcode),
//             'rcode' => Packet::rcodeText($response->header->rcode),
//             'flags' => Packet::flagText($response->header->flags),
//             'question' => $response->question,
//             'answer' => $response->answer,
//             'authority' => $response->authority,
//             'additional' => $response->additional
//         ];

//     } catch (Net_DNS2\Exception $e) {
//         echo "DNS query failed: ", $e->getMessage(), "\n";
//         return null;
//     }
// }

// function format_response($response) {
//     echo "ID: " . $response['id'] . PHP_EOL;
//     echo "Opcode: " . $response['opcode'] . PHP_EOL;
//     echo "Rcode: " . $response['rcode'] . PHP_EOL;
//     echo "Flags: " . implode(" ", $response['flags']) . PHP_EOL;

//     echo ";QUESTION" . PHP_EOL;
//     foreach ($response['question'] as $question) {
//         echo $question->qname . " " . $question->qclass . " " . $question->qtype . PHP_EOL;
//     }

//     echo ";ANSWER" . PHP_EOL;
//     foreach ($response['answer'] as $answer) {
//         echo $answer->name . " " . $answer->ttl . " " . $answer->class . " " . $answer->type . " " . $answer->rdata . PHP_EOL;
//     }

//     echo ";AUTHORITY" . PHP_EOL;
//     foreach ($response['authority'] as $authority) {
//         echo $authority->name . " " . $authority->ttl . " " . $authority->class . " " . $authority->type . " " . $authority->rdata . PHP_EOL;
//     }

//     echo ";ADDITIONAL" . PHP_EOL;
//     foreach ($response['additional'] as $additional) {
//         echo $additional->name . " " . $additional->ttl . " " . $additional->class . " " . $additional->type . " " . $additional->rdata . PHP_EOL;
//     }
// }

// // Example usage
// $domain = 'getassist.net';
// $type = 'A';
// $response = dns_query($domain, $type);

// if ($response) {
//     format_response($response);
// }

?>
`