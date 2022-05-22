<?php

namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface{
  protected $clients;

  public function __construct()  {
    $this->clients = new \SplObjectStorage;
    echo "Servidor iniciado \n";
  }

  public function onOpen(ConnectionInterface $conn){
    // Store the new connection to send messages to later
    $this->clients->attach($conn);

    echo "Nueva conexión establecida ({$conn->resourceId})\n";
  }

  public function onMessage(ConnectionInterface $from, $msg){
    $numRecv = count($this->clients) - 1;
    foreach ($this->clients as $client) {
      // Enviar a otros usuarios conectados
      if ($from !== $client) {
        $client->send($msg);
      }
    }
  }

  public function onClose(ConnectionInterface $conn){
    // The connection is closed, remove it, as we can no longer send it messages
    $this->clients->detach($conn);

    echo "Connection {$conn->resourceId} has disconnected\n";
  }

  public function onError(ConnectionInterface $conn, \Exception $e){
    echo "An error has occurred: {$e->getMessage()}\n";

    $conn->close();
  }
}
