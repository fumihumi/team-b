<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Chat;

$app->post('/event/{id}/chat/', function (Request $request, Response $response, $args) {

    $eventId = $args["id"];
    $params = $request->getParsedBody();

    $userInfo = $this->session["user_info"];
    $currentUserId = $userInfo['id'];

    $chatData = array(
        'user_id' => $currentUserId,
        'event_id' => $eventId,
        'content' => $params['content']
    );

    $chat = new Chat($this->db);
    $chat->insert($chatData);

    return $response->withRedirect("/event/".$eventId);
});