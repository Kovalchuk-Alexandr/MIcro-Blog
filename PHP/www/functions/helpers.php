<?php
    function getExcerpt($content, $limit = 400, $cutLength = 340) {
        $content = trim($content);

        // Если текст короче лимита, возвращаем без изменений
        if (mb_strlen($content,"UTF-8") <= $limit) {
            return $content;
        }

        // Обрезаем до указанной длинны
        $excerpt = mb_substr($content, 0, $cutLength, 'UTF-8');

        // Ищем последнюю точку в пределах minCut - limit
        $lastDotPos = mb_strrpos($excerpt,' ', 0, 'UTF-8');

    // echo "last Pos: " . $lastDotPos;

    if ($lastDotPos !== false ) {
        $excerpt = mb_substr($excerpt,0, $lastDotPos + 1, 'UTF-8');
    } else {
        $excerpt = mb_substr($excerpt,0, $limit, 'UTF-8');
        // $excerpt .='...';
    }

        // Добавляе "..." и оборачиваем в <blockquote>
        // return "<blockquote>{$excerpt}...</blockquote>";
        return $excerpt . "...";
    }
?>