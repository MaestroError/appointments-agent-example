<?php

// config for Maestroerror/LarAgent
return [
    'default_driver' => \LarAgent\Drivers\OpenAi\OpenAiDriver::class,
    'default_chat_history' => \LarAgent\History\InMemoryChatHistory::class,

    'providers' => [

        'default' => [
            'name' => 'openai',
            'model' => 'gpt-4o-mini',
            'api_key' => env('OPENAI_API_KEY'),
            'default_context_window' => 50000,
            'default_max_completion_tokens' => 100,
            'default_temperature' => 1,
        ],

        'ollama' => [
            'name' => 'ollama-local',
            'model' => 'llama3.2:3b',
            'driver' => \LarAgent\Drivers\OpenAi\OpenAiCompatible::class,
            'api_key' => "ollama",
            'api_url' => "http://localhost:11434/v1",
            'default_context_window' => 50000,
            'default_max_completion_tokens' => 100,
            'default_temperature' => 1,
        ],
    ],
];
