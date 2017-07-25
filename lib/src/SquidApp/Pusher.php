<?php
namespace SquidApp;
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;
use SquidApp\Insert;

class Pusher implements WampServerInterface {

    public function onSubscribe(ConnectionInterface $conn, $topic) {
         $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onNetworkEntry($entry) {
        // Check Duplicate
        $entryData = json_decode($entry, true);
        $checkIp = Insert::checkDuplicate($entryData['host']);
        // check if ip is private
        $validIp = Insert::checkIpAddress($entry);
        if($validIp && !isset($checkIp['id'])) {
            $createRecord->createFlow($entry,$validIp);
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
