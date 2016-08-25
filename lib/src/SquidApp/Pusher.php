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
        $entryData = json_decode($entry, true);
        print_r($entryData);
        // If the lookup topic object isn't set there is no one to publish to
        if (!array_key_exists($entryData['category'])) {
            return;
        }

        //$topic = $this->subscribedTopics[$entryData['category']];

        // re-send the data to all the clients subscribed to that category
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
