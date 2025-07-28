<?php

$patterns = [
        // YouTube (long URL)
        '#(?:youtube\.com/watch\?v=)([a-zA-Z0-9_-]{11})#' => 'https://www.youtube.com/embed/$1',

        // YouTube (short URL)
        '#(?:youtu\.be/)([a-zA-Z0-9_-]{11})#' => 'https://www.youtube.com/embed/$1',

        // Vimeo
        '#(?:vimeo\.com/)(\d+)#' => 'https://player.vimeo.com/video/$1',

        // Dailymotion
        '#dailymotion\.com/video/([a-zA-Z0-9]+)#' => 'https://www.dailymotion.com/embed/video/$1',

        // Facebook
        '#(?:facebook\.com/.*/videos/.+?)(\d+)#' => 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($url) . '&show_text=1&width=200',
];