<?php

return [

    /**
     * Your API token. Obtain from your account at https://red-amber.green 
     */
    'token' => env('RAG_API_TOKEN','YOUR_TOKEN'),

    /**
     * If you prefer to use the service without exception, set this to false
     */

     'exceptions' => env('RAG_WITH_EXCEPTIONS',true)


];