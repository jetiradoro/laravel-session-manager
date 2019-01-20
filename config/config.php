<?php

return [
    'time_from_last_conn' => 10, //time in minutes

    /**
     * Define url path which response to actions
     */
    'route_get_sessions' => '/api/admin/current-connections',
    'route_destroy_session' => '/api/admin/current-connections',
    
    /**
     * Messages of transactions
     */
    'success_msg' => 'User unloggued',
    'error_msg' => 'Error deleting session',
    'confirm_msg' => 'Are you sure about delete user session?'
];