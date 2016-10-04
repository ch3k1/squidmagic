<?php
namespace SquidApp;
error_reporting(0);
use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class Pusher implements WampServerInterface {

    public function onSubscribe(ConnectionInterface $conn, $topic) {
         $this->subscribedTopics[$topic->getId()] = $topic;
    
    }

    public function onBlogEntry($entry) {

        $db = new Database();
        
        $entryData = json_decode($entry, true);
        
        if (!array_key_exists($entryData['squidmagic'] , $this->subscribedTopics)) {
            return;
        }

        $topic = $this->subscribedTopics[$entryData['squidmagic']];

        $topic->broadcast($entryData);
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
