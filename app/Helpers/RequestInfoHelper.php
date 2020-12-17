<?php

use Google\Cloud\Firestore\FirestoreClient;

if (!function_exists('get_request_by_requestid')) {
    function get_request_by_requestid($projectId, $requestId)
    {
        $db = new FirestoreClient([
            'projectId' => $projectId,
        ]);

        $docRef = $db->collection('requests')->document($requestId);
        $snapshot = $docRef->snapshot();

        if ($snapshot->exists()) {
            return $snapshot->data();
        } else {
            return 0;
        }
    }
}
