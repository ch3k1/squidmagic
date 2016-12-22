<?php
namespace SquidApp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {

    public function onSubscribe(ConnectionInterface $conn, $topic) {
         $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onNetworkEntry($entry) {
        $createRecord = new Insert();
        // check dublicate
        $entryData = json_decode($entry, true);
        $checkip = $createRecord->checkDublicate($entryData['host']);
        // check if ip is private
        $validip = $createRecord->checkIpaddr($entry);
        if($validip && !isset($checkip->id)) {
            $createRecord->createFlow($entry,$validip);
        }
    }
    public function onUnSubscribe(ConnectionInterface $conn, $topic) {
    }
    public function onOpen(ConnectionInterface $conn) {
    }
    public function onClose(ConnectionInterface $conn) {
    }
    public function onCall(ConnectionInterface $conn, $id, $topic, array $params) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, 'You are not allowed to make calls')->close();
    }
    public function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible) {
        // In this application if clients send data it's because the user hacked around in console
        $conn->close();
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
    }
}
