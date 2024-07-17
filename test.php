<?php

// Include the Composer autoloader
require '/netdns2/Net/DNS2/Reslover.php';
require '/netdns2/Net/DNS2/Packet.php';


use Net_DNS2\Resolver;
use Net_DNS2\Packet;

function dns_query($domain, $type = 'A') {
    $resolver = new Resolver();

    try {
        $response = $resolver->query($domain, $type);

        return [
            'id' => $response->header->id,
            'opcode' => Packet::opcodeText($response->header->opcode),
            'rcode' => Packet::rcodeText($response->header->rcode),
            'flags' => Packet::flagText($response->header->flags),
            'question' => $response->question,
            'answer' => $response->answer,
            'authority' => $response->authority,
            'additional' => $response->additional
        ];

    } catch (Net_DNS2\Exception $e) {
        echo "DNS query failed: ", $e->getMessage(), "\n";
        return null;
    }
}

function format_response($response) {
    echo "ID: " . $response['id'] . PHP_EOL;
    echo "Opcode: " . $response['opcode'] . PHP_EOL;
    echo "Rcode: " . $response['rcode'] . PHP_EOL;
    echo "Flags: " . implode(" ", $response['flags']) . PHP_EOL;

    echo ";QUESTION" . PHP_EOL;
    foreach ($response['question'] as $question) {
        echo $question->qname . " " . $question->qclass . " " . $question->qtype . PHP_EOL;
    }

    echo ";ANSWER" . PHP_EOL;
    foreach ($response['answer'] as $answer) {
        echo $answer->name . " " . $answer->ttl . " " . $answer->class . " " . $answer->type . " " . $answer->rdata . PHP_EOL;
    }

    echo ";AUTHORITY" . PHP_EOL;
    foreach ($response['authority'] as $authority) {
        echo $authority->name . " " . $authority->ttl . " " . $authority->class . " " . $authority->type . " " . $authority->rdata . PHP_EOL;
    }

    echo ";ADDITIONAL" . PHP_EOL;
    foreach ($response['additional'] as $additional) {
        echo $additional->name . " " . $additional->ttl . " " . $additional->class . " " . $additional->type . " " . $additional->rdata . PHP_EOL;
    }
}

// Example usage
$domain = 'getassist.net';
$type = 'A';
$response = dns_query($domain, $type);

if ($response) {
    format_response($response);
}

?>
`